<?php
namespace Daos;

class SingletonAbstractDAO{

	private static $instancia = array();

	public static function getInstance(){
		$returnValue=NULL;
		$class=get_called_class();

		if(!isset(self::$instancia[$class])){
			self::$instancia[$class]=new $class;
			$returnValue=self::$instancia[$class];
		}		
		/*
		echo "<BR>SINGLETON<BR>";
		var_dump($returnValue);
		echo "<BR>Instancia<BR>";
		print_r(self::$instancia);
		*/			
	return $returnValue;
	}
/*

	private static $instance;

	public static function getInstance(){
		$class=get_called_class();

		if(!self::$instance instanceof $class){
			self::$instance=new $class;
		}
		echo "<BR>SINGLETON<BR>";
		var_dump(self::$instance);
		return self::$instance;
	}	
*/
}
