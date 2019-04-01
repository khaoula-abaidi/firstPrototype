<?php

namespace App\Command;

use App\Entity\Contributor;
use App\Entity\Decision;
use App\Entity\Document;
use App\Repository\ContributorRepository;
use App\Repository\DocumentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateDecisionCommand extends Command
{
    protected static $defaultName = 'decision:create';
    private $documentRepository;
    private $contributorRepository;
    private $manager;
    public function __construct(ContributorRepository $contributorRepository, DocumentRepository $documentRepository, ObjectManager $manager)
    {
        parent::__construct();
        $this->manager = $manager;
        $this->contributorRepository = $contributorRepository;
        $this->documentRepository = $documentRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a deposit decision for a document related to a contributor not yet into HAL')
            ->addArgument('admin',
                InputArgument::OPTIONAL,
                'Administrator multiple decisions')
            ->addOption('document',
                'd',
                InputOption::VALUE_REQUIRED,
                'The identifiant of the document concerned about the deposit')
            ->addOption('contributor',
                'c',
                InputOption::VALUE_REQUIRED,
                'The identifiant of the contributor concerned about the deposit')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $admin = $input->getArgument('admin');
        $docID = $input->getOption('document');
        $conID = $input->getOption('contributor');
        if ($admin) {
            //Operations created by the administrator
            $io->note(sprintf('You passed an argument: %s', $admin));
        }
        else{

            /**
             * Getting the Document's informations having id = $docID
             */
            /**
             * @var Document
             */
            $document = new Document();
            $document = $this->documentRepository->find($docID);
            /**
             * Getting the Contributor's informations having id = $conID
             */
            /**
             * @var Contributor
             */
            $contributor = new Contributor();
            $contributor = $this->contributorRepository->find($conID);
            /**
             * Adding the new Decision (isTaken = false)
             */
            $decision = new Decision();
            $decision->setContent('En cours de construction')
                ->addDocument($document)
                     ->addContributor($contributor)
                     ->setAllowedAt(new \DateTime())
                     ->setIsTaken(false);
            /**
             * Persist the Decision and Flush into the Database
             */
            $this->manager->persist($decision);
            $this->manager->flush();
        }

        $io->success('Félicitations : Les décisions sont crées et en cours d\'attente des contributeurs .');
    }
}
