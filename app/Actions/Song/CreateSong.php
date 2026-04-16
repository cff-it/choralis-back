<?php

namespace App\Actions\Song;

use App\DTOs\Song\CreateSongDTO;
use App\Models\Song;
use App\Repositories\SongRepository;

class CreateSong
{
    public function __construct(private readonly SongRepository $songs) {}

    public function __invoke(CreateSongDTO $dto): Song
    {
        return $this->songs->create([
            'title'  => $dto->title,
            'author' => $dto->author,
            'lyrics' => $dto->lyrics,
            'notes'  => $dto->notes,
        ]);
    }
}
