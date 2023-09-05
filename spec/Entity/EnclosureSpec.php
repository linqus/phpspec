<?php

namespace spec\App\Entity;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
use App\Exception\DinosaursAreRunningRampantException;
use App\Exception\NotABuffetException;
use App\Factory\DinosaurFactory;
use PhpSpec\ObjectBehavior;

class EnclosureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Enclosure::class);
    }

    function it_should_have_no_dinosaurs_by_default()
    {
        $this->getDinosaurs()->shouldHaveCount(0);
    }

    function it_should_be_able_to_add_dinosaurs()
    {
        $this->addDinosaur(new Dinosaur());
        $this->addDinosaur(new Dinosaur());

        $this->getDinosaurs()->shouldHaveCount(2);
    }

    function it_should_not_allow_to_add_carnivorous_dinosaurs_to_not_carnivorous_enclosure()
    {
        $this->addDinosaur(new Dinosaur('Triceratops', false));

        $this->shouldThrow(NotABuffetException::class)
            ->during('addDinosaur', [new Dinosaur('Tyrannosaurus', true)]);
    }

    function it_should_not_allow_to_add_dinosaurs_to_unsecured_enclosure()
    {
        //$this->shouldNotHaveSecurityEnabled();
        $this->shouldThrow(new DinosaursAreRunningRampantException('Are you craaazy?'))
            ->duringAddDinosaur(new Dinosaur('Velociraptor', true));
    }
}
