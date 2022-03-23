<?php

namespace App\Command;

use App\Entity\Actor;
use App\Entity\Director;
use App\Entity\Film;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';
    protected static $defaultDescription = 'Add a short description for your command';

    public function  __construct(ManagerRegistry $doctrine)
    {
        parent::__construct();
        $this->entityManager =  $doctrine->getManager();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Import CSV file:
        $csv = Reader::createFromPath('IMDb movies.csv')
            ->setHeaderOffset(0)
        ;
        $progressBar = new ProgressBar($output, 100);
        foreach ($csv as $record) {
            //Validate records:
            $date_published = $this->checkDatetime($record['date_published']);
            //Insert in database the film:
            $date_published ? $id_film = $this->entityManager->getRepository(Film::class)->createFilm($record) : $id_film = null;
            if(!is_null($id_film))
            {
                //Insert in database the directors:
                $directors = $this->separateValues($record['director']);
                foreach($directors as $director) {
                    $this->entityManager->getRepository(Director::class)->createDirectors($id_film, $director);
                }
                //Insert in database the actors:
                $actors = $this->separateValues($record['actors']);
                foreach($actors as $actor) {
                    $this->entityManager->getRepository(Actor::class)->createActors($id_film, $actor);
                }
            }
            $progressBar->advance();
        }

        $io = new SymfonyStyle($input, $output);
        $progressBar->finish();
        $io->success('All films are imported correctly');

        return Command::SUCCESS;
    }

    public function checkDatetime(string $date): bool
    {
        $dt = DateTime::createFromFormat("Y-m-d", $date);
        return $dt !== false && !array_sum($dt::getLastErrors());
    }

    public function separateValues(string $directors): array
    {
        return explode(',',$directors);
    }
}
