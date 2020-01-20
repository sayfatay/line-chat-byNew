<?php

require 'vendor/autoload.php';
use Medoo\Medoo;

class CIBase {

    public function __construct()
    {

    }

	public function db(){
		$db = new Medoo([

		    "database_type" => "mysql",         
            "server" => "127.0.0.1",   
            "username" => "root",            
            "password" => "1234",
            "database_name" => "db_chat",  
            'charset' => 'utf8'
		]);

		return $db;
	}

}