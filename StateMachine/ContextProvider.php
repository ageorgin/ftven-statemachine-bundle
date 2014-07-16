<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 15/07/14
 * Time: 16:50
 */

namespace Ftven\StateMachineBundle\StateMachine;


interface ContextProvider {
    public function loadContext();

    public function saveContext(Context $context);
} 