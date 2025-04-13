<?php
//importamos los archivos del model
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';
require_once 'app/models/Globals.php';

class SunatController
{
    private $global;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->bitacora = new Bitacora();
        $this->global = new Config();
        $this->log = new Log();
    }
    //funcion para obtener un dato especifico
    public function busqueda_sunat_ruc()
    {
        try
        {
            // $config = $this->global->obtener_configuracion();// para las configuraciones
            $ruc =  $_REQUEST["nruc"] ;
            // $consulta = $config->conf_api_consulta;
            // $token = $config->conf_api_token;
            $consulta = 2;
            $token = 'apis-token-3655.Qh5OzK5gwWjdvZgwq01-k2qWbHPkMw-G';
            if($consulta == 1)
            {
                $url = 'https://apiperu.dev/api/ruc/' . $ruc;
                $referencia = 'https://apiperu.dev/api/ruc';                
            }
            else if($consulta == 2)
            {
                $url = 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc;
                $referencia = ' http://apis.net.pe/api-ruc';
            }

            $curl = curl_init(); // Iniciar llamada a API
            // Buscar RUC
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                'Referer: ' . $referencia,
                'Authorization: Bearer ' . $token
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) 
            {
                $rpta = 'error';
                $mensaje = $err;
                echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
            } 
            else 
            {
                echo json_encode($response);
            }
        }
        catch(Exception $e)
        {
            echo json_encode(array("rpta"=>'error', "mensaje" => 'Hubo un error Critico, Intente contactar con el administrador del sistema'));
        }    
    }
     //funcion para obtener un dato especifico
    public function busqueda_sunat_dni()
    {
        try
        {
            // $config = $this->global->obtener_configuracion();// para las configuraciones
            $dni = $_REQUEST["ndni"] ;
            // $consulta = $config->conf_api_consulta;
            // $token = $config->conf_api_token;
            $consulta = 2;
            $token = 'apis-token-3655.Qh5OzK5gwWjdvZgwq01-k2qWbHPkMw-G';

            if($consulta == 1)
            {
                $url = 'https://apiperu.dev/api/dni/' . $dni;
                $referencia = 'https://apiperu.dev/api/dni';                
            }
            else if($consulta == 2)
            {
                $url = 'https://api.apis.net.pe/v1/dni?numero=' . $dni;
                $referencia = 'https://apis.net.pe/consulta-dni-api';
            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                'Referer: ' . $referencia,
                'Authorization: Bearer ' . $token
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) 
            {
                $rpta = 'error';
                $mensaje = $err;
                echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
            } 
            else 
            {
                echo json_encode($response);
            }
        }
        catch(Exception $e)
        {
            echo json_encode(array("rpta"=>'error', "mensaje" => 'Hubo un error Critico, Intente contactar con el administrador del sistema'));
        }
    }
}
