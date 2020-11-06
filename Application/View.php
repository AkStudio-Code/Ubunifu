<?php

namespace Triposhub\Ubunifu\Application;


class View
{
    const view_dir = 'view';
    public $mapper;
    public $host ;
    public $app_name;
    private  $src;
    private  $ubunifu_dir;
    public $use_template = true;


    function __construct()
    {
        $this->mapper =  new Url();
        $this->host = \AppConfig::load('base_url','app');
        $this->app_name = Model::App()->urlTabs()->getApp();

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
       if($this ->use_template){
           require \AppConfig::load('app_dir','app').self::view_dir.'/_theme.php';
       }else{
           if (isset($this->file)) {
               require \AppConfig::load('app_dir','app').Model::App()->urlTabs()->getApp().'/'.self::view_dir.'/'.$this->file.'.php';
           }
       }
    }
    function useTemplate($option = true)
    {
        $this ->use_template = $option;
    }

    function content($file)
    {
        if (isset($file)) {
            require \AppConfig::load('app_dir','app').Model::App()->urlTabs()->getApp().'/'.self::view_dir.'/'.$file.'.php';
        }
    }

    function layout($file)
    {
        if (isset($file)) {
            require \AppConfig::load('app_dir','app').self::view_dir.'/'.$file.'.php';

        }
    }

    function url()
    {
        return \AppConfig::load('base_url','app');
    }

    function resourceDir()
    {
        return $this ->url().'src/assets/';
    }

    function ubunifuAssets()
    {
        return $this ->url().'src/ubunifu/';

    }
    /**
     * Converts characters to HTML entities
     * This is important to avoid XSS attacks, and attempts to inject malicious code in your page.
     *
     * @param  string $str The string.
     * @return string
     */
    public function encodeHTML($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }

    function phpAjax()
    {
        if (isset($file)) {
            require \AppConfig::load('app_dir','app').self::view_dir.'/'.$file.'.php';

        }
    }


}
