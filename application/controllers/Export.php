<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Export extends CI_Controller {

	protected $xepo = array();

	public function __construct()
	{
		parent::__construct();
		ini_set("memory_limit",-1);

		$this->load->model([
			'export/compile_data',
			'export/compile_xml',
			'export/compile_html'
		]);

		$this->load->helper('blade');
	}

	function start($type="data")
	{
		echo "\n\n==> Compile {$type}..\n\n";

		$this->clear_empty();

		$path 	= "gudang/db/";
		$ext 	= ".sqlite";
		$arr 	= glob("{$path}*{$ext}");

		foreach ($arr as $key => $file)
		{
			$niche 	= str_replace([$path,$ext], '', $file);		

			make_dir("export/{$type}/{$niche}");
			sleep(1);	

			$data = $this->db_info($type,$niche);

			$this->do_compile($data);			

			echo "\r\n\r\n[\033[32mFINISH\033[39m] ==> Export {$niche}\r\n\r\n";			

			//break;
		}
	}

	function db_info($type,$niche)
	{
		$dbx 		= dbimake($niche);

		$arr		= $dbx->query("SELECT keyword, slug, json_images, json_sentences FROM tbl_keywords WHERE json_images != '[]' AND json_sentences != '[]'");

		$count 		= $arr->num_rows();
		$data 		= $arr->result_array();

		shuffle($data);

		$sub_data 	= array_chunk($data,ARTICLE_PER_XML);

		return [			
			'type' 	=> $type,
			'niche' => $niche,
			'count' => $count,
			'data' 	=> $sub_data,
		];
	}

	function do_compile($data=[])
	{
		$type = $data['type'];
		
		if($type === "blogspot" OR $type === "wordpress")
		{
			$this->compile_xml->start($data);
		}
		else if($type === "static_html")
		{
			sitemap_note();
			$this->compile_html->start($data);
		}	
		else
		{
			$this->compile_data->start($data);
		}	
	}

	function clear_empty()
	{
		$path 	= "gudang/db/";
		$ext 	= ".sqlite";
		$arr 	= glob("{$path}*{$ext}");

		foreach ($arr as $key => $file)
		{
			$niche 	= str_replace([$path,$ext], '', $file);			

			$this->do_clear_empty($niche);

			echo "\r\n[\033[32mDB\033[39m] ==> Checking {$niche} Database";			

			//break;
		}

		echo "\r\n\r\n";
	}

	function do_clear_empty($niche)
	{
		$dbx 	= dbimake($niche);
		$dbx->query('UPDATE tbl_keywords SET "json_images" = "[]" WHERE "json_images" = "" ');
		$dbx->query('UPDATE tbl_keywords SET "json_sentences" = "[]" WHERE "json_sentences" = "" ');
	}

	function delete_export()
	{
		delete_export();
	}
}
