<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 16/07/14
 * Time: 11:12
 */

namespace Ftven\StateMachineBundle\StateMachine;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareStep extends Step implements ContainerAwareInterface {
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container, $stepServiceId)
    {
        $this->container = $container;
        parent::__construct($stepServiceId);
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

    protected function loadStepService()
    {
        $this->stepService = $this->container->get($this->stepServiceId);
    }


} 