<?php

namespace shiyunJK\Jenkins;

use shiyunJK\Jenkins;

class JobQueue
{
    use TraitCom;
    /**
     * @var \stdClass
     */
    private $jobQueue;

    /**
     * @param \stdClass $jobQueue
     * @param Jenkins   $jenkins
     */
    public function __construct($jobQueue, Jenkins $jenkins)
    {
        $this->jobQueue = $jobQueue;
        $this->setJenkins($jenkins);
    }

    /**
     * @return array
     */
    public function getInputParameters()
    {
        $parameters = array();

        if (!property_exists($this->jobQueue->actions[0], 'parameters')) {
            return $parameters;
        }

        foreach ($this->jobQueue->actions[0]->parameters as $parameter) {
            $parameters[$parameter->name] = $parameter->value;
        }

        return $parameters;
    }

    /**
     * @return string
     */
    public function getJobName()
    {
        return $this->jobQueue->task->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->jobQueue->id;
    }

    /**
     * @return void
     */
    public function cancel()
    {
        $this->getJenkins()->cancelQueue($this);
    }
}
