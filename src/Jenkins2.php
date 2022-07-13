<?php

namespace shiyunJK;

class Jenkins
{
    /**
     * SDK Version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Jenkins Base URL
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * @var null
     */
    private $jenkins = null;

    /**
     * Whether or not to retrieve and send anti-CSRF crumb tokens
     * with each request
     *
     * Defaults to false for backwards compatibility
     *
     * @var boolean
     */
    private $crumbsEnabled = false;

    /**
     * The anti-CSRF crumb to use for each request
     *
     * Set when crumbs are enabled, by requesting a new crumb from Jenkins
     *
     * @var string
     */
    private $crumb;

    /**
     * The header to use for sending anti-CSRF crumbs
     *
     * Set when crumbs are enabled, by requesting a new crumb from Jenkins
     *
     * @var string
     */
    private $crumbRequestField;

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Enable the use of anti-CSRF crumbs on requests
     *
     * @return void
     */
    public function enableCrumbs()
    {
        $this->crumbsEnabled = true;

        $crumbResult = $this->requestCrumb();

        if (!$crumbResult || !is_object($crumbResult)) {
            $this->crumbsEnabled = false;

            return;
        }

        $this->crumb             = $crumbResult->crumb;
        $this->crumbRequestField = $crumbResult->crumbRequestField;
    }

    /**
     * Disable the use of anti-CSRF crumbs on requests
     *
     * @return void
     */
    public function disableCrumbs()
    {
        $this->crumbsEnabled = false;
    }

    /**
     * Get the status of anti-CSRF crumbs
     *
     * @return boolean Whether or not crumbs have been enabled
     */
    public function areCrumbsEnabled()
    {
        return $this->crumbsEnabled;
    }

    public function requestCrumb()
    {
        $url = sprintf('%s/crumbIssuer/api/json', $this->baseUrl);

        $curl = curl_init($url);

        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);

        $ret = curl_exec($curl);

        $this->validateCurl($curl, 'Error getting csrf crumb');

        $crumbResult = json_decode($ret);

        if (!$crumbResult instanceof \stdClass) {
            throw new \RuntimeException('Error during json_decode of csrf crumb');
        }

        return $crumbResult;
    }

    public function getCrumbHeader()
    {
        return "$this->crumbRequestField: $this->crumb";
    }

    /**
     * @return boolean
     */
    public function isAvailable()
    {
        $curl = curl_init($this->baseUrl . '/api/json');
        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        curl_exec($curl);

        if (curl_errno($curl)) {
            return false;
        } else {
            try {
                $this->getQueue();
            } catch (RuntimeException $e) {
                //en cours de lancement de jenkins, on devrait passer par là
                return false;
            }
        }

        return true;
    }
    protected function jenkinsRequest($request, $addCrumb = true, $resolveAuth = true)
    {
        try {
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return void
     * @throws \RuntimeException
     */
    private function initialize()
    {
        if (null !== $this->jenkins) {
            return;
        }
        $curl = curl_init($this->baseUrl . '/api/json');
        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);

        $this->validateCurl($curl, sprintf('Error during getting list of jobs on %s', $this->baseUrl));

        $this->jenkins = json_decode($ret);
        if (!$this->jenkins instanceof \stdClass) {
            throw new \RuntimeException('Error during json_decode');
        }
    }


    /**
     * @param string $computerName
     *
     * @return Jenkins\Computer
     * @throws \RuntimeException
     */
    public function getComputer($computerName)
    {
        $url  = sprintf('%s/computer/%s/api/json', $this->baseUrl, $computerName);
        $curl = curl_init($url);

        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);

        $this->validateCurl(
            $curl,
            sprintf('Error during getting information for computer %s on %s', $computerName, $this->baseUrl)
        );

        $infos = json_decode($ret);

        if (!$infos instanceof \stdClass) {
            return null;
        }

        return new \shiyunJK\Jenkins\Computer($infos, $this);
    }

    /**
     * @param Jenkins\Executor $executor
     *
     * @throws \RuntimeException
     */
    public function stopExecutor(Jenkins\Executor $executor)
    {
        $url = sprintf(
            '%s/computer/%s/executors/%s/stop',
            $this->baseUrl,
            $executor->getComputer(),
            $executor->getNumber()
        );

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
            sprintf('Error during stopping executor #%s', $executor->getNumber())
        );
    }


    /**
     * @param string $jobname
     * @param string $buildNumber
     *
     * @return string
     */
    public function getConsoleTextBuild($jobname, $buildNumber)
    {
        $url  = sprintf('%s/job/%s/%s/consoleText', $this->baseUrl, $jobname, $buildNumber);
        $curl = curl_init($url);
        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($curl);
    }

    /**
     * @param string $jobName
     * @param        $buildId
     *
     * @return array
     * @internal param string $buildNumber
     *
     */
    public function getTestReport($jobName, $buildId)
    {
        $url  = sprintf('%s/job/%s/%d/testReport/api/json', $this->baseUrl, $jobName, $buildId);
        $curl = curl_init($url);

        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);

        $errorMessage = sprintf(
            'Error during getting information for build %s#%d on %s',
            $jobName,
            $buildId,
            $this->baseUrl
        );

        $this->validateCurl(
            $curl,
            $errorMessage
        );

        $infos = json_decode($ret);

        if (!$infos instanceof \stdClass) {
            throw new \RuntimeException($errorMessage);
        }

        return new \shiyunJK\Jenkins\TestReport($this, $infos, $jobName, $buildId);
    }

    /**
     * Returns the content of a page according to the jenkins base url.
     * Useful if you use jenkins plugins that provides specific APIs.
     * (e.g. "/cloud/ec2-us-east-1/provision")
     *
     * @param string $uri
     * @param array  $curlOptions
     *
     * @return string
     */
    public function execute($uri, array $curlOptions)
    {
        $url  = $this->baseUrl . '/' . $uri;
        $curl = curl_init($url);
        curl_setopt_array($curl, $curlOptions);
        $ret = curl_exec($curl);

        $this->validateCurl($curl, sprintf('Error calling "%s"', $url));

        return $ret;
    }

    /**
     * @return Jenkins\Computer[]
     */
    public function getComputers()
    {
        $return = $this->execute(
            '/computer/api/json',
            array(
                \CURLOPT_RETURNTRANSFER => 1,
            )
        );
        $infos  = json_decode($return);
        if (!$infos instanceof \stdClass) {
            throw new \RuntimeException('Error during json_decode');
        }
        $computers = array();
        foreach ($infos->computer as $computer) {
            $computers[] = $this->getComputer($computer->displayName);
        }

        return $computers;
    }

    /**
     * @param string $computerName
     *
     * @return string
     */
    public function getComputerConfiguration($computerName)
    {
        return $this->execute(sprintf('/computer/%s/config.xml', $computerName), array(\CURLOPT_RETURNTRANSFER => 1,));
    }

    /**
     * Validate curl_error() and http_code in a cURL request
     *
     * @param $curl
     * @param $errorMessage
     */
    private function validateCurl($curl, $errorMessage)
    {

        if (curl_errno($curl)) {
            throw new \RuntimeException($errorMessage);
        }
        $info = curl_getinfo($curl);

        if ($info['http_code'] === 403) {
            throw new \RuntimeException(sprintf('Access Denied [HTTP status code 403] to %s"', $info['url']));
        }
    }
}
