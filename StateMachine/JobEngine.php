<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 15/07/14
 * Time: 17:41
 */

namespace Ftven\StateMachineBundle\StateMachine;


class JobEngine {
    protected $xmlWokflowDescription = '';
    protected $jobs = array();

    public function __construct($xmlWokflowDescription)
    {
        $this->xmlWokflowDescription = $xmlWokflowDescription;
    }

    public function executeJobs()
    {
        $jobCollection = $this->loadJobs();
        foreach ($jobCollection as $job) {
            $workflow = new Workflow($job['jobId'], $job['jobType']);
            $workflow->init($this->xmlWokflowDescription);
            $workflow->resume();
        }
    }

    /**
     * @return array
     */
    protected function loadJobs()
    {
        if (count($this->jobs) > 0) {
            return $this->jobs;
        } else {
            //todo
        }
        return array();
    }

    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }
} 