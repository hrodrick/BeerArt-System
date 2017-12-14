<?php namespace Config;

    class Router {
        /**
         * Se encarga de direccionar a la pagina solicitada
         *
         * @param Request
         */
        public function __construct()
        {
            # code...
        }
        
        public static function direccionar(Request $request) {
            /**
             *  
             */
            $controlador = $request->getControlador() . 'Controller';
            /**
             * 
             */
            $metodo = $request->getMetodo();
            /**
             * 
             */
            $parametros = $request->getParametros();
            /**
             * 
             */
            $mostrar = "Controllers\\". $controlador;
            /**
             * 
             */
            $controlador = new $mostrar;
            /**
             * 
             */
            /*
            echo "<BR>CONTROLADOR en ROUTER<BR>";
            var_dump($controlador);
            echo "<BR>METODO en ROUTER<BR>";
            var_dump($metodo);
            echo "<BR>PARAMETROS en ROUTER<BR>";            
            var_dump($parametros);    
            */     
            if(!isset($parametros)) {
                call_user_func(array($controlador, $metodo));
            } else {
                call_user_func_array(array($controlador, $metodo), $parametros);
            }
        }
    }

?>