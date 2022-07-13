<?php

namespace shiyunJK\Consts;

class URL
{
    const LAUNCHER_SSH = 'hudson.plugins.sshslaves.SSHLauncher';
    const LAUNCHER_COMMAND = 'hudson.slaves.CommandLauncher';
    const LAUNCHER_JNLP = 'hudson.slaves.JNLPLauncher';
    const LAUNCHER_WINDOWS_SERVICE = 'hudson.os.windows.ManagedWindowsServiceLauncher';
    const PARAM_CLASS = 'hudson.model.ParametersAction';
    const FOLDER_CLASS = 'com.cloudbees.hudson.plugins.folder.Folder';
    const VCS_GIT = 'hudson.plugins.git.util.BuildData';
    const VCS_SVN = '';
    const DEFAULT_CONTENT_TYPE = "text/xml; charset=utf-8";

    # REST Endpoints
    const INFO = '{folder_url}api/json';
    const PLUGIN_INFO = 'pluginManager/api/json?depth={depth}';
    const CRUMB_URL = 'crumbIssuer/api/json';
    const WHOAMI_URL = 'me/api/json?depth={depth}';
    const JOBS_QUERY = '?tree=jobs[url,color,name,jobs,fullName]';
    const JOB_INFO = '{folder_url}job/{short_name}/api/json?depth={depth}';
    const JOB_NAME = '{folder_url}job/{short_name}/api/json?tree=name';
    const API_QUEUE_INFO = 'queue/api/json?depth=0';
    const API_QUEUE_ITEM = 'queue/item/{number}/api/json?depth={depth}';
    const API_QUEUE_CANCEL = 'queue/cancelItem?id={id}';
    /**
     * job
     */
    const API_JOB_CREATE    = '{folder_url}createItem?name={short_name}';  # also post config.xml
    const API_JOB_CONFIG    = '{folder_url}job/{short_name}/config.xml';
    const API_JOB_DELETE    = '{folder_url}job/{short_name}/doDelete';
    const API_JOB_ENABLE    = '{folder_url}job/{short_name}/enable';
    const API_JOB_DISABLE   = '{folder_url}job/{short_name}/disable';
    const API_JOB_POLLING   = '{folder_url}job/{short_name}/polling';
    const API_JOB_RENAME    = '{from_folder_url}job/{from_short_name}/doRename?newName={to_short_name}';
    const COPY_JOB          = '{from_folder_url}createItem?name={to_short_name}&mode=copy&from={from_short_name}';
    /**
     * 
     */
    const SET_JOB_BUILD_NUMBER = '{folder_url}job/{short_name}/nextbuildnumber/submit';
    const WIPEOUT_JOB_WORKSPACE = '{folder_url}job/{short_name}/doWipeOutWorkspace';
    const BUILD_ALLS            = '{folder_url}job/{short_name}/api/json?tree=allBuilds[number,url]';
    /**
     * build构建
     */
    const BUILD_JOB             = '{folder_url}job/{short_name}/build';
    const BUILD_WITH_PARAMS_JOB = '{folder_url}job/{short_name}/buildWithParameters';
    const BUILD_STOP            = '{folder_url}job/{short_name}/{number}/stop';
    const BUILD_DELETE          = '{folder_url}job/{short_name}/{number}/doDelete';
    const BUILD_INFO            = '{folder_url}job/{short_name}/{number}/api/json?depth={depth}';
    const BUILD_CONSOLE_OUTPUT  = '{folder_url}job/{short_name}/{number}/consoleText';
    const BUILD_ENV_VARS        = '{folder_url}job/{short_name}/{number}/injectedEnvVars/api/json?depth={depth}';
    const BUILD_TEST_REPORT     = '{folder_url}job/{short_name}/{number}/testReport/api/json?depth={depth}';
    /**
     * 
     */
    const NODE_LIST         = 'computer/api/json?depth={depth}';
    const CREATE_NODE       = 'computer/doCreateItem';
    const DELETE_NODE       = 'computer/{name}/doDelete';
    const NODE_INFO         = 'computer/{name}/api/json?depth={depth}';
    const NODE_TYPE         = 'hudson.slaves.DumbSlave$DescriptorImpl';
    const TOGGLE_OFFLINE    = 'computer/{name}/toggleOffline?offlineMessage={msg}';
    const CONFIG_NODE       = 'computer/{name}/config.xml';
    const NODE_SCRIPT_TEXT  = 'computer/{node}/scriptText';
    /**
     * 视图
     */
    const API_VIEW_CREATE   = '{folder_url}createView?name={short_name}';
    const API_VIEW_SUBJOBS  = '{folder_url}view/{short_name}/api/json?tree=jobs[url,color,name]';
    const API_VIEW_CONFIG   = '{folder_url}view/{short_name}/config.xml';
    const API_VIEW_DELETE   = '{folder_url}view/{short_name}/doDelete';
    const SCRIPT_TEXT = 'scriptText';
    /**
     * promotion
     */
    const PROMOTION_NAME    = '{folder_url}job/{short_name}/promotion/process/{name}/api/json?tree=name';
    const PROMOTION_INFO    = '{folder_url}job/{short_name}/promotion/api/json?depth={depth}';
    const PROMOTION_DELETE  = '{folder_url}job/{short_name}/promotion/process/{name}/doDelete';
    const PROMOTION_CREATE  = '{folder_url}job/{short_name}/promotion/createProcess?name={name}';
    const PROMOTION_CONFIG  = '{folder_url}job/{short_name}/promotion/process/{name}/config.xml';
    /**
     * 
     */
    const QUIET_DOWN = 'quietDown';
    const API_ZL_RESTART = 'restart';
    const SAFE_RESTART = 'safeRestart';
    const JENKINS_EXIT = 'exit';
    const SAFE_EXIT = 'safeExit';
    const CANCEL_QUIET_DOWN = 'cancelQuietDown';


    /**
     *
     * @param string $view
     *
     * @return string
     */
    public function getUrlView($view)
    {
        return sprintf('%s/view/%s', $this->baseUrl, $view);
    }
}
