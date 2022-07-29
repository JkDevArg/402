<?php 
    //error_reporting(0);
    require_once 'conexion.php';
    $c=0;
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $genNew = substr(str_shuffle($permitted_chars), 22, 22);
    $web = 'https://chat.whatsapp.com/'.$genNew; //me olvide de cambiar xD
    $txt = $_SERVER['DOCUMENT_ROOT'] . '/grupos.txt';
    $txtc = $_SERVER['DOCUMENT_ROOT'] . "/contador.txt";
    echo '<script> console.log('. json_encode( $web ) .') </script>'; //Debug On

    function curl($url) {

        $ch = curl_init($url); // Inicia sesión cURL

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena
        curl_setopt($ch, CURLOPT_PROXY, proxyRotate()); //utilizamos un proxy para evitar que Whatsapp se bloquee por exceso de solicitudes
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS

        $info = curl_exec($ch); // Establece una sesión cURL y asigna la información a la variable $info

        curl_close($ch); // Cierra sesión cURL

        return $info; // Devuelve la información de la función
    }

    function telegramMsj($web){

      $token = "COLOCA AQUÍ TU TOKEN";
      $id = "COLOCA LA ID DEL GRUPO/PAGINA/USUARIO donde se enviara el mensaje";
      $mensaje = "Se encontro grupo de whatsapp: " . $web;

      $urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";

      $te = curl_init();
      curl_setopt($te, CURLOPT_URL, $urlMsg);
      curl_setopt($te, CURLOPT_POST, 1);
      curl_setopt($te, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$mensaje");
      curl_setopt($te, CURLOPT_RETURNTRANSFER, true);
          
      $server_output = curl_exec($te);
      curl_close($te);

      //return $server_output;
    }

    function proxyRotate(){
      //Obtener API de proxy en https://www.proxyrotator.com/
      $rotateApi = 'http://falcon.proxyrotator.com:51337/?apiKey=YOUR-API-KEY&port=80';
      $ch = curl_init($rotateApi);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      $response = curl_exec($ch);
      curl_close($ch);
      $json = json_decode($response, true);
      $proxy = $json['proxy'];
      return $proxy;
    }

    $sitioweb = curl($web);  // Ejecuta la función curl
    echo $sitioweb;

    if (strpos($sitioweb, 'style="background-image: url') !== false) {
        //OBTENEMOS EL TITULO CON DOM
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($sitioweb);
        $titulo = $dom->getElementsByTagName('h2'); //Buscamos el tag h2

        // recorremos los elementos h2
        foreach ($titulo as $texto) {
          // miramos de localizar el texto a eliminar
          $pos = strpos($texto->textContent, "Parece que WhatsApp no está instalado");
          if ($pos === false) {
            // agregamos el contenido encerrándolo entre h2
              $fin .= $texto->textContent;
          }
        }
        $gdate = date('Y-m-d');
        $sql = "INSERT INTO gwhatsapp (nombre, enlace, fecha) VALUES (?,?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$fin, $web, $gdate]);
        $errors = libxml_get_errors(); //Limpiamos los errores por si las moscas
        echo '<body onload="grupoNoti()"></body>
        <script>
            function grupoNoti() {
              if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
              }

              else if (Notification.permission === "granted") {
                var notification = new Notification("Grupo Encontrado '. $web .'");
              }
             
              else if (Notification.permission !== '."'denied'".') {
                Notification.requestPermission(function (permission) {
                  if (permission === "granted") {
                    var notification = new Notification("Grupo Encontrado '. $web .'");
                  }
                });
              }
             
            }Notification.requestPermission().then(function(result) {
              console.log(result);
            });function spawnNotification(theBody,theIcon,theTitle) {
              var options = {
                  body: theBody,
                  icon: theIcon
              }
              var n = new Notification(theTitle,options);
            }
            </script>
        ';
        file_put_contents($txt ,$web."\n",FILE_APPEND);
        echo telegramMsj($web);
	echo '<script>setTimeout(function(){ 
            window.location.reload(); 
        }, 300);</script>';
        
    } else {
        $contenido = trim(file_get_contents($txtc));
        $c = intval($contenido);
        $c++;
        //echo telegramMsj($web);
        file_put_contents($txtc,$c);
        echo '<script> console.log("Grupo Desconocido") </script>'; //Debug On
        echo '<script>console.log("'.proxyRotate().'")</script>';
        echo '<script>setTimeout(function(){ 
            window.location.reload(); 
        }, 200);</script>';

    }

?>
