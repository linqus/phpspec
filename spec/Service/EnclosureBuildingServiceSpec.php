<?php

namespace spec\App\Service;

use App\Service\EnclosureBuildingService;
use PhpSpec\ObjectBehavior;

class EnclosureBuildingServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EnclosureBuildingService::class);
    }
}
