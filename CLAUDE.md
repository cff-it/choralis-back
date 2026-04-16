# CLAUDE.md — Choralis Back-end

> Chorale Francophone de Faravohitra — Guide d'architecture pour Claude Code

---

## Stack technique

- **Framework** : Laravel
- **Pattern** : Action Pattern (`__invoke()`)
- **API** : Laravel Sanctum
- **Rôles & permissions** : Spatie Laravel-Permission
- **BDD** : PostgreSQL + Eloquent ORM

---

## Architecture des dossiers

```
app/
├── Http/
│   ├── Controllers/        # Reçoit la requête, délègue à une Action — rien d'autre
│   ├── Requests/           # Validation FormRequest uniquement
│   └── Resources/          # Formatage des réponses API (API Resources)
│
├── Actions/                # ⭐ Cœur métier — 1 classe = 1 action
│   ├── Song/
│   │   ├── CreateSong.php
│   │   ├── UpdateSong.php
│   │   └── AttachSongToMass.php
│   ├── Mass/
│   │   ├── CreateMass.php
│   │   └── GeneratePptx.php
│   ├── Event/
│   │   ├── CreateEvent.php
│   │   ├── RegisterMember.php
│   │   └── CheckInMember.php
│   └── User/
│       ├── CreateUser.php
│       └── AssignRole.php
│
├── Models/                 # Eloquent pur — zéro logique métier
├── Repositories/           # Requêtes BDD uniquement
├── DTOs/                   # Objets de transfert typés entre les couches
└── Policies/               # Autorisations Laravel
```

---

## Règles fondamentales

### 1. Le Controller ne fait que déléguer

```php
// ✅ Correct
public function store(CreateSongRequest $request, CreateSong $action): JsonResponse
{
    $song = $action($request->toDTO());
    return SongResource::make($song);
}

// ❌ Interdit — logique métier dans le controller
public function store(Request $request): JsonResponse
{
    $song = Song::create([...]);
    // traitement...
}
```

### 2. Les Actions utilisent `__invoke()`

```php
// ✅ Correct
class CheckInMember
{
    public function __invoke(CheckInDTO $dto): EventCheck
    {
        // toute la logique ici
    }
}

// ❌ Interdit — ne pas utiliser execute()
class CheckInMember
{
    public function execute(CheckInDTO $dto): EventCheck { ... }
}
```

### 3. Une Action = une responsabilité

- Si une classe a besoin de **plusieurs méthodes publiques**, ce n'est plus une Action — c'est un **Service**
- Un Service a des méthodes nommées explicitement (`attach()`, `detach()`, etc.)
- Les Actions restent **atomiques et testables indépendamment**

### 4. Les Models ne contiennent pas de logique métier

```php
// ✅ Autorisé dans un Model
class Song extends Model
{
    protected $fillable = [...];
    protected $casts = [...];

    public function sections(): HasMany { ... }    // relation
    public function themes(): BelongsToMany { ... } // relation
}

// ❌ Interdit dans un Model
public function attachToMass(Mass $mass): void
{
    // logique métier — va dans une Action
}
```

### 5. Les DTOs typent les données entre les couches

```php
class CheckInDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly int $eventId,
        public readonly Carbon $checkedAt,
    ) {}
}

// Dans le FormRequest
public function toDTO(): CheckInDTO
{
    return new CheckInDTO(
        userId: $this->user()->id,
        eventId: $this->input('event_id'),
        checkedAt: now(),
    );
}
```

---

## Ce qui est interdit

| ❌ Interdit | ✅ Remplacer par |
|---|---|
| Logique métier dans les Controllers | Action |
| Logique métier dans les Models | Action |
| `execute()` dans les Actions | `__invoke()` |
| Fat Controller (>10 lignes par méthode) | Découper en Actions |
| DDD / CQRS / Clean Architecture complète | Action Pattern suffisant |
| Requêtes BDD dans les Controllers | Repository |

---

## Modules du projet

| Module | Actions principales |
|---|---|
| **Répertoire chants** | `CreateSong`, `UpdateSong`, `AttachSongToMass` |
| **Liturgie messes** | `CreateMass`, `AssignSongToMassPart`, `GeneratePptx` |
| **Membres & rôles** | `CreateUser`, `AssignRole`, `AssignMassRole` |
| **Événements** | `CreateEvent`, `RegisterMember`, `CheckInMember` |
| **Paiements** | `CreateEventPayment`, `RecordUserPayment` |

---

## Conventions de nommage

- **Actions** : verbe + nom + Action → `CreateSongAction`, `CheckInMemberAction`, `GeneratePptxAction`
- **DTOs** : nom + DTO → `CheckInDTO`, `CreateSongDTO`
- **Repositories** : nom + Repository → `SongRepository`, `EventRepository`
- **Policies** : nom + Policy → `SongPolicy`, `EventPolicy`
- **Resources** : nom + Resource → `SongResource`, `UserResource`

---

## Principes SOLID appliqués

- **S** — chaque Action a une seule responsabilité
- **O** — étendre via de nouvelles Actions, ne pas modifier les existantes
- **L** — les DTOs sont substituables
- **I** — pas d'interfaces imposées inutilement
- **D** — injection de dépendances via le container Laravel
