<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='Hospital';
     
    $_SESSION['id'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['cue'] = '';
    $_SESSION['con'] = '';
   
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
    }

    $sql = 'SELECT * FROM pacientes';
    $resultado = $conexion -> query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<title>Mostrar Registros</title>
</head>
<body>
    <div class="container">
        <h4>Francisco de Jesús Méndez Lara</h4>
        <h2>Pacientes:</h2>
    <table class="table table-striped">
    <thead>
        <tr class="table-dark">
        <th scope="col">Numero de habitacion</th>
        <th scope="col">Nombre</th>
        <th scope="col">Diagnostico</th>
        <th scope="col">Medico que atiende</th>
        </tr>
    </thead>
    <tbody>
    <?php
        while ($fila = $resultado -> fetch_assoc()){
        ?>
            <tr class="table-secondary">
                <th scope="row"><?php echo $fila["Numero_Habitacion"]?></th>
                <td><?php echo $fila["Nombre_Paciente"]?></td>
                <td><?php echo $fila["Diagnostico"]?></td>
                <td><?php echo $fila["Metodo_Atiende"]?></td>
            </tr>
        <?php 
        }
        ?>
    </tbody>
    </table>
    </div>
    
</body>
</html>