<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies extends CI_Controller {

	public function index()
	{
		//echo '<button class="btn btn-primary" onclick="javascript:parent.jQuery.fancybox.close();">Close</button>';
		echo '<h3 class="pop-up-title">ROVA Pro Terms and Conditions</h3>';
		$this->load->view('policies/terms');
		//echo '<button class="btn btn-primary" onclick="javascript:parent.jQuery.fancybox.close();">Close</button>';
	}
}
