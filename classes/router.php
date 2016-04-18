<?php

class Router 
{
    public function __construct() 
    {       
        $this->routes = [
            ['path' => '/', 'action' => 'HomeController@index'],
            ['path' => '/createShortUrl/', 'action' => 'UrlController@createShortUrl'],
            ['path' => '/statistic/{short_link_id}', 'action' => 'StatisticController@getStat'],
            ['path' => '/getStatData/', 'action' => 'StatisticController@getStatData'],
            ['path' => '/{short_url_slug}/', 'action' => 'UrlController@getRealUrl'],
        ];
    } 

    public function run() 
    {
        if (!isset($_GET['route'])) {
            $this->runController('HomeController', 'index');
        } else {
            $routeArr = explode('/', $_GET['route']);
            $routeArr = array_values(array_diff($routeArr, array('')));
            ksort($routeArr);
            $args = [];
            foreach ($this->routes as $route) {
                $routePathArr = explode('/', $route['path']); 
                $routePathArr = array_values(array_diff($routePathArr, array('')));
                if (count($routePathArr)!==count($routeArr)) {
                    continue;
                }
                $next = false;
                for ($i = 0; $i < count($routePathArr); $i++) {
                    if ($routePathArr[$i][0]=='{') {
                        $pattern = '/{|}/';
                        $varName = preg_replace($pattern, "", $routePathArr[$i]);
                        $args[$varName] = $routeArr[$i]; 
                    } elseif ($routePathArr[$i]!==$routeArr[$i]) {
                        $next = true;
                        break;
                    }
                }
                if ($next) {
                    continue;
                } else {
                    $tmp = explode('@', $route['action']);
                    $controllerClassName = $tmp[0];
                    $actionName = $tmp[1];
                    $this->runController($controllerClassName, $actionName, $args);
                    break;
                }
            }
        }
    }

    private function runController($controllerClassName, $actionName, $args = false) 
    {
        $controller = new $controllerClassName();
        $request_parameters = false;
        foreach ($_GET as $k=>$v) {
            if ($k!=='route') {
                $request_parameters[$k] = $v;
            }
        }
        if ($request_parameters) {
            $controller->$actionName($request_parameters, $args);
        } else {
            $controller->$actionName(false, $args);
        }
    }
}