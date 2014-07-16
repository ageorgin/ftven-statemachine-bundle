<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 15/07/14
 * Time: 16:45
 */

namespace Ftven\StateMachineBundle\StateMachine;


class Context {
    /**
     * @var mixed
     */
    private $data = null;

    private $jobId;

    public function __construct($jobId, $data = null)
    {
        $this->jobId = $jobId;
        $this->data = $data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $jobId
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    }

    /**
     * @return mixed
     */
    public function getJobId()
    {
        return $this->jobId;
    }


} 