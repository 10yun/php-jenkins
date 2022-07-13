<?php

trait Build
{


    /**
     * @param        $job
     * @param        $buildId
     * @param string $tree
     *
     * @return Jenkins\Build
     * @throws \RuntimeException
     */
    public function getBuild($job, $buildId, $tree = 'actions[parameters,parameters[name,value]],result,duration,timestamp,number,url,estimatedDuration,builtOn')
    {
        if ($tree !== null) {
            $tree = sprintf('?tree=%s', $tree);
        }
        $url  = sprintf('%s/job/%s/%d/api/json%s', $this->baseUrl, $job, $buildId, $tree);
        $curl = curl_init($url);

        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);

        $this->validateCurl(
            $curl,
            sprintf('Error during getting information for build %s#%d on %s', $job, $buildId, $this->baseUrl)
        );

        $infos = json_decode($ret);

        if (!$infos instanceof \stdClass) {
            return null;
        }

        return new \shiyunJK\Jenkins\Build($infos, $this);
    }

    /**
     * @param string $job
     * @param int    $buildId
     *
     * @return null|string
     */
    public function getUrlBuild($job, $buildId)
    {
        return (null === $buildId) ?
            sprintf('%s/job/%s', $this->baseUrl, $job)
            : sprintf('%s/job/%s/%d', $this->baseUrl, $job, $buildId);
    }
}
