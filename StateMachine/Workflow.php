<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 15/07/14
 * Time: 16:45
 */

namespace Ftven\StateMachineBundle\StateMachine;


class Workflow {
    /**
     * @var Context
     */
    protected $context = null;

    protected $status;

    protected $jobId;

    protected $type;

    /**
     * @var ContextProvider
     */
    protected $contextProvider = null;

    protected $stepCollection = array();

    public function __construct($jobId, $type)
    {
        $this->jobId = $jobId;
        $this->type = $type;
    }

    public function init($xmlPath, Context $rowContext = null)
    {
        // lecture XML configuration du workflow (le path de base du XML est en conf)
        // todo une classe qui permet de déterminer le path du XML en fonction du type ?????
        $workflowConfiguration = simplexml_load_file($xmlPath . '/' . $this->type . '.xml');

        // instanciation contexteProvider
        $this->loadContextProvider((string)$workflowConfiguration->attributes()->ContextProviderClass);

        // instanciation des Steps
        foreach ($workflowConfiguration->children() as $childElement)
        {
            $this->stepCollection[] = $this->loadStep((string)$childElement->attributes()->service);
        }

        // charger contexte
        if (null === $rowContext && !is_null($this->contextProvider))
        {
            $this->context = $this->contextProvider->loadContext();
        } else {
            $this->context = $rowContext;
        }
    }

    /**
     * @param $stepServiceId
     * @return Step
     */
    protected function loadStep($stepServiceId)
    {
        return new Step($stepServiceId);
    }

    /**
     * @param $contextProviderClass
     */
    protected function loadContextProvider($contextProviderClass)
    {
        if (class_exists($contextProviderClass))
        {
            $this->contextProvider = new $contextProviderClass;
        }
    }

    /**
     *
     */
    public function resume()
    {
        foreach ($this->stepCollection as $step)
        {
            if($step->canExecute($this->context))
            {
                try{
                    $result = $step->execute($this->context);
                    var_dump($this->context->getData());
                } catch(Exception $e){
                    // TODO
                }
                $this->contextProvider->saveContext($this->context);
            }
        }
    }
} 