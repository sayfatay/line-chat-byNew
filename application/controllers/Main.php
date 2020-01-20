<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';


class Main extends CI_Controller {


    public function __construct()
    {
      parent::__construct();
      $this->db = $this->CIBase->db();
    
    }


	public function index()
	{
        $this->load->view('main');
		
    }
    
    public function person($spf_id_pk = 5){


        $item  = $this->db->select("line_user", "*",["spf_id_pk"=>$spf_id_pk]);

        $data['item'] = $item;
        echo json_encode($data);
    }

    public function getlineuser($id = ""){
        $user = $this->db->get("line_user","*",["ind" => $id]);

        $msg = $this->db->select("line_chat","*",["user_id" => $id, "ORDER"=>["ind"=>"DESC"], "LIMIT"=>10 ]);

        $data['user'] = $user;
        $data['msg'] = $msg;
        echo json_encode($data);
    }


    public function hook(){
        echo 'hook';

        $this->load->view('hook');
    }

    public function test3(){
        $this->load->view('test3');
    }

}
