<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function all(): Collection
    {
        return User::with('firstnames')->orderBy('last_name')->get();
    }

    public function findById(int $id): User
    {
        return User::with(['firstnames', 'profile', 'voice.voiceGroup'])->findOrFail($id);
    }

    public function findByMail(string $mail): ?User
    {
        return User::where('mail', $mail)->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }
}
