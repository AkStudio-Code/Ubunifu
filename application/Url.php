<?php


namespace Ubunifu\application;

class Url
{
    public $route;

    function __construct()
    {
        $this->route = $this->getURlParts();
    }

    /**
     * @return false|string[]
     */
    function getURlParts()
    {
        $url = Request::get('url');
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }

    function getApp()
    {
        return strtoupper(!empty($this->route[0]) ? $this->route[0] : Config::load('default_app', 'app'));
    }

    function getController()
    {
        return !empty($this->route[1]) ? $this->route[1] : Config::load('controller', 'app');
    }

    function getAction()
    {
        return !empty($this->route[2]) ? $this->route[2] : Config::load('action', 'app');

    }

    function getParams()
    {
        $url = $this->route;
        unset($url[0], $url[1], $url[2]);
        $params = array_values($url);
        return $params;
    }

    function pretifierController ($controller_name)
    {
        if (Config::load('pretty_url','app')) {
            if (!is_null($controller_name)) {
                $pretty_url = explode('-', $controller_name);
                if (array_count_values($pretty_url) > 1) {
                    $url2 = '';
                    foreach ($pretty_url as $x_) {
                        $join = ucfirst($x_);
                        $url2 .= $join;
                    }
                    $controller_name = $url2;
                }
            }
        }
        return $controller_name;
    }

    function  pretifierAction($action_name)
    {
        if (Config::load('pretty_url','app')) {
            if (!is_null($action_name)) {
                $pretty_url = explode('-', $action_name);
                if (array_count_values($pretty_url) > 1) {
                    $url3 = '';
                    for ($i = 0; $i < count($pretty_url); $i++) {
                        if ($i == 0) {
                            $join = lcfirst($pretty_url[0]);
                        } else {
                            $join = ucfirst($pretty_url[$i]);
                        }
                        $url3 .= $join;
                    }
                    $action_name = $url3;
                }
            }
        }
        return $action_name;
    }

}
