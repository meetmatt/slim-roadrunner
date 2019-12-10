<?php

namespace MeetMatt\SlimRoadRunner\Spiral;

use Spiral\Goridge\StreamRelay;

class StandardStreamRelay extends StreamRelay
{
    public function __construct()
    {
        parent::__construct(STDIN, STDOUT);
    }
}