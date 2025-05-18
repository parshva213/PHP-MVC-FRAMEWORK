<?php

namespace core;
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }
    public function Method()
    {
        
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(){
        return $this->Method() === 'GET';
    }

    public function isPost(){
        return $this->Method() === 'POST';
    }

    public function getBody(){
        $body = [];
        if($this->Method() === 'GET'){
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,);
            }
        }

        if($this->Method() === 'POST'){
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,);
            }
        }

        return $body;
    }

}


?>