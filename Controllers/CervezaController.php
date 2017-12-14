<?php
namespace Controllers;

use Daos\Lista\ListaCervezaDAO as ListaCervezaDAO;
use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\DB\DBEnvaseDAO as DBEnvaseDAO;
use Daos\DB\DBEnvxcerDAO as DBEnvxcerDAO;
use Daos\DB\DBLineaPedidoDAO as DBLineaPedidoDAO;
use Models\Cerveza as Cerveza;
use Models\Envxcer as Envxcer;
use Models\EnvxcerDTO as EnvxcerDTO;
use Models\CervezaConEnvDTO as CervezaConEnvDTO;
use Models\LineaPedido as LineaPedido;
use Utils\Thumb as Thumb;

class CervezaController{

	private $datosTipoCerveza;
	private $datosEnvase;
	private $datosEnvxcer;
	private $datosLineaPedido;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		//$this->datosTipoCerveza = ListaCervezaDAO::getInstance();
		$this->datosTipoCerveza = DBCervezaDAO::getInstance();
		$this->datosLineaPedido = DBLineaPedidoDAO::getInstance();
		$this->datosEnvase = DBEnvaseDAO::getInstance();
		$this->datosEnvxcer = DBEnvxcerDAO::getInstance();	
	}

 	public function index(){
		require(URL_VISTA_BACK."home.php");
	}

 	public function ceradd(){
 		$cerveza='';
 		$descripcion='';
 		$precioXLitro='';
		require(URL_VISTA_BACK."ceradd.php");
	}

	public function limpiarString($texto){
	    $textoLimpio = preg_replace('([^A-Za-z0-9])', '_', $texto);	     					
	    return $textoLimpio;
	}

	public function nuevo($cerveza,$descripcion,$precioXLitro){
		$imagen='';
		$msg;
		$obj=$this->datosTipoCerveza->buscarTipo($cerveza);
		if(!is_object($obj)){		
			if($_FILES){
				if((isset($_FILES['foto'])) && ($_FILES['foto']['name'] != '')){
					$file = basename($_FILES['foto']['name']);			
		    		$imagen = $this->limpiarString($cerveza);	
					$fileExtension = pathinfo($file, PATHINFO_EXTENSION);
					$imageInfo = getimagesize($_FILES['foto']['tmp_name']);
					$imagen=$imagen.'.'.$fileExtension;
					move_uploaded_file($_FILES["foto"]["tmp_name"], URL_IMG_CER .$imagen);

					$this->creoThumb($imagen);
				}		
			}

			$c=new Cerveza($cerveza,$descripcion,$precioXLitro,$imagen);
			$this->datosTipoCerveza->insertar($c);			
	 		$cerveza='';
	 		$descripcion='';
	 		$precioXLitro='';	
	 		$msg="<<< La carga fue exitosa >>>";
	 	}		

		require(URL_VISTA_BACK."ceradd.php");
	}

	public function creoThumb($foto){
		$thumb = new Thumb();
		$thumb->loadImage(URL_IMG_CER.$foto);
		$thumb->resize(333, 'height');
		$thumb->save(URL_IMG_CER.'tp_'.$foto);

		$thumb->loadImage(URL_IMG_CER.$foto);
		$thumb->resize(116, 'height');
		if($thumb->getWidth()>227){
			$thumb->crop(227,116);
		}
		$thumb->save(URL_IMG_CER.'t1_'.$foto);				

		$thumb->loadImage(URL_IMG_CER.$foto);
		$thumb->resize(73, 'height');
		$thumb->save(URL_IMG_CER.'t2_'.$foto);				

		unlink(URL_IMG_CER.$foto);
	}	

	public function borrar($id,$page,$campo,$orden,$foto=''){
		$obj=$this->datosTipoCerveza->buscarId(base64_decode($id));
		$pedidos=0;
		$msg='';
		if(is_object($obj)){
			$pedidos=$this->datosLineaPedido->contarPorCerveza(base64_decode($id));
			if($pedidos==0){
				$msg='S';		
				$this->datosTipoCerveza->eliminar(base64_decode($id));
				$this->datosEnvxcer->eliminarPorCervezas(base64_decode($id));
				if(!empty($foto)){
					$this->delFoto($foto);
				}				
			}else{
				$msg='N';
			}
		}

		header("Location: ".DIR."Cerveza/listado/".$page."/".$campo."/".$orden."/".$msg);
	}

	public function standBy($id,$page,$campo,$orden){
		$this->datosTipoCerveza->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Cerveza/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		$this->datosTipoCerveza->ordenarListado($campo,$orden);
		header("Location: ".DIR."Cerveza/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorderConEnv($page,$campo,$orden){
		$this->datosTipoCerveza->ordenarListado($campo,$orden);
		header("Location: ".DIR."Cerveza/listadoConEnv/".$page."/".$campo."/".$orden);		
	}

	function delFoto($foto){
		if(is_file(URL_IMG_CER.'tp_'.$foto)){
	        unlink(URL_IMG_CER.'t1_'.$foto);
	        unlink(URL_IMG_CER.'t2_'.$foto);
	        unlink(URL_IMG_CER.'tp_'.$foto);
    	}
	}

	function eliminoFoto($id,$page,$campo,$orden,$foto){
		$obj=$this->datosTipoCerveza->buscarId($id);
		$obj->setFoto('');
		$this->delFoto($foto);
		$this->datosTipoCerveza->modificar($obj);
		require(URL_VISTA_BACK."ceredit.php");		
	}

	public function edit($id,$page,$campo,$orden){
		$error=0;
		$obj=$this->datosTipoCerveza->buscarId(base64_decode($id));
		require(URL_VISTA_BACK."ceredit.php");
	}

	public function editado($cerveza,$descripcion,$precioXLitro,$page,$campo,$orden,$id,$standBy,$fotoOld,$cervezaOld){
		$imagen=$fotoOld;
		$obj=$this->datosTipoCerveza->buscarTipo($cerveza);
		$error=0;

		if(($cerveza!=$cervezaOld)&&(is_object($obj))){
			$error=1;
			require(URL_VISTA_BACK."ceredit.php");
		}
		if(!$error){
			if($_FILES){
				if((isset($_FILES['foto'])) && ($_FILES['foto']['name'] != '')){
					if(!empty($fotoOld)){
						$this->delFoto($fotoOld);
					}				
					$file = basename($_FILES['foto']['name']);			
		    		$imagen = $this->limpiarString($cerveza);	
					$fileExtension = pathinfo($file, PATHINFO_EXTENSION);
					$imageInfo = getimagesize($_FILES['foto']['tmp_name']);
					$imagen=$imagen.'.'.$fileExtension;
					move_uploaded_file($_FILES["foto"]["tmp_name"], URL_IMG_CER .$imagen);

					$this->creoThumb($imagen);
				}		
			}

			$c=new Cerveza($cerveza,$descripcion,$precioXLitro,$imagen,$standBy);
			$c->setId($id);

			$this->datosTipoCerveza->modificar($c);
			header("Location: ".DIR."Cerveza/listado/".$page."/".$campo."/".$orden);
		}
	}

	public function editConEnv($envxcerCheck,$page,$campo,$orden,$idCerveza){
		$envasesXcerveza=array();

		$envases = $this->datosEnvase->listAll();			

		$envxcer = array();
		$envxcer = $this->datosEnvxcer->listarXCerveza($idCerveza);

		foreach ($envxcer as $value) {
			if(in_array($value->getIdEnv(),$envxcerCheck)){
				if($value->getTiene()==0){
					$value->setTiene(1);
					$this->datosEnvxcer->modificar($value);
				}
			}else{
				if($value->getTiene()==1){
					$value->setTiene(0);
					$this->datosEnvxcer->modificar($value);
				}
			}
		}
		header("Location: ".DIR."Cerveza/listadoConEnv/".$page."/".$campo."/".$orden);	
	}

	public function listado($page=1,$campo='id',$orden='asc',$m=''){
	    $countPages = 0;
	    $totalCount = 0;
	    $msg='';
		$cervezas = array();
		if(isset($m)){
			if($m=='N'){
				$msg="No es posible eliminar esta Cerveza";
			}else{
				if($m=='S'){
					$msg="La Cerveza se elimino correctamente";
				}
			}
		}
	    $totalCount=$this->datosTipoCerveza->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
		$cervezas = $this->datosTipoCerveza->listar($page,$campo,$orden);

		require(URL_VISTA_BACK."cerlist.php");
	}

	public function listadoConEnv($page=1,$campo='id',$orden='asc'){
		$id;
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
		$envases = array();
		$envxcer = array();
		$obj;
		$objDTO;
	    $totalCount=$this->datosTipoCerveza->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
		$cervezas = $this->datosTipoCerveza->listarConEnv($page,$campo,$orden);

		$envases = $this->datosEnvase->listAll();

		/// aca cargo a la cerveza el array de envases
		foreach ($cervezas as $keyCer => $valueCer) {
			$idCer=$valueCer->getId();
			foreach ($envases as $keyEnv => $valueEnv) {
				$idEnv=$valueEnv->getId();
				/*
				if($this->datosEnvxcer->contarXCerveza($idCer)==count($envases)){
					$obj=$this->datosEnvxcer->buscarCerEnv($idCer,$idEnv);
					$id=$obj->getId();
				}
				else{
					$obj = new Envxcer($idCer,$idEnv,0);
					$id=$this->datosEnvxcer->insertarGetId($obj);
				}
				*/
				
				$obj=$this->datosEnvxcer->buscarCerEnv($idCer,$idEnv);
				if(is_object($obj)){
					$id=$obj->getId();					
				}
				else{
					$obj = new Envxcer($idCer,$idEnv,0);
					$id=$this->datosEnvxcer->insertarGetId($obj);					
				}

				$dCer;
				$idEnv;
				$tiene=$obj->getTiene();
				$tipo=$valueEnv->getTipo();
				$capacidad=$valueEnv->getCapacidad();
				$coeficiente=$valueEnv->getCoeficiente();
				$foto=$valueEnv->getFoto();
				$standBy=$valueEnv->getStandBy();				
				$objDTO=new EnvxcerDTO($id,$idCer,$idEnv,$tiene,$tipo,$capacidad,$coeficiente,$foto,$standBy);
				$valueCer->addEnvase($objDTO);
			}
		}


		require(URL_VISTA_BACK."cerWenv.php");
	}




	
	public function nuevos(){
	$cer=array(
		array('tipo'=>'Nietzsche Ale',
		      'precio'=>120,
		      'descripcion'=>'Descripcion de Nietzsche Ale',
		      'foto'=>'Nietzsche_Ale.jpg'
		      ),
		array('tipo'=>'Foucault Ale',
		      'precio'=>135,
		      'descripcion'=>'Descripcion de Foucault Ale',
		      'foto'=>'Foucault_Ale.jpg'
		      ),
		array('tipo'=>'Seneca Bier',
		      'precio'=>125,
		      'descripcion'=>'Descripcion de Seneca Bier',
		      'foto'=>'Seneca_Bier.jpg'
		      ),
		array('tipo'=>'Epicuro Ale',
		      'precio'=>90,
		      'descripcion'=>'Descripcion de Epicuro Ale',
		      'foto'=>'Epicuro_Ale.jpg'
		      ),
		array('tipo'=>'Golden Socrates Ale',
		      'precio'=>150,
		      'descripcion'=>'Descripcion de Golden Socrates Ale',
		      'foto'=>'Golden_Socrates_Ale.jpg'
		      ),
		array('tipo'=>'Platon Ale',
		      'precio'=>155,
		      'descripcion'=>'Descripcion de Platon Ale',
		      'foto'=>'Platon_Ale.jpg'
		      ),
		array('tipo'=>'Dark Sartre Ale',
		      'precio'=>140,
		      'descripcion'=>'Descripcion de Dark Sartre Ale',
		      'foto'=>'Dark_Sartre_Ale.jpg'
		      ),
		array('tipo'=>'Marx Red Ale',
		      'precio'=>130,
		      'descripcion'=>'Marx Red Ale',
		      'foto'=>'Marx_Red_Ale.jpg'
		      ),
		array('tipo'=>'Kant Ale',
		      'precio'=>120,
		      'descripcion'=>'Kant Ale',
		      'foto'=>'Kant_Ale.jpg'
		      ),
		array('tipo'=>'Bock Amo Bier',
		      'precio'=>160,
		      'descripcion'=>'Bock Amo Bier',
		      'foto'=>'Bock_Amo_Bier.jpg'
		      ),
		array('tipo'=>'Heidegger',
		      'precio'=>150,
		      'descripcion'=>'Heidegger',
		      'foto'=>'Heidegger.jpg'
		      ),
		array('tipo'=>'Kierkegaard Bier',
		      'precio'=>155,
		      'descripcion'=>'Kierkegaard Bier',
		      'foto'=>'Kierkegaard_Bier.jpg'
		      )
		);
		$lista=array();
		$id=0;
		foreach ($cer as $value) {
			$cerveza=$value['tipo'];
			$precioXLitro=$value['precio'];
			$descripcion=$value['descripcion'];
			$foto=$value['foto'];
			$c=new Cerveza($cerveza,$descripcion,$precioXLitro,$foto);
			$this->datosTipoCerveza->insertar($c);
		}
		$this->ceradd();
	}	
}

?>