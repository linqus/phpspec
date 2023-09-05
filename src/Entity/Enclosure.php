<?php

namespace App\Entity;

use App\Exception\DinosaursAreRunningRampantException;
use App\Exception\NotABuffetException;

class Enclosure
{
    /** 
     * @var Dinosaur[]
     */
    private $dinosaurs = [];

    public function getDinosaurs(): array
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur)
    {
        if (!$this->canAddDinosaur($dinosaur)) {
            throw new NotABuffetException('Do not mix carnivorous and non-carnivorous dinosaurs in the same enclosure');
        }

        if (!$this->hasSecurityEnabled()) {
            throw new DinosaursAreRunningRampantException();
        }

        $this->dinosaurs[] = $dinosaur;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        if (count($this->dinosaurs) === 0) {
            return true;
        }

        return $this->dinosaurs[0]->hasSameDietAs($dinosaur);
    }

    public function hasSecurityEnabled(): bool
    {
        return false;
    }
}
