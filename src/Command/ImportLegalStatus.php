<?php

namespace App\Command;

use App\Entity\LegalStatus;
use App\Services\ReadCsvFile;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportLegalStatus extends Command
{
    public static $defaultName = 'app:import-legal-status';
    private ReadCsvFile $readCsvFile;
    private string $fileName = "legalStatus.csv";
    private string $path = __DIR__ . '/../Resources/';
    private EntityManagerInterface $entityManager;

    public function __construct(ReadCsvFile $readCsvFile, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->readCsvFile = $readCsvFile;
        $this->entityManager = $entityManager;
    }


    protected function configure(): void
    {
        $this
            ->setHelp('This Command allow to import legal status from a csv file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Importation begin',
            '============',
        ]);

        $legalStatus = $this->readCsvFile->readCsvFile($this->path . $this->fileName);
        if (count($legalStatus) !== 0) {
            foreach ($legalStatus as $status) {
                $this->_addNewLegalStatus($status[0]);
            }
        }

        $output->writeln([
            'Importation finish : ' . count($legalStatus) . ' item imported',
            '============',
        ]);

        return 1;
    }

    private function _addNewLegalStatus(string $label): void {
        $legalStatus = new LegalStatus();
        $legalStatus->setName($label);

        try{
            $this->entityManager->persist($legalStatus);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}