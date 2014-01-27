<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        //might need to go to 02.41 in the video and add namespaces here.
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => APPLICATION_PATH));
        
        $autoloader = Zend_Loader_Autoloader::getInstance();   
        $autoloader->registerNamespace(array('App_'));
        
        return $moduleLoader;
    }
}

