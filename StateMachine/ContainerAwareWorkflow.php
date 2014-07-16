<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 16/07/14
 * Time: 10:43
 */

namespace Ftven\StateMachineBundle\StateMachine;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareWorkflow extends Workflow implements ContainerAwareInterface {
    /**
     * @var ContainerInterface
     */
    private $container;

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

    protected function loadContextProvider($contextProviderClass)
    {
        $this->contextProvider = $this->container->get($contextProviderClass);
    }

    protected function loadStep($stepServiceId)
    {
        return new ContainerAwareStep($this->container, $stepServiceId);
    }


}