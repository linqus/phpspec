<?php

namespace App\Factory;

use App\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptor(int $length):Dinosaur
    {
        return $this->createDinosaur('Velociraptor', true, $length);
    }

    private function createDinosaur(string $genus, bool $isCarnivour, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivour);
        $dinosaur->setLength($length);

        return $dinosaur;
    }
}
