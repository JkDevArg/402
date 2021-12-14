<?php 
    $c=0;
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $genNew = substr(str_shuffle($permitted_chars), 22, 22);
    $web = 'https://chat.whatsapp.com/'.$genNew;
    $txt = $_SERVER['DOCUMENT_ROOT'] . '/grupos.txt';
    $txtc = $_SERVER['DOCUMENT_ROOT'] . "/contador.txt";
    echo '<script> console.log('. json_encode( $web ) .') </script>'; //Debug On 

    function telegramMsj($web){

      $token = "TOKEN DEL BOT";
      $id = "ID DEL GRUPO ";
      $mensaje = "Se encontro grupo de whatsapp: " . $web; // esto puedes cambiar por lo que desees ya uqe solo es un mensaje aclarando que encontro un grupo eso si la variable $web no borrarla

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

    function curl($url) {

        $ch = curl_init($url); // Inicia sesión cURL

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS

        $info = curl_exec($ch); // Establece una sesión cURL y asigna la información a la variable $info

        curl_close($ch); // Cierra sesión cURL

        return $info; // Devuelve la información de la función

    }

    $sitioweb = curl($web);  // Ejecuta la función curl

    echo $sitioweb;
    if (strpos($sitioweb, 'style="background-image: url') !== false) {
        echo "<script>setTimeout(function(){ 
            window.open('". $web ."', '_blank');
        }, 1000);</script>';";
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
        file_put_contents($txt,$web."\n",FILE_APPEND);
        echo telegramMsj($web); //Si encuentra un grupo automaticamente enviara el enlace desde el bot al grupo de telegram
        echo '<script>setTimeout(function(){ 
            window.location.reload(); 
        }, 3000);</script>';
    } else {
        $contenido = trim(file_get_contents($txtc));
        //echo telegramMsj($web); //Solo descomentar si es necesario hacer pruebas
        $c = intval($contenido);
        $c++;
        file_put_contents($txtc,$c);
        echo '<script> console.log("Grupo Desconocido") </script>'; //Imprime si un grupo es desconocido por consola
        echo '<script>setTimeout(function(){ 
            window.location.reload(); 
        }, 2000);</script>';
        //Si quieren que el chequeo sea más rápido cambien el 2000 por 500. Puede ser para ambos.

    }

?>
