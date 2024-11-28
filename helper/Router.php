<?php

class Router
{
    private $defaultController;
    private $defaultMethod;
    private $configuration;

    public function __construct($configuration, $defaultController, $defaultMethod)
    {
        $this->defaultController = $defaultController;
        $this->defaultMethod = $defaultMethod;
        $this->configuration = $configuration;
    }

    public function route($controllerName, $methodName, $data)
    {
        $controller = $this->getControllerFrom($controllerName);
        $this->executeMethodFromController($controller, $methodName, $data);
    }


    // Este metodo hace que la url de las otra pag como perfil,home,etc sea ? page = nombre del mustache
    private function getControllerFrom($module)
    {
        $controllerName = 'get' . ucfirst($module) . 'Controller';
        $validController = method_exists($this->configuration, $controllerName) ? $controllerName : $this->defaultController;
        return call_user_func(array($this->configuration, $validController));
    }

    private function executeMethodFromController($controller, $method, $data)
    {
        $validMethod = method_exists($controller, $method) ? $method : $this->defaultMethod;
        if ($data) {
            call_user_func([$controller, $validMethod], $data);
        } else {
            call_user_func([$controller, $validMethod]);
        }
    }
}
