<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $address
 * @property string|null $phone
 * @property Carbon|null $birth_date
 * @property string|null $birth_place
 * @property string|null $region_registration_number
 * @property string|null $picture_url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'birth_date',
        'birth_place',
        'region_registration_number',
        'picture_url',
    ];

    protected function casts(): array
    {
        return ['birth_date' => 'date'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
