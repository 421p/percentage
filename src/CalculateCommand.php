<?php

namespace Percentage;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateCommand extends Command
{
    protected function configure()
    {
        $this->setName('calculate')
            ->setDescription('Calculates GROSS for given NET and fee.')
            ->addArgument('fee', InputArgument::REQUIRED)
            ->addArgument('net', InputArgument::REQUIRED)
            ->addOption(
                'clean',
                'c',
                InputOption::VALUE_NONE,
                'Show result as a string.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $percent = $input->getArgument('fee');
        $value = $input->getArgument('net');

        $result = round((100 * $value) / (100 - $percent), 2);

        if ($input->getOption('clean')) {
            $output->writeln($result);
        } else {
            $table = new Table($output);
            $style = new TableStyle();
            $style->setPadType(STR_PAD_BOTH);
            $table->setStyle($style);

            $table->setHeaders(
                [
                    [new TableCell(sprintf('Calculation for tax: %d%%', $percent), array('colspan' => 3))],
                    ['NET', 'GROSS', 'FEE'],
                ]
            );

            $table->addRow([$value, $result, $result - $value]);

            $table->render();
        }
    }
}