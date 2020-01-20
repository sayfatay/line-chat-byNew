<?php
class Database_Model extends CI_Model {

    public function __construct()
    {
      parent::__construct();
      //$this->db = $this->load->database('tarad_rw');
      $this->db = $this->CIBase->db();
    }



    public function getChat($shop_id){
        $query = $this->db->select('line_user','*', ['spf_id_pk' => $shop_id]);

        foreach($query as $key => $value){
            $line_id = $value['ind'];

            $chat = $this->db->get('line_chat','*',['spf_id_pk' => $shop_id, 'user_id'=> $line_id,  'ORDER' => ['ind'=>'DESC']]);
            $query[$key]['message'] = $chat['message'];
            $query[$key]['date_time'] = $chat['date_time'];
        }
        return $query;

    }

}