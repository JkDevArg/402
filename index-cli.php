<?php 
$rerun_flag=true;
while($rerun_flag == true){
    //error_reporting(0);
    set_time_limit(0);
	  $c=0;
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $genNew = substr(str_shuffle($permitted_chars), 22, 22);
    $web = 'https://chat.whatsapp.com/'.$genNew;
    $txt = $_SERVER['DOCUMENT_ROOT'] . '/grupos.txt';
    $txtc = $_SERVER['DOCUMENT_ROOT'] . "/contador.txt";
    if (!function_exists('curl')){
      function curl($url) {
        $ch = curl_init($url); // Inicia sesión cURL
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
        $info = curl_exec($ch); // Establece una sesión cURL y asigna la información a la variable $info
        curl_close($ch); // Cierra sesión cURL
        return $info; // Devuelve la información de la función
      }
    }
    
    if (!function_exists('telegramMsj')){
      function telegramMsj($web){
        $token = "TOKEN ID";
        $id = "AQUI LA ID DEL GRUPO/PAGINA/USUARIO donde se enviara el mensaje";
        $mensaje = "Se encontro grupo de whatsapp: " . $web;
        $urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
        $te = curl_init();
        curl_setopt($te, CURLOPT_URL, $urlMsg);
        curl_setopt($te, CURLOPT_POST, 1);
        curl_setopt($te, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$mensaje");
        curl_setopt($te, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($te);
        curl_close($te);
      }
    }

    $sitioweb = curl($web);  // Ejecuta la función curl
    if (strpos($sitioweb, 'style="background-image: url') !== false) {
      echo "Se encontro un grupo: ".$web;
      echo "\n";
      file_put_contents($txt,$web."\n",FILE_APPEND);
      echo telegramMsj($web);
      sleep(2);
      $rerun_flag=true;
    } else {
      $contenido = trim(file_get_contents('contador.txt'));
      $fp = fopen('contador.txt', 'w');
      $c = intval($contenido);
      $c++;
      fwrite($fp,$c);
      fclose($fp);
      //file_put_contents($txtc,$c);
      echo 'No se encontro grupo de whatsapp'; //Debug On
      echo "\nEnlace: ".$web;
      echo "\n";
      sleep(2);  
      $rerun_flag=true;
      echo chr(27).chr(91).'H'.chr(27).chr(91).'J';  //Limpiamos la terminal para que no se llene de texto la terminal
    }
  }
?>
