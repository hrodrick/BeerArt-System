<?php
namespace Config;
	define("ROOT",dirname(__DIR__)."/");
	define("DIR","/beer/");
	define("URL_CSS","Static/css/");
	define("URL_JS","Static/js/");
	define("URL_IMG","Static/images/");
	define("URL_IMG_CER","Static/images/cervezas/");
	define("URL_IMG_ENV","Static/images/envases/");
	define("URL_VISTA_BACK","Views/_xadm/");
	define("URL_VISTA_FRONT","Views/");

	define('DB_HOST', 'localhost');
	//define('DB_NAME', 'techmdq1_choppenhauer');
	define('DB_NAME', 'choppenhauer');
	//define('DB_USER', 'techmdq1_sergio');
	define('DB_USER', 'root');
	//define('DB_PASS', 'cl14m51962');	
	define('DB_PASS', '');	

	define('PAGINATION', 15);	
	define('PAGINATION_FRONT', 8);	
	define('FECHA', 'd-m-Y');	

	// Email Data
	define('HOST','securees12.sgcpanel.com');
	define('PASS','cl14m5123');
	define('PORT','25');
	define('FROM','info.choppenhauer@techmdq.com.ar');
	define('FROMNAME','Choppenhauer - Cerveza Artesanal');
?>
