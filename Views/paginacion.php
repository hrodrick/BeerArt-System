      <div class="container">
         <ul class="pagination">
		   <?php
		   $limite=5;
		   $min=1;
		   $max=$countPages;
		   if($countPages>$limite){
		       if($page<=3){
		           $min=1;
		           $max=$limite;
		       }elseif($page+$limite>=$countPages){
		           $min=$countPages-$limite+1;
		           $max=$countPages;
		       }elseif($page){
		               $min=$page-2;
		               $max=$page+2;
		       }
		       if($page>1){
		           $atras=$page-1;
		           echo '<li><a href="'.DIR.'<?=$destino;?>'.$atras.'"><<</a></li>';
		       }else{
		           echo '<li><a href="#"><<</a></li>';
		       }
		   }
		   for($pages=$min;$pages <= $max;$pages++) {
		                 if($page==$pages){
		                     $activa=" class='active'";
		                 }else{
		                     $activa="";
		                 }
		             ?>
		             <li<?php echo $activa;?>><a href="<?=DIR.$destino?><?= $pages;?>" data-toggle="tooltip" title="Ir a la p&aacute;gina <?php echo $pages;?>"><?php echo $pages;?></a></li>
		   <?php
		   }
		       if(($page<$countPages)AND($countPages>$limite)){
		           $next=$page+1;
		           echo '<li><a href="'.DIR.$destino.$next.'">>></a></li>';
		       }
		   ?>
         </ul>
      </div>