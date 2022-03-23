<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('dbimake'))
{
    function dbimake($niche='')
    {
        if (!file_exists(FCPATH."gudang/db/{$niche}.sqlite"))
        {

            if(PHP_SAPI !== 'cli')
            {
                redirect('/');
            }
            else
            {
                echo "\r\n[\033[31mERROR\033[39m]==> NO {$niche} database\r\n";
            }

            die;
            
        }

        $CI = get_instance();

        $config = array(
            'dsn'      => "sqlite:gudang/db/{$niche}.sqlite",
            'hostname' => '',
            'username' => '',
            'password' => '',
            'database' => '',
            'dbdriver' => 'pdo',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt'  => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );

        return $CI->load->database($config, TRUE);
    }
}

if(!function_exists('CreateNichedb'))
{
    function CreateNichedb($niche="home")
    {
        $path = "gudang/db/{$niche}.sqlite";
        
        deleteFile($path);

        $db = new SQLite3($path);

        $db->exec("CREATE TABLE IF NOT EXISTS 'tbl_keywords' (
            'id' INTEGER PRIMARY KEY NOT NULL,
            'keyword' VARCHAR NOT NULL,
            'slug' VARCHAR NOT NULL,
            'json_images' TEXT NOT NULL DEFAULT '',
            'json_sentences' TEXT NOT NULL DEFAULT '',
            'json_spintax' TEXT NOT NULL DEFAULT '',
            'publish' DATETIME NOT NULL DEFAULT '',
            'update' DATETIME NOT NULL DEFAULT '',
            'status' TINYINT NOT NULL DEFAULT '0',
            UNIQUE (slug) ON CONFLICT IGNORE
        )");
    }
}

if(!function_exists('niche_arr'))
{
    function niche_arr()
    {
        $path   = "gudang/db/";
        $ext    = ".sqlite";
        $arr    = glob("{$path}*{$ext}");

        $arr  = str_replace([$path,$ext], '', $arr);

        return $arr;
    }
}

if(!function_exists('default_niche'))
{
    function default_niche()
    {
        $niche = DEFAULT_NICHE;

        $path   = "gudang/db/";
        $ext    = ".sqlite";

        if (!file_exists(FCPATH."{$path}{$niche}{$ext}"))
        {
            $arr    = glob("{$path}*{$ext}");
            $niche  = $arr[0]??'';
            $niche  = str_replace([$path,$ext], '', $niche);

            if(!$niche)
            {
                echo "No database..";
                die;
            }
        }

        return $niche;
    }
}

if(!function_exists('last_post'))
{
    function last_post($niche="home",$limit=20,$query="")
    {
        $dbx        = dbimake($niche);

        $where_arr  = [
            'json_images != ' => '',
            'json_images != ' => '[]',
            'json_sentences != ' => '',
            'json_sentences != ' => '[]',
            'DATE(publish) <= ' => date('Y-m-d H:i:s')
        ];

        $dbx->select('*');
        $dbx->from('tbl_keywords');
        $dbx->where($where_arr);

        if($query)
        {
            $dbx->like('keyword', $query);
        }

        $dbx->limit($limit);
        $dbx->order_by('publish', 'DESC');
        
        $arr = $dbx->get()->result_array();

        return $arr;
    }
}

if(!function_exists('random_related'))
{
    function random_related($niche="home",$limit=10,$query='keyword')
    {
        $dbx        = dbimake($niche);

        $where_arr  = [
            'json_images != ' => '',
            'json_images != ' => '[]',
            'json_sentences != ' => '',
            'json_sentences != ' => '[]',
            'DATE(publish) <= ' => date('Y-m-d H:i:s')
        ];

        $arr = $dbx->select($query)
        ->from('tbl_keywords')
        ->where($where_arr)
        ->limit($limit)
        ->order_by('id', 'RANDOM')
        ->get()
        ->result_array();

        return $arr;
    }
}

if(!function_exists('arr_slug'))
{
    function arr_slug($niche="home")
    {
        $dbx        = dbimake($niche);

        $where_arr  = [
            'json_images != ' => '',
            'json_images != ' => '[]',
            'json_sentences != ' => '',
            'json_sentences != ' => '[]',
            'DATE(publish) <= ' => date('Y-m-d H:i:s')
        ];

        $arr = $dbx->select('keyword, slug, publish')
        ->from('tbl_keywords')
        ->where($where_arr)
        ->order_by('publish', 'DESC')
        ->get()
        ->result_array();

        return $arr;
    }
}

if(!function_exists('post_details'))
{
    function post_details($niche="best",$slug='')
    {
        $dbx        = dbimake($niche);

        $where_arr  = [
            'json_images != ' => '',
            'json_images != ' => '[]',
            'json_sentences != ' => '',
            'json_sentences != ' => '[]',
            'DATE(publish) <= ' => date('Y-m-d H:i:s'),
            'slug' => $slug
        ];

        $arr = $dbx->select('*')
        ->from('tbl_keywords')
        ->where($where_arr)
        ->get()
        ->row_array();

        return $arr;
    }
}

?>