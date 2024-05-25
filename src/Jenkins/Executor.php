<?php

namespace shiyunJK\Jenkins;

use shiyunJK\Jenkins;

class Executor
{
    use TraitCom;
    /**
     * @var \stdClass
     */
    private $executor;

    protected string $computer;

    /**
     * @param \stdClass $executor
     * @param string    $computer
     * @param Jenkins   $jenkins
     */
    public function __construct($executor, $computer, Jenkins $jenkins)
    {
        $this->executor = $executor;
        $this->computer = $computer;
        $this->setJenkins($jenkins);
    }

    /**
     * @return string
     */
    public function getComputer()
    {
        return $this->computer;
    }

    /**
     * @return int
     */
    public function getProgress()
    {
        return $this->executor->progress;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->executor->number;
    }


    /**
     * @return int|null
     */
    public function getBuildNumber()
    {
        $number = null;
        if (isset($this->executor->currentExecutable)) {
            $number = $this->executor->currentExecutable->number;
        }

        return $number;
    }

    /**
     * @return null|string
     */
    public function getBuildUrl()
    {
        $url = null;
        if (isset($this->executor->currentExecutable)) {
            $url = $this->executor->currentExecutable->url;
        }

        return $url;
    }

    /**
     * @return void
     */
    public function stop()
    {
        $this->getJenkins()->stopExecutor($this);
    }
}
