<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Welcome.php');

class Server extends CI_Controller {


        public function __construct()
        {
            //when in non-wsdl mode the uri option must be specified
            //$options = array('uri'=>'http://10.100.0.46/', 'encoding' => 'UTF-8');
            //create a new SOAP server
            //$server = new SoapServer(NULL, $options);
            //attach the API class to the SOAP Server
            //$server->setClass('Server');
            //$server->setClass('Welcome');
            //start the SOAP requests handler
            //$server->handle();
        }

        function index(){
            //when in non-wsdl mode the uri option must be specified
            $options = array('uri'=>'http://localhost/', 'encoding' => 'UTF-8');
            //create a new SOAP server
            $server = new SoapServer(NULL, $options);
            //attach the API class to the SOAP Server
            //$server->setClass('Server');
            $server->setClass('Welcome');
            //start the SOAP requests handler
            $server->handle();
//              echo 'asadf';
        }
}