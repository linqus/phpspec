<?php

namespace spec\App\Entity;

use App\Entity\Dinosaur;
use PhpSpec\ObjectBehavior;

class DinosaurSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Dinosaur::class);
    }
}
