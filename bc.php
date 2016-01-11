<?php
declare(strict_types = 1);

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$console = new Application();

$console->register('eval')->setDefinition(
        array(
            new InputArgument('expression', InputArgument::REQUIRED, 'Arithmetic expression to evaluate'),
        )
    )
    ->setDescription('Evaluates a given arithmetic expression and writes the result to STDOUT')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) {

        }
    );

$console->run();