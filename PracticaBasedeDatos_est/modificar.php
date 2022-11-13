<?php
   session_start();
     
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='bdprueba1';
     
    $_SESSION['id'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['cue'] = '';
    $_SESSION['con'] = '';
   
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
    }

    if(isset($_POST['submit'])){
        $modificar = $_POST['modificar'];
        $_SESSION["modificar2"] = $modificar;
        $sql2 = "SELECT * 
                 FROM usuarios 
                 WHERE id='$modificar'";
        $resultado = $conexion -> query($sql2);
        while ($fila = $resultado -> fetch_assoc()){
            $_SESSION["id"] = $fila["id"];
            $_SESSION["nom"] = $fila["nombre"];
            $_SESSION["cue"] = $fila["cuenta"];
            $_SESSION["con"] = $fila["contrasena"];
            
        }
    }
    if(isset($_POST['mod'])){
        $uno = $_POST["id2"];
        $dos = $_POST["nombre2"];
        $tres = $_POST["cuenta2"];
        $cuatro = $_POST["contra2"];
        $modificarl = $_SESSION["modificar2"];
        $ne = "UPDATE usuarios 
               SET id='$uno', nombre='$dos', cuenta='$tres', contrasena='$cuatro' 
               WHERE id='$modificarl'";
        $fin = $conexion -> query($ne);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    
   
</head>
<body>
    
    <div class="contenedor1">
        <div class="contenedor2">
            <div class="izquierdaAlta">

            <?php        
         //continuamos con la consulta de datos a la tabla usuarios
         //vemos datos en un tabla de html
         $sql = 'select * from usuarios';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
         $resultado = $conexion -> query($sql); //aplicamos sentencia
         
         if ($resultado -> num_rows){ //si la consulta genera registros
         ?>
 
                
        <div class="izqAlta">   
            <div class="izqAlta2">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>  
            
                    <legend>Modificar Cuentas</legend>
                    <br>
                    <select   class="custom-select" name='modificar' >
                    
                    <?php
                    $salida='<table>';
                    while( $fila = $resultado -> fetch_assoc() ){ //recorremos los registros obtenidos de la tabla
                        echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
                        //proceso de concatenacion de datos
                        $salida.= '<tr>';
                        $salida.= '<td>'. $fila['id'] . '</td>';
                        $salida.= '<td>'. $fila['nombre'] . '</td>';
                        $salida.= '<td>'. $fila['cuenta'] . '</td>';
                        $salida.= '<td>'. $fila['contrasena'] . '</td>';
                        $salida.= '</tr>';
                        }//fin while   
                        $salida.= '</table>';
                    ?>
                    </select>
                    <br><br>
                    <button type="submit" value="submit" name="submit">Modificar</button>               
                </form>
            </div>   
           
        </div> 
         <?php
        
         }
         else{
             echo "no hay datos";
         }
        
?>
        </div>
            <div class="izquierdaBaja">
                 <?php echo $salida ?>
            </div>
        </div>
        <div class="derecha">
        
            <form class="estiloformulario form-custom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>
            <ul class="wrapper">
                <li class="form-row">
                <label for="id">ID</label>
                <input type="number" name="id2" id="id" value="<?php echo $_SESSION["id"]; ?>" >
                </li>
                <li class="form-row">
                <label for="nombre">NOMBRE</label>
                <input type="text" id="nombre" name="nombre2" value="<?php echo $_SESSION["nom"]; ?>">
                </li>
                <li class="form-row">
                <label for="cuenta">CUENTA</label>
                <input type="text" id="cuenta" name="cuenta2" value="<?php echo $_SESSION["cue"]; ?>">
                </li>
                <li class="form-row">
                <label for="contra">CONTRASENA</label>
                <input type="text" id="contra" name="contra2" value="<?php echo $_SESSION['con']; ?>">
                </li>
                <li class="form-row">
                <button type="submit" name="mod">Modificar</button>
                </li>
            </ul>
            </form>       
        </div>
    </div>
</body>
</html>