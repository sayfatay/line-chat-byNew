<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';


class Line extends CI_Controller {


    public function __construct()
    {
      parent::__construct();
      $this->load->model('database_model');
      $this->db = $this->CIBase->db();
    
    }

	public function index()
	{

    $data['shop_id'] = 5; 

    $this->load->view('line/chat', $data);
		
  }
  

  public function getChart($shp_id){
    $chat = $this->database_model->getChat($shp_id);
        
     $data['item'] = $chat;
     echo json_encode($data);

  }

  public function getlineuser($id = ""){
    $user = $this->db->get("line_user","*",["ind" => $id]);

    $msg = $this->db->select("line_chat","*",["user_id" => $id, "ORDER"=>["ind"=>"DESC"], "LIMIT"=>10 ]);

    $data['user'] = $user;
    $data['msg'] = $msg;
    echo json_encode($data);
}


}
