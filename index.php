<?php 
    $c=0;
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $genNew = substr(str_shuffle($permitted_chars), 22, 22);
    $web = 'https://chat.whatsapp.com/'.$genNew;
    $txt = $_SERVER['DOCUMENT_ROOT'] . '/grupos.txt';
    $txtc = $_SERVER['DOCUMENT_ROOT'] . "/contador.txt";
    echo '<script> console.log('. json_encode( $web ) .') </script>'; //Debug On 
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
        echo '<script>setTimeout(function(){ 
            window.location.reload(); 
        }, 3000);</script>';
    } else {
        $contenido = trim(file_get_contents($txtc));
        $c = intval($contenido);
        $c++;
        file_put_contents($txtc,$c);
        echo '<script>setTimeout(function(){ 
            window.location.reload(); 
        }, 2000);</script>';

    }

?>
