<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 15/07/14
 * Time: 17:15
 */

namespace Ftven\StateMachineBundle\Command;


use Ftven\StateMachineBundle\StateMachine\ContainerAwareJobEngine;
use Ftven\StateMachineBundle\StateMachine\JobEngine;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StateMachineCommand extends ContainerAwareCommand {
    public function configure()
    {
        $this
            ->setName('statemachine:run')
            ->setDescription('todo');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $jobEngine = new JobEngine($this->getContainer()->getParameter('ftven_state_machine.conf.path'));
        $jobEngine = new ContainerAwareJobEngine($this->getContainer());
        $jobEngine->setJobs(array(array('jobId' => 1, 'jobType' => 'test')));
        $jobEngine->executeJobs();
    }
} 