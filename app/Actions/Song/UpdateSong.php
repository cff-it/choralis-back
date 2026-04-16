<?php

namespace App\Actions\Song;

use App\DTOs\Song\UpdateSongDTO;
use App\Models\Song;
use App\Repositories\SongRepository;

class UpdateSong
{
    public function __construct(private readonly SongRepository $songs) {}

    public function __invoke(UpdateSongDTO $dto): Song
    {
        $song = $this->songs->findById($dto->id);

        return $this->songs->update($song, [
            'title'  => $dto->title,
            'author' => $dto->author,
            'lyrics' => $dto->lyrics,
            'notes'  => $dto->notes,
        ]);
    }
}
