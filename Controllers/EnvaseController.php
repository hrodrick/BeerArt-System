<?php
namespace Controllers;

use Daos\Lista\ListaCervezaDAO as ListaCervezaDAO;
use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\Lista\ListaEnvaseDAO as ListaEnvaseDAO;
use Daos\DB\DBEnvaseDAO as DBEnvaseDAO;
use Models\Envase as Envase;
use Utils\Thumb as Thumb;

class EnvaseController{

	private $datosEnvase;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}				
		//$this->datosEnvase = ListaEnvaseDAO::getInstance();
		$this->datosEnvase = DBEnvaseDAO::getInstance();
	}

 	public function index(){
		require(URL_VISTA_BACK."home.php");
	}

 	public function envadd(){
 		$tipo='';
 		$capacidad='';
 		$coeficiente='';
		require(URL_VISTA_BACK."envadd.php");
	}

	public function limpiarString($texto){
	    $textoLimpio = preg_replace('([^A-Za-z0-9])', '_', $texto);	     					
	    return $textoLimpio;
	}

	public function nuevo($tipo,$capacidad,$coeficiente,$foto=''){
		$imagen='';
		$msg;
		$obj=$this->datosEnvase->buscarTipo($tipo);
		if(!is_object($obj)){		
			if($_FILES){
				if((isset($_FILES['foto'])) && ($_FILES['foto']['name'] != '')){
					$file = basename($_FILES['foto']['name']);			
		    		$imagen = $this->limpiarString($tipo);	
					$fileExtension = pathinfo($file, PATHINFO_EXTENSION);
					$imageInfo = getimagesize($_FILES['foto']['tmp_name']);
					$imagen=$imagen.'.'.$fileExtension;
					move_uploaded_file($_FILES["foto"]["tmp_name"], URL_IMG_ENV .$imagen);

					$this->creoThumb($imagen);
				}		
			}

			$c=new Envase($tipo,$capacidad,$coeficiente,$imagen,$standBy=0);
			$this->datosEnvase->insertar($c);
	 		$tipo='';
	 		$capacidad='';
	 		$coeficiente='';
	 		$msg="<<< La carga fue exitosa >>>";
	 	}			
		require(URL_VISTA_BACK."envadd.php");
	}

	public function creoThumb($foto){
		$thumb = new Thumb();
		$thumb->loadImage(URL_IMG_ENV.$foto);
		//$thumb->resize(533, 'width');
		$thumb->resize(333, 'height');
		$thumb->save(URL_IMG_ENV.'tp_'.$foto);

		$thumb->loadImage(URL_IMG_ENV.$foto);
		//$thumb->resize(187, 'width');
		$thumb->resize(116, 'height');
		$thumb->save(URL_IMG_ENV.'t1_'.$foto);				

		$thumb->loadImage(URL_IMG_ENV.$foto);
		//$thumb->resize(117, 'width');
		$thumb->resize(73, 'height');
		$thumb->save(URL_IMG_ENV.'t2_'.$foto);				

		unlink(URL_IMG_ENV.$foto);
	}	

	public function borrar($id,$page,$campo,$orden,$foto=''){
		$this->datosEnvase->eliminar(base64_decode($id));
		if(!empty($foto)){
			$this->delFoto($foto);
		}
		header("Location: ".DIR."Envase/listado/".$page."/".$campo."/".$orden);	
	}

	public function standBy($id,$page,$campo,$orden){
		$this->datosEnvase->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Envase/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		$this->datosEnvase->ordenarListado($campo,$orden);
		header("Location: ".DIR."Envase/listado/".$page."/".$campo."/".$orden);		
	}

	function delFoto($foto){
		if(is_file(URL_IMG_ENV.'tp_'.$foto)){
	        unlink(URL_IMG_ENV.'t1_'.$foto);
	        unlink(URL_IMG_ENV.'t2_'.$foto);
	        unlink(URL_IMG_ENV.'tp_'.$foto);
    	}
	}

	function eliminoFoto($id,$page,$campo,$orden,$foto){
		$obj=$this->datosEnvase->buscarId(base64_decode($id));
		$obj->setFoto('');
		$this->delFoto($foto);
		$this->datosEnvase->modificar($obj);
		require(URL_VISTA_BACK."envedit.php");		
	}

	public function edit($id,$page,$campo,$orden){	
		$obj=$this->datosEnvase->buscarId(base64_decode($id));	
		require(URL_VISTA_BACK."envedit.php");
	}

	public function editado($tipo,$capacidad,$coeficiente,$page,$campo,$orden,$id,$standBy,$fotoOld){
		$imagen=$fotoOld;
		if($_FILES){
			if((isset($_FILES['foto'])) && ($_FILES['foto']['name'] != '')){
				if(!empty($fotoOld)){
					$this->delFoto($fotoOld);
				}				
				$file = basename($_FILES['foto']['name']);			
	    		$imagen = $this->limpiarString($tipo);	
				$fileExtension = pathinfo($file, PATHINFO_EXTENSION);
				$imageInfo = getimagesize($_FILES['foto']['tmp_name']);
				$imagen=$imagen.'.'.$fileExtension;
				move_uploaded_file($_FILES["foto"]["tmp_name"], URL_IMG_ENV .$imagen);

				$this->creoThumb($imagen);
			}				
		}

		$c=new Envase($tipo,$capacidad,$coeficiente,$imagen,$standBy);
		$c->setId($id);
		$this->datosEnvase->modificar($c);
		header("Location: ".DIR."Envase/listado/".$page."/".$campo."/".$orden);	
	}

	public function listado($page=1,$campo='id',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$envases = array();
	    $totalCount=$this->datosEnvase->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    

		$envases = $this->datosEnvase->listar($page,$campo,$orden);

		require(URL_VISTA_BACK."envlist.php");
	}

	
	public function nuevos(){
	$env=array(
		array('tipo'=>'Porron',
		      'capacidad'=>0.33,
		      'coeficiente'=>1.33,
		      ),
		array('tipo'=>'Lata',
		      'capacidad'=>0.50,
		      'coeficiente'=>1.2,     
		      ),
		array('tipo'=>'Botella',
		      'capacidad'=>1,
		      'coeficiente'=>1,	      
		      ),
		array('tipo'=>'Botellon',
		      'capacidad'=>2,
		      'coeficiente'=>0.9,		      
		      ),
		array('tipo'=>'Barril',
		      'capacidad'=>5,
		      'coeficiente'=>0.7,	      
		      )
		);
		$lista=array();
		$id=0;
		foreach ($env as $value) {
			$tipo=$value['tipo'];
			$capacidad=$value['capacidad'];
			$coeficiente=$value['coeficiente'];       
			$foto='';
			$c=new Envase($tipo,$capacidad,$coeficiente,$foto);
			$this->datosEnvase->insertar($c);
		}
		$this->envadd();
	}	
}

?>