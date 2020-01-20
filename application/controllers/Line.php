<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';


class Line extends CI_Controller {


    public function __construct()
    {
      parent::__construct();
      $this->load->model('database_model');
    
    }

	public function index()
	{

        $shp_id = 5; 

        $chat = $this->database_model->getChat($shp_id);
        
        $data['chat'] = $chat;
        $this->load->view('line/chat', $data);
		
    }


}
