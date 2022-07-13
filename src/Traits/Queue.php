<?php

namespace shiyunJK\Traits;

use shiyunJK\Consts\URL;
use shiyunJK\Exceptions\JenkinsException;

/**
 * Trait Queue
 *
 * @package shiyunJK\Traits
 */
trait Queue
{
    /**
     * Get information about a queued item (to-be-created job).
     *
     * @param int $number queue number
     * @param int $depth JSON depth
     * @return array|bool
     */
    public function getQueueItem($number, $depth = 0)
    {
        $response = $this->jenkinsRequest([
            'GET', $this->buildUrl(URL::Q_ITEM, compact('number', 'depth'))
        ]);

        return $this->getResponseFalseOrContents($response);
    }

    /**
     * Get queue information
     *
     * @return array|bool
     */
    public function getQueueInfo()
    {
        $response = $this->jenkinsRequest([
            'GET', $this->buildUrl(URL::Q_INFO)
        ]);

        return $this->getResponseFalseOrContents($response);
    }


    /**
     * Cancel a queued build.
     *
     * @param int $id Jenkins job id number for the build
     * @return bool|int
     */
    public function cancelQueue($id)
    {
        $response = $this->jenkinsRequest([
            'POST', $this->buildUrl(URL::CANCEL_QUEUE, compact('id')),
            ['headers' => ['Referer' => $this->baseUrl,]],
        ]);

        return $this->getResponseTrueOrStatusCode($response);
    }
}
