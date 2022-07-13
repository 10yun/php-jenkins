<?php

namespace shiyunJK\Jenkins;

use shiyunJK\Jenkins;

class Computer
{
    use TraitCom;

    /**
     * @var \stdClass
     */
    private $computer;


    /**
     * @param \stdClass $computer
     * @param Jenkins   $jenkins
     */
    public function __construct($computer, Jenkins $jenkins)
    {
        $this->computer = $computer;
        $this->setJenkins($jenkins);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->computer->displayName;
    }

    /**
     *
     * @return bool
     */
    public function isOffline()
    {
        return (bool) $this->computer->offline;
    }

    /**
     *
     * returns null when computer is launching
     * returns \stdClass when computer has been put offline
     *
     * @return null|\stdClass
     */
    public function getOfflineCause()
    {
        return $this->computer->offlineCause;
    }

    /**
     *
     * @return Computer
     */
    public function toggleOffline()
    {
        $this->getJenkins()->toggleOfflineComputer($this->getName());

        return $this;
    }
    /**
     * @param string $computerName
     *
     * @throws \RuntimeException
     * @return void
     */
    public function toggleOfflineComputer($computerName)
    {
        $url  = sprintf('%s/computer/%s/toggleOffline', $this->baseUrl, $computerName);
        $curl = curl_init($url);
        curl_setopt($curl, \CURLOPT_POST, 1);

        $headers = array();

        if ($this->areCrumbsEnabled()) {
            $headers[] = $this->getCrumbHeader();
        }

        curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        curl_exec($curl);

        $this->validateCurl($curl, sprintf('Error marking %s offline', $computerName));
    }

    /**
     *
     * @return Computer
     */
    public function delete()
    {
        $this->getJenkins()->deleteNode($this->getName());
        return $this;
    }
    /**
     * @return string
     */
    public function getConfiguration()
    {
        return $this->getJenkins()->getComputerConfiguration($this->getName());
    }
}
