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

    /**
     * @var Security[]
     */
    private $securities = [];

    public function __construct(bool $withBasicSecurity = false, array $dinosaurs = [])
    {
        if ($withBasicSecurity) {
            $this->addSecurity(new Security('fence', true, $this));
        }

        
        foreach ($dinosaurs as $dinosaur) {
            $this->addDinosaur($dinosaur);
        }
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }

    public function getDinosaurs(): array
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur)
    {
        if (!$this->canAddDinosaur($dinosaur)) {
            throw new NotABuffetException('Do not mix carnivorous and non-carnivorous dinosaurs in the same enclosure');
        }

        if (!$this->isSecurityActive()) {
            throw new DinosaursAreRunningRampantException('Are you craaazy?');
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

    public function isSecurityActive(): bool
    {
        foreach ($this->securities as $security) {
            if ($security->getIsActive()) {
                return true;
            }
        }

        return false;
    }
}
