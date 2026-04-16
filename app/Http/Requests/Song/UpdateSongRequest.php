<?php

namespace App\Http\Requests\Song;

use App\DTOs\Song\UpdateSongDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSongRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'  => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'lyrics' => ['nullable', 'string'],
            'notes'  => ['nullable', 'string'],
        ];
    }

    public function toDTO(): UpdateSongDTO
    {
        return new UpdateSongDTO(
            id: (int) $this->route('song'),
            title: $this->input('title'),
            author: $this->input('author'),
            lyrics: $this->input('lyrics'),
            notes: $this->input('notes'),
        );
    }
}
