<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';


class Welcome extends CI_Controller {





	public function index()
	{
		$this->load->view('test2');
		
	}

	public function test3()
	{
		$this->load->view('test3');
		
	}


	public function test(){
		$this->load->view('test');
	}

	public function test2(){
		echo 'tes';


		$image = "https://cf.shopee.co.th/file/9dab72ddedd4c91baa4bdf3f9caaad8e_tn";
		$path = './assets/test.jpg';

		$put_content = file_put_contents($path,$image);  

		$url = 'https://tarad-image.s3-ap-southeast-1.amazonaws.com/shop/n/notebook/Product/6792885/spd_eebd3a005e_b.jpg';
//$img = __DIR__.'/../../assets/spd_eebd3a005e_b.jpg';
//file_put_contents($img, file_get_contents($url));

		//https://tarad-image.s3-ap-southeast-1.amazonaws.com/shop/n/notebook/Product/6792885/spd_eebd3a005e_b.jpg
		//copy('/assets/test.jpg','http://tarad-image.s3-ap-southeast-1.amazonaws.com/shop/n/notebook/Product/6792885/spd_eebd3a005e_b.jpg');
	}
}
