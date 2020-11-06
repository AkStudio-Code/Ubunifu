<?php


namespace Ubunifu\application;


class View
{
    const view_dir = 'view';
    public $mapper;
    public $host ;
    public $app_name;


    function __construct()
    {
        $this->mapper =  new Url();
        $this->host = Config::load('base_url','app');
        $this->app_name = Tri_Model::App()->urlTabs()->getApp();

    }

    function render($filename, $model=[], $scripts=[]){
        $this ->file= $filename;
        if ($model) {
            foreach ($model as $key => $value) {
                $this->{$key} = $value;
            }
        }

        if ($scripts){
            foreach ($scripts as $key => $value) {
                $this->{$key} = $value;
            }
        }

        $this ->src = $this->resourceDir();
        $this ->ubunifu_dir = $this->ubunifuAssets();

        require Config::load('app_dir','app').Tri_Model::App()->urlTabs()->getApp().'/'.self::view_dir.'/_theme.php';
    }

    function content($file)
    {
        if (isset($file)) {
            require Config::load('app_dir','app').Tri_Model::App()->urlTabs()->getApp().'/'.self::view_dir.'/'.$file.'.php';
        }
    }

    function url()
    {
        return Config::load('base_url','app');
    }

    function resourceDir()
    {
        return $this ->url().'src/assets/';
    }

    function ubunifuAssets()
    {
        return $this ->url().'src/ubunifu/';

    }
}