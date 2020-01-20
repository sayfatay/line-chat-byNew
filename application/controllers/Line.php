<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';


class Line extends CI_Controller {


    public function __construct()
    {
      parent::__construct();
    
    }

	public function index()
	{
        $this->load->view('line/chat');
		
    }


}
