<?php

class HomeConfigurator {

    private $configure = array();
    private static $_instance;

    private function __construct(){
        $model = new Configure();
        $config = $model->find(array('condition' => array('_id' => '_CONFIGURADOR_'), 'order' => array('_id'), 'orderConditions' => 'DESC'));
        $this->configure = unserialize(base64_decode($config[0]['_simple']['_content']));
    }
    
    public static function singleton(){
        if(!isset(self::$_instance))
            self::$_instance = new self;
        
        return self::$_instance;
    }
    
    public function getValue(){
        return $this->configure;
    }
}
?>
