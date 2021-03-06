<?php

namespace App\config;

/**
 * Work with request data (GET, POST, SESSION...)
 */
class Request
{
    private $get;
    private $post;
    private $session;

    public function __construct()
    {
        $this->get = new Parameter(filter_input_array(INPUT_GET));
        $this->post = new Parameter(filter_input_array(INPUT_POST));
        $this->session = new Session($_SESSION);
    }

    /**
     * @return Parameter
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }
}
