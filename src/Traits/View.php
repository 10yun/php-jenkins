<?php

namespace shiyunJK\Traits;

use shiyunJK\Consts\URL;
use shiyunJK\Exceptions\JenkinsException;

/**
 * Trait View
 *
 * @package shiyunJK\Traits
 */
trait View
{

    /**
     * Get list of jobs on the view specified.
     * Each job is a dictionary with 'name', 'url', 'color' and 'fullname' keys.
     * The list of jobs is limited to only those configured in the specified view.
     * Each job dictionary 'fullname' key is equal to the job name.
     *
     * @param string $name Name of a Jenkins view for which to retrieve jobs
     * @return array list of jobs
     */
    public function getViewJobs($name)
    {
        $paths = $this->getJobFolder($name);

        $response = $this->jenkinsRequest([
            'GET', $this->buildUrl(URL::API_VIEW_SUBJOBS, $paths),
        ]);

        $data = $this->getResponseFalseOrContents($response);

        if ($data === false) {
            throw new JenkinsException("view[{$name}] does not exist");
        }

        return $data['jobs'];
    }

    /**
     * Get list of views running.
     * Each view is a dictionary with 'name' and 'url' keys.
     *
     * @return array list of views
     */
    public function getViews()
    {
        return $this->getInfo()['views'];
    }

    /**
     * Delete Jenkins view permanently.
     *
     * @param string $name Name of Jenkins view
     * @return bool|int
     */
    public function deleteView($name)
    {
        $paths = $this->getJobFolder($name);

        $response = $this->jenkinsRequest([
            'POST', $this->buildUrl(URL::API_VIEW_DELETE, $paths),
        ]);

        return $this->getResponseTrueOrStatusCode($response);
    }

    /**
     * Create a new Jenkins view
     *
     * @param string $name Name of Jenkins view
     * @param string $configXml config file text
     * @return bool|int
     * @throws \shiyunJK\Exceptions\JenkinsException
     */
    public function createView($name, $configXml)
    {
        $paths = $this->getJobFolder($name);

        $response = $this->jenkinsRequest([
            'POST', $this->buildUrl(URL::API_VIEW_CREATE, $paths), [
                'body' => $configXml,
                'headers' => ['Content-Type' => URL::DEFAULT_CONTENT_TYPE],
            ]
        ]);

        if ($response->getStatusCode() == 400) {
            throw new JenkinsException("view[{$name}] already exists");
        }

        return $this->getResponseTrueOrStatusCode($response);
    }

    /**
     * Change configuration of existing Jenkins view.
     * To create a new view, see Jenkins::createView
     *
     * @param string $name Name of Jenkins view
     * @param string $configXml New XML configuration
     * @return bool|int
     */
    public function reconfigView($name, $configXml)
    {
        $paths = $this->getJobFolder($name);

        $response = $this->jenkinsRequest([
            'POST', $this->buildUrl(URL::API_VIEW_CONFIG, $paths), [
                'body' => $configXml,
                'headers' => ['Content-Type' => URL::DEFAULT_CONTENT_TYPE],
            ]
        ]);

        return $this->getResponseTrueOrStatusCode($response);
    }

    /**
     * Get configuration of existing Jenkins view.
     *
     * @param string $name Name of Jenkins view
     * @return string|bool view configuration (XML format), False if not exists.
     */
    public function getViewConfig($name)
    {
        $paths = $this->getJobFolder($name);

        $response = $this->jenkinsRequest([
            'GET', $this->buildUrl(URL::API_VIEW_CONFIG, $paths),
        ]);

        if ($response->getStatusCode() != 200) {
            return false;
        }

        return $response->getBody()->getContents();
    }
}
