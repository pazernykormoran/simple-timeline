<?php

/**
 * This class includes methods for views.
 *
 * @abstract
 */

require_once('./libs/Smarty.class.php');

abstract class View{

    /**
     * It loads the object with the model.
     *
     * @param string $name name class with the class
     * @param string $path pathway to the file with the class
     *
     * @return object
     */

    private $smarty;

    function __construct() {
       $this->smarty = new Smarty();
       $this->smarty->template_dir='./templates';
       $this->smarty->compile_dir='tmp';
       $this->smarty->cache_dir='cache';
    }

    protected function setNecessery(){
        if(isset($_GET['info'])){
            $this->set('info', $_GET['info']);
        }else{
            $this->set('info', '');
        }
        if(isset($_GET['error'])){
            $this->set('error', $_GET['error']);
        }else{
            $this->set('error', '');
        }
    }

    public function loadModel($name, $path='model/') {
        $path=$path.$name.'.php';
        $name=$name.'Model';
        try {
            if(is_file($path)) {
                require $path;
                $ob=new $name();
            } else {
                throw new Exception('Can not open model '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $ob;
    }
    /**
     * It includes template file.
     *
     * @param string $name name template file
     * @param string $path pathway
     *
     * @return void
     */
    public function render($name, $path='templates/') {
        $path=$path.$name.'.html.php';
        
        $this->smarty->display($path);
    }
    /**
     * It sets data.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function set($name, $value) {
        $this->smarty->assign($name,$value);
        //$this->$name=$value;
    }

    /**
     * It gets data.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name) {
        return $this->$name;
    }
}