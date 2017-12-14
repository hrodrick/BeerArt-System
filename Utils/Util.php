    <?php
	function ver_orden($orden){
	   if ($orden=="asc") {
	      $orden="desc";
	   }
	   else {
	      $orden="asc";
	   }
	   return $orden;
	}

	function getImgOrden($orden){
	    if ($orden=="asc") {
	       $img=DIR.URL_IMG."s_asc.png";
	    }
	    else {
	       $img=DIR.URL_IMG."s_desc.png";
	    }
	    return $img;
	}	

	function standBy($s){
		$sb=array();
	    if($s){
	    	$sb=array(
		        	'tip'=>"Habilitar",
		        	'standby'=>"&nbsp;SI&nbsp;",
		        	'label'=>"danger");
	    }else{
	    	$sb=array(
		        'tip'=>"Deshabilitar",
		        'standby'=>"NO",
		        'label'=>"success");
	    }
	    return $sb;		
	}

	$img=getImgOrden($orden);

    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>