<?php

namespace App\Entity;

class Dinosaur
{
    private $length = 0;
    private $genus;
    private $isCarnivorous;

    

    public function __construct(string $genus = 'Unknown', bool $isCarnivorous = false)
    {
        $this->genus = $genus;
        $this->isCarnivorous = $isCarnivorous;
    }

    public static function growVelociraptor(int $length): self
    {   
        $dinosaur = new static('Velociraptor', true);
        $dinosaur->setLength($length);
        return $dinosaur;
    }

    public function getGenus(): string
    {
        return $this->genus;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getDescription(): string
    {
        return sprintf('The %s %scarnivorous dinosaur is %d meter long', $this->genus, $this->isCarnivorous?'':'non-',$this->getLength());
    }

    public function isCarnivorous()
    {
        return $this->isCarnivorous;
    }

    public function hasSameDietAs(Dinosaur $dinosaur): bool
    {
        return $this->isCarnivorous() === $dinosaur->isCarnivorous();
    }

}
