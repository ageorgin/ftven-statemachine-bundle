<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 15/07/14
 * Time: 16:52
 */

namespace Ftven\StateMachineBundle\StateMachine;


class Step {

    protected $stepServiceId = null;

    /**
     * @var StepServiceInterface
     */
    protected $stepService = null;

    public function __construct($stepServiceId)
    {
        $this->stepServiceId = $stepServiceId;
        $this->loadStepService();
    }

    /**
     *
     */
    protected function loadStepService()
    {
        if (is_class($this->stepServiceId))
        {
            $this->stepService = new $this->stepServiceId;
        }
    }

    /**
     * @param Context $context
     * @return mixed
     */
    public function canExecute(Context $context)
    {
        return $this->stepService->canExecute($context);
    }

    /**
     * @param Context $context
     * @return mixed
     */
    public function execute(Context $context)
    {
        return $this->stepService->execute($context);
    }
} 