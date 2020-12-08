<?php
if (!function_exists('encrypt')) {
    function encrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
    }
}

if (!function_exists('decrypt')) {
    function decrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }
}

if(!function_exists("TimeToSec"))
{
    function TimeToSec($time) {
        $sec = 0;
        foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
        return $sec;
    }
}
if(!function_exists("d_m_Y"))
{
    function d_m_Y($fecha)
    {
        $dia = substr($fecha,8,2);
        $mes = substr($fecha,5,2);
        $a = substr($fecha,0,4);
        $fecha = "$dia-$mes-$a";
        return $fecha;
    }
}
if(!function_exists("Y_m_d"))
{
    function Y_m_d($fecha)
    {
        $a = substr($fecha,6,4);
        $mes = substr($fecha,3,2);
        $dia = substr($fecha,0,2);
        $fecha = "$a-$mes-$dia";
        return $fecha;
    }
}
if(!function_exists("hora_A_P"))
{
    function hora_A_P($hora)
    {
        $hora_pre = date_create($hora);
        $hora_pos = date_format($hora_pre, 'g:i A');
        return $hora_pos;
    }
}
if(!function_exists("quitar_tildes"))
{
    function quitar_tildes($cadena)
    {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹"," ");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","_");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }
}
if(!function_exists("diferenciaDias"))
{
    function diferenciaDias($inicio, $fin)
    {
        $inicio = strtotime($inicio);
        $fin = strtotime($fin);
        $dif = $fin - $inicio;
        $diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
        return ceil($diasFalt);
    }
}
if(!function_exists("divtextlin"))
{
    function divtextlin( $text, $width = '80', $lines = '10', $break = '\n', $cut = 0 ) {
        $wrappedarr = array();
        $wrappedtext = wordwrap( $text, $width, $break , true );
        $wrappedtext = trim( $wrappedtext );
        $arr = explode( $break, $wrappedtext );
        return $arr;
    }
}
if(!function_exists("array_procesor"))
{
    function array_procesor($array)
    {
        $ygg=0;
        $maxlines=1;
        $array_a_retornar=array();
        foreach ($array as $key => $value) {
            /*Descripcion*/
            $nombr=$value[0];
            /*character*/
            $longitud=$value[1];
            /*fpdf width*/
            $size=$value[2];
            /*fpdf alignt*/
            $aling=$value[3];
            if(strlen($nombr) > $longitud)
            {
                $i=0;
                $nom = divtextlin($nombr, $longitud);
                foreach ($nom as $nnon)
                {
                    $array_a_retornar[$ygg]["valor"][]=$nnon;
                    $array_a_retornar[$ygg]["size"][]=$size;
                    $array_a_retornar[$ygg]["aling"][]=$aling;
                    $i++;
                }
                $ygg++;
                if ($i>$maxlines) {
                    // code...
                    $maxlines=$i;
                }
            }
            else {
                // code...
                $array_a_retornar[$ygg]['valor'][]=$nombr;
                $array_a_retornar[$ygg]['size'][]=$size;
                $array_a_retornar[$ygg]["aling"][]=$aling;
                $ygg++;

            }
        }

        $ygg=0;
        foreach($array_a_retornar as $keys)
        {
            for ($i=count($keys["valor"]); $i <$maxlines ; $i++) {
                // code...
                $array_a_retornar[$ygg]["valor"][]="";
                $array_a_retornar[$ygg]["size"][]=$array_a_retornar[$ygg]["size"][0];
                $array_a_retornar[$ygg]["aling"][]=$array_a_retornar[$ygg]["aling"][0];
            }
            $ygg++;
        }
        return $array_a_retornar;

    }
}
if(!function_exists("restar_meses")){
    function restar_meses($fecha, $cantidad)
    {
        $nuevafecha = strtotime ( '-'.$cantidad.' month' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
        return $nuevafecha;
    }
}
if(!function_exists("sumar_meses")){
    function sumar_meses($fecha, $cantidad)
    {
        $nuevafecha = strtotime ( '+'.$cantidad.' month' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
        return $nuevafecha;
    }
}
if(!function_exists("nombre_mes")){
    function nombre_mes($n){
        $mes = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        return $mes[$n-1];
    }
}
if(!function_exists("nombre_mes_min")){
    function nombre_mes_min($n){
        $mes = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
        return $mes[$n-1];
    }
}
if(!function_exists("edad_decimal")){
    function edad_decimal($fecha){
        $dob_day = substr($fecha,8,2);
        $dob_month = substr($fecha,5,2);
        $dob_year = substr($fecha,0,4);
        $year   = gmdate('Y');
        $month  = gmdate('m');
        $day    = gmdate('d');
        //seconds in a day = 86400
        $days = (mktime(0,0,0,$month,$day,$year) - mktime(0,0,0,$dob_month,$dob_day,$dob_year))/86400;
        return $days / 365.242199;
    }
}
if(!function_exists("fecha_rango")){
    function fecha_rango($fecha_inicio, $fecha_fin, $fecha){

        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);

        if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {

            return true;

        } else {

            return false;

        }
    }
}

if(!function_exists("tiempo_transcurrido")){
    function tiempo_transcurrido($fecha) {
        $intervalos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año");
        $duraciones = array("60","60","24","7","4.35","12");

        $ahora = time();
        $Fecha_Unix = strtotime($fecha);
        if($ahora > $Fecha_Unix) {
            $diferencia     =$ahora - $Fecha_Unix;
        } else {
            $diferencia     = $Fecha_Unix -$ahora;
        }
        for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
            $diferencia /= $duraciones[$j];
        }

        $diferencia = round($diferencia);

        if($diferencia != 1) {
            $intervalos[5].="e"; //MESES
            $intervalos[$j].= "s";
        }

        return "$diferencia $intervalos[$j]";
    }
}
if(!function_exists("getRealIP")){
    function getRealIP()
    {

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }

    }

}
if(!function_exists("random_strings")){
    function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789abcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),0, $length_of_string);
    }
}
if(!function_exists("encrypt_c")){
    function encrypt_c($val){
        $ci =& get_instance();
        $ci->load->library('encryption');
        return $ci->encryption->encrypt($val);
    }
}
if(!function_exists("generate_email_invite")){
    function generate_email_invite(){
        $ci =& get_instance();
        $ci->load->model('LoginModel','login');
        $mail = uniqid()."@mail.com";

        $existe = $ci->login->exits_user($mail);
        if($existe==1){
            $correct=true;
            while ($correct==true)
            {
                $mail = uniqid()."@mail.com";
                $existe = $ci->login->exits_user($mail);
                if($existe==0){
                    $correct=false;
                }
            }
        }
        return $mail;
    }
}

if(!function_exists("decrypt_c")){
    function decrypt_c($val){
        $ci =& get_instance();
        $ci->load->library('encryption');
        return $ci->encryption->decrypt($val);
    }
}