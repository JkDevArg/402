# 402 ~ Whatsapp Buscador de Grupos
Genera una cadena alfanumerica para chequear si existen grupos de whatsapp con esa cadena generada.


### Cambios 1.0

- [x] Automatizado
- [x] Se actualiza 2 segs al no hallar un grupo
- [x] Se actualiza 3 segs al hallar un grupo
- [x] Guarda los grupos encontrados en un bloc de notas "grupos.txt"
- [x] Contador de cadenas generadas "contador.txt"

## Cambios 2.0
- [x] Mediante un IF verifica si existe el grupo mediante un style="background-image: url
- [x] Muestra Notificación en el escritorio si encuentra un grupo
- [x] Envia enlace del grupo por telegram

## Cambios 3.0
- [x] Guarda los datos en Base de Datos (MySQL[PDO])
- [x] Obtiene el titúlo del grupo y lo guarda en la Base de Datos
- [x] Mostrar los grupos en una tabla
- [x] Se ejecuta en script CLI

## Cambios 4.0
- [x] Se añadio un Proxy rotator para que whatsapp no bloqueara la petición por IP (CLI)

## Cambios Pendientes
- [ ] aÑADIR Proxy Rotator (Solo GUI)
- [ ] Envia un correo con el grupo hallado (En proceso)
- [ ] ~~Envia el enlace del grupo por whatsapp (Anulado)~~



## Requerimientos
* Lib cURL
* PHP 7.4+
* MySQL


## Capturas
<a href="https://ibb.co/8svpvVq"><img src="https://i.ibb.co/V9nZn8R/Screenshot-2.jpg" alt="Screenshot-2" border="0"></a>
<a href="https://imgbb.com/"><img src="https://i.ibb.co/pwRjCMz/Screenshot-1.jpg" alt="Screenshot-1" border="0"></a>



## GUI
<details>
<summary><b>Cambios en GUI</b></summary>
  
### Cambio 3.0
 * Los datos se almacenan en la base de datos
 * Se obtiene el titúlo del grupo y lo almacena en una variable llamada $fin para luego almacenarla en la db
 * Los datos se muestran en una tabla

### Cambio 2.0
 * Se creo la base de datos pero aún no se almacenaba información
 * Los datos se guardan en un bloc de notas en txt

### Cambio 1.0
 * Se creo una función nueva llamada telegramMsj(); (para enviar msj por telegram)
 * Ahora los grupos encontrados los envia al bot que hallas configurado en telegram. (+ info @BotFather)
</details>

## CLI
<details>
<summary><b>Cambios en CLI</b></summary>
  
 * Al ejecutar el script ```php index-cli.php``` guarda la cuenta de grupos chequeados y los grupos hallados.
 * Manda msj por telegram al hallar un grupo
 * El script queda en bucle hasta que el usuario lo cancele
 * La terminal se limpia luego de chequear un grupo y no deja texto basura en la terminal
 * Código optimizado para una mejor función del script
</details>
