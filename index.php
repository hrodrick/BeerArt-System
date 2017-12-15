<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("./Config/Config.php");
require("./Config/Autoload.php");

use Config\Autoload as Autoload;
use Config\Router as Router;
use Config\Request as Request;

$autoload = new Autoload();
$autoload->start();

session_start();

//$request = new Request();
//$router = new Router();

include_once("./Views/_xadm/header.php");	
//Router::direccionar($request);
    
Router::direccionar(Request::getInstance());
/*var_dump(Request::getInstance());*/
include_once("./Views/_xadm/footer.php");	
?>
