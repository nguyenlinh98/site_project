<?php

 namespace Framework\Database;

interface ConnectionInterface
{
    public function connect();
    public function disconnect();

}