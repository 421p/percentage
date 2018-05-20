<?php

namespace Percentage;

class Application extends \Symfony\Component\Console\Application
{
    public function __construct(string $name = 'UNKNOWN', string $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->add(new CalculateCommand());
        $this->add(new FindPerfectCommand());
    }
}