<?php

namespace shiyunJK\Jenkins;

use shiyunJK\Jenkins;

class Queue
{
    use TraitCom;

    /**
     * @var \stdClass
     */
    private $queue;

    /**
     * @param \stdClass $queue
     * @param Jenkins   $jenkins
     */
    public function __construct($queue, Jenkins $jenkins)
    {
        $this->queue = $queue;
        $this->setJenkins($jenkins);
    }

    /**
     * @return array
     */
    public function getJobQueues()
    {
        $jobs = array();

        foreach ($this->queue->items as $item) {
            $jobs[] = new JobQueue($item, $this->getJenkins());
        }

        return $jobs;
    }
}
