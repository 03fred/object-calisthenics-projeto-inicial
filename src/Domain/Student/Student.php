<?php

namespace Alura\Calisthenics\Domain\Student;

use Address;
use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Video\Video;
use DateTimeImmutable;
use DateTimeInterface;
use FullName;
use WatchedVideos;

class Student
{
    private string $email;
    private DateTimeInterface $birthDate;
    private WatchedVideos $map;
    private $fullName;

    public function __construct(Email $email, DateTimeInterface $birthDate, FullName $fullName, Address $address)
    {
        $this->watchedVideos = $this->map;
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->fullName = $fullName;
    }

    public function getFullName(): string
    {
        return (string) $this->fullName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() ===  0) {
            return true;
        }

        $firstDate = $this->watchedVideos->dataOfFirstVide();
        $today = new DateTimeImmutable();

        return $firstDate->diff($today)->days <  90;
    }

    public function age(): int
    {
        $today = new DateTimeImmutable();
        return $this->birthDate->diff($today)->y;
    }
}
