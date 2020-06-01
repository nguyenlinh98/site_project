<?php
 namespace Framework\Components;


 /**
  *  Request to get data from form or url
  *  Method is get or post
  *
  * */

class Request
{
    /**
     * @param $post array
     * @param $get array
     * @param $server url
     * @param $controller text
     * @param $action text
     * */
    protected $server;
    protected $post;
    protected $get;
    protected $controller;
    protected $action;

    public function __construct()
    {
        $this->buildRequest();
    }

    /**
     * Method to build request
     *
     */
    public function buildRequest()
    {
        $this->server =$_SERVER;
        $this->get = $_GET;
        $this->post = $_POST;
        //get controller & action
        $this->controller = $this->getRequestGet($this->controller);
        $this->action = $this->getRequestGet($this->action);

    }

    /**
     * Method to get data from form
     * @param string $value
     * @return string
     */
    public function getRequestGet($value = '')
    {
        /**
         * If $value isn't empty then get data by key = $value in $this->get[$value]
         * Else return $this->get
        */
        if ( !empty($value) ) {
            $data = $this->get["$value"]??'';
        } else {
            $data = $this->get;
        }
        return $data;
    }

    /**
     * Method to post data from form
     * @param string $value
     * @return string
     */
    public  function getRequestPost($value = '')
    {
        if ( !empty($value) ) {
            $data = $this->post["$value"]??'';
        } else {
            $data = $this->post;
        }
        return $data;
    }

    public function getAction()
    {
        return $this->action['action'];
    }

    public function getController()
    {
        return $this->controller['controllers'];
    }

}
