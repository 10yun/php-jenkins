<?php

namespace shiyunJK\traits2;

trait Http
{
    public function curlGet()
    {
    }
    public function curlPost($url, $params = null, $errMsg = '', $curlOpt = [])
    {
        $curl = curl_init($url);

        if (!empty($curlOpt['CURLOPT_RETURNTRANSFER'])) {
            curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
        }
        curl_setopt($curl, \CURLOPT_POST, 1);

        if (!empty($params)) {
            curl_setopt($curl, \CURLOPT_POSTFIELDS, http_build_query($params));
        }
        $headers = array();
        if ($this->areCrumbsEnabled()) {
            $headers[] = $this->getCrumbHeader();
        }
        curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \RuntimeException($errMsg);
        }
        $info = curl_getinfo($curl);
        if ($info['http_code'] === 403) {
            throw new \RuntimeException(sprintf('Access Denied [HTTP status code 403] to %s"', $info['url']));
        }
    }

    public function curlPoFile($url, $params = null, $errMsg = '', $curlOpt = [])
    {
    }
}
