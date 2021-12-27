<?php 
  require_once 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="description" content="Tabla de los grupos de whatsapp. Datos obtenidos desde la base de datos">
    <meta name="keywords" content="whatsapp,groups,jkdevarg">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Whatsapp - Grupos</title>
    <style>
      a{
        text-decoration: none;
        color: red;
      }
      a:hover{
        color: whitesmoke;
      }
    </style>
  </head>
  <body class="bg-dark">    
    <div class="container">
    <div class="alert alert-light text-center">
      <h1 class="text-warning">Grupos Whatsapp</h1>
    </div>
      <table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titulo</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
              $query = $conn->prepare("SELECT * FROM gwhatsapp");
              $query->execute();
              $result = $query;
              foreach ($result as $row) {
                echo "<td>".$row['id']."</td>";
                echo "<td><a href='".$row['enlace']."'>".$row['nombre']."</a></td>";
                echo "<td>".$row['fecha']."</td>";
              }
            ?>   
          </tr>
        </tbody>
      </table>
    </div>
    <footer class="footer">
      Creado por <a href="https://github.com/JkDevArg">JkDevArg</a> 
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
