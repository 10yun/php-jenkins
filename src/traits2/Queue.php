<?php

use shiyunJK\Consts\URL;

trait Queue
{
    /**
     * @return \shiyunJK\Jenkins\Queue
     * @throws \RuntimeException
     */
    public function getQueue()
    {
        $url  = $this->baseUrl . URL::API_QUEUE_INFO;
        $curl = curl_init($url);

        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);

        $this->validateCurl($curl, sprintf('Error during getting information for queue on %s', $this->baseUrl));

        $infos = json_decode($ret);
        if (!$infos instanceof \stdClass) {
            throw new \RuntimeException('Error during json_decode');
        }

        return new \shiyunJK\Jenkins\Queue($infos, $this);
    }

    /**
     * @param \shiyunJK\Jenkins\JobQueue $queue
     *
     * @throws \RuntimeException
     * @return void
     */
    public function cancelQueue(\shiyunJK\Jenkins\JobQueue $queue)
    {
        $url = sprintf('queue/item/%s/cancelQueue',  $queue->getId());

        $curl = curl_init($url);
        curl_setopt($curl, \CURLOPT_POST, 1);

        $headers = array();

        if ($this->areCrumbsEnabled()) {
            $headers[] = $this->getCrumbHeader();
        }

        curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        curl_exec($curl);

        $this->validateCurl(
            $curl,
            sprintf('Error during stopping job queue #%s', $queue->getId())
        );
    }
}
