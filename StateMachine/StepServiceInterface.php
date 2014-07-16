<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 16/07/14
 * Time: 11:16
 */

namespace Ftven\StateMachineBundle\StateMachine;


interface StepServiceInterface {
    public function canExecute(Context $context);
    public function execute(Context $context);
} 