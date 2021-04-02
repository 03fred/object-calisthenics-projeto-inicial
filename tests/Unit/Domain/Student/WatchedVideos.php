<?php

use Alura\Calisthenics\Domain\Video\Video;

class WatchedVideos implements Countable
{
    private Map $videos;

    public function __construct()
    {
        $this->videos = new Map();
    }

    public function add(Video $video, DateTimeInterface $date): void
    {
        $this->videos->put($video, $date);
    }

    public function count(): int
    {
        return $this->videos->count();
    }

    public function dataOfFirstVide(): DateTimeInterface
    {
        $this->videos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
        /** @var DateTimeInterface $firstDate */
        return  $this->videos->first()->value;
    }
}
