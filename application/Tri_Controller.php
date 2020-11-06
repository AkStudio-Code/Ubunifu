<?php


namespace Ubunifu\application;


use Pixie\Connection;

class Tri_Controller
{
    public $view;
    public  $datatable_css;
    public  $datatable_js;
    public  $assets;


    function __construct()
    {
        $this->view = new View();
        $this->datatable_css = [
            'css' => [
                $this->url() . 'src/plugins/datatables/dataTables.bootstrap4.min.css',
                $this->url() . 'src/plugins/datatables/buttons.bootstrap4.min.css',
                $this->url() . 'src/plugins/datatables/responsive.bootstrap4.min.css',
            ]];
        $this->datatable_js = [
            'js' => [
                $this->url() . 'src/plugins/datatables/jquery.dataTables.min.js',
                $this->url() . 'src/plugins/datatables/dataTables.bootstrap4.min.js',
                $this->url() . 'src/plugins/datatables/dataTables.buttons.min.js',
                $this->url() . 'src/plugins/datatables/jszip.min.js',
                $this->url() . 'src/plugins/datatables/pdfmake.min.js',
                $this->url() . 'src/plugins/datatables/vfs_fonts.js',
                $this->url() . 'src/plugins/datatables/buttons.html5.min.js',
                $this->url() . 'src/plugins/datatables/buttons.print.min.js',
                $this->url() . 'src/plugins/datatables/buttons.colVis.min.js',
                $this->url() . 'src/plugins/datatables/responsive.bootstrap4.min.js',
                $this->url() . 'src//assets/pages/jquery.datatable.init.js',

            ]
        ];
        $this->assets = array_merge($this->datatable_css,$this->datatable_js);
    }

    private $connection;
    function Db(){
        return new DatabaseFactory( new Connection('mysql',Config::all('db')));
    }

    function url (){
        return Config::load('base_url','app');
    }

    function urlTabs(){
        return new Url();
    }

    function ajaxPass()
    {
        return json_encode(true);
    }

    function ajaxFail()
    {
        return json_encode(false);
    }

    function console($output)
    {
        echo $output;
    }


}