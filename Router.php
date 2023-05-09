<?php

class Router
{
    private $path = array();

    public function post(string $path, string $controller): void
    {
        $this->path[] = array($path, $controller, 'post');
    }

    public function get(string $path, string $controller): void
    {
        $this->path[] = array($path, $controller, 'get');
    }


    public function authenticateRoutes()
    {
        $incomingRequestURI = $_SERVER['REQUEST_URI'];

        $requestURI_index = array_search(
            $incomingRequestURI,
            array_column($this->path, 0)
        );

        if ($requestURI_index !== false) {
            if ($this->path[$requestURI_index][2] == 'get')
                return call_user_func($this->path[$requestURI_index][1]);
            else
                return call_user_func($this->path[$requestURI_index][1], $_POST);

        }
        else{
            echo "Route: {$incomingRequestURI} not found.";
        }
    }

}
