<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for all logged in users
 */
class bkp_Header extends MY_Controller {	
	protected $access = "@";
	public function index()
	{
		$this->load->view("header");
	//	$this->load->library('session');
	//	$this->load->view("header");
	//	$this->load->view("navbar");
	//	$this->load->view("dashboard");
	//	$this->load->view("footer");
		
	//	document.getElementById("pagediv").innerHTML='<object type="text/html" data="pages/site1.html" ></object>';
	}

}