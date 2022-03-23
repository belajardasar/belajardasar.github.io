<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		ini_set("memory_limit",-1);
		$this->load->helper('blade');
	}

	function main_sitemap()
	{		
		header("Content-Type: text/xml;charset=iso-8859-1"); 
		view('sitemap.main', [], FALSE);
	}

	function sub_sitemap($niche)
	{	

		header("Content-Type: text/xml;charset=iso-8859-1"); 

		$niche 		= rawurldecode($niche);

		$arr_slug 	= arr_slug($niche);

		$arr = [
			'niche' 	=> $niche,
			'arr_slug' 	=> $arr_slug,
		];

		view('sitemap.submap', $arr, FALSE);
	}
}
