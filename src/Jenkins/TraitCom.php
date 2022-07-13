<?php

namespace shiyunJK\Jenkins;

use shiyunJK\Jenkins;

trait TraitCom
{
    /**
     * @var Jenkins
     */
    private $jenkins;
    /**
     * @return Jenkins
     */
    public function getJenkins()
    {
        return $this->jenkins;
    }

    /**
     * @param Jenkins $jenkins 
     * @return $this
     */
    public function setJenkins(Jenkins $jenkins)
    {
        $this->jenkins = $jenkins;
        return $this;
    }
}
