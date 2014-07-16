<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 16/07/14
 * Time: 10:47
 */

namespace Ftven\StateMachineBundle\StateMachine;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareJobEngine extends JobEngine implements ContainerAwareInterface {
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct(null);
        $this->container = $container;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function executeJobs()
    {
        $jobCollection = $this->loadJobs();
        foreach ($jobCollection as $job) {
            $workflow = new ContainerAwareWorkflow($job['jobId'], $job['jobType']);
            $workflow->setContainer($this->container);
            $workflow->init($this->container->getParameter('ftven_state_machine.conf.path'));
            $workflow->resume();
        }
    }
} 