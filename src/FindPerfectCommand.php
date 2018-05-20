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

class FindPerfectCommand extends Command
{
    protected function configure()
    {
        $this->setName('find-perfect')
            ->setDescription('Finds perfect (integer) GROSS values for given NET and fee.')
            ->addArgument('fee', InputArgument::REQUIRED)
            ->addArgument('net', InputArgument::REQUIRED)
            ->addOption(
                'limit',
                'l',
                InputOption::VALUE_OPTIONAL,
                'Limit of calculated values.',
                10
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $style = new TableStyle();
        $style->setPadType(STR_PAD_BOTH);
        $table->setStyle($style);

        $percent = $input->getArgument('fee');
        $value = $input->getArgument('net');

        $table->setHeaders(
            [
                [new TableCell(sprintf('Calculation for tax: %d%%', $percent), array('colspan' => 3))],
                ['NET', 'GROSS', 'FEE'],
            ]
        );

        $rows = [];

        for ($i = $input->getOption('limit'); $i !== 0; $value++) {

            $result = (100 * $value) / (100 - $percent);

            if (is_int($result)) {
                $i--;

                $rows[] = [
                    $value,
                    $result,
                    $result - $value,
                ];
            }
        }

        $table->setRows($rows);
        $table->render();
    }
}