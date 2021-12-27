# 402
Genera una cadena alfanumerica para chequear si existen grupos de whatsapp con esa cadena generada.

Cambio 0.05
 * Los datos se almacenan en la base de datos
 * Se obtiene el titúlo del grupo y lo almacena en una variable llamada $fin para luego almacenarla en la db
 * Los datos se muestran en una tabla

Cambio 0.04
 * Se creo la base de datos pero aún no se almacenaba información

Cambio 0.03
 * Se creo una función nueva llamada telegramMsj(); (para enviar msj por telegram)
 * Ahora los grupos encontrados los envia al bot que hallas configurado en telegram. (+ info @BotFather)


### Nueva Versión

- [x] Automatizado
- [x] Se actualiza 2 segs al no hallar un grupo
- [x] Se actualiza 3 segs al hallar un grupo
- [x] Guarda los grupos encontrados en un bloc de notas "grupos.txt"
- [x] Contador de cadenas generadas "contador.txt"
- [x] Mediante un IF verifica si existe el grupo mediante un style="background-image: url
- [x] Muestra Notificación en el escritorio si encuentra un grupo
- [x] Envia enlace del grupo por telegram
- [x] Guarda los datos en Base de Datos (MySQL[PDO])
- [x] Obtiene el titúlo del grupo y lo guarda en la Base de Datos
- [ ] Envia un correo con el grupo hallado (En proceso)
- [x] Mostrar los grupos en una tabla
- [ ] Envia el enlace del grupo por whatsapp (Anulado)
- [ ] Prepara un café, te corrige el examen, te pasea el perro y te estaciona el auto.


Requerimientos PC con conexión a la NASA:
* lib Curl
* Php
* Café
* MySQL
* 10 minutos de tu vida que no lo podras recuperar


## Capturas
![Captura 0001](https://github.com/JkDevArg/402/blob/main/Screenshot_1.jpg?raw=true)
![Captura 0002](https://github.com/JkDevArg/402/blob/main/Screenshot_2.jpg?raw=true)



Script de prueba.
