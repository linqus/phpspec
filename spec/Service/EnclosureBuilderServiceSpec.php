<?php

namespace spec\App\Service;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
use App\Factory\DinosaurFactory;
use App\Service\EnclosureBuilderService;
use App\Service\EntityManagerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnclosureBuilderServiceSpec extends ObjectBehavior
{

    function let(DinosaurFactory $dinosaurFactory, EntityManagerInterface $entityManagerInterface)
    {
        $this->beConstructedWith($dinosaurFactory, $entityManagerInterface);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EnclosureBuilderService::class);
    }



    function it_builds_enclosure_with_dinosaurs(DinosaurFactory $dinosaurFactory, EntityManagerInterface $entityManagerInterface)
    {

        $dino1 = new Dinosaur('Steganosaurus',false);
        $dino1->setLength(6);

        $dino2 = new Dinosaur('Baby steganosaurus',false);
        $dino2->setLength(2);

        $dinosaurFactory->growVelociraptor(Argument::type('integer'))
            ->willReturn(
                $dino1,
                $dino2
            )
            ->shouldBeCalledTimes(2)
        ;
        //$dinosaurFactory->growVelociraptor(Argument::type('integer'))->shouldBeCalledTimes(2);
        

        $enclosure = $this->buildEnclosure(1, 2);

        $dinosaurFactory->growVelociraptor(Argument::any())
            ->shouldHaveBeenCalledTimes(2)
            //->shouldBeCalledTimes(2)
        ;

        $enclosure->shouldBeAnInstanceOf(Enclosure::class);
        $enclosure->isSecurityActive()->shouldReturn(true);

        $enclosure->getDinosaurs()[0]->shouldBe($dino1);
        $enclosure->getDinosaurs()[1]->shouldBe($dino2);

        $entityManagerInterface->persist(Argument::type(Enclosure::class))->shouldHaveBeenCalled();
        $entityManagerInterface->flush()->shouldHaveBeenCalled();
    }
}
