

<?php
    $servidor = 'localhost:33065';
    $cuenta = 'root';
    $password = '';
    $bd = 'bdprueba1';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    if($conexion -> connect_errno){
        die('Error de la conexion');
    }
    else{
        if(isset($_POST['submit'])){
            $eliminar = $_POST['eliminar'];
            $sql = "DELETE FROM usuarios WHERE id='$eliminar'";
            $conexion->query($sql);
            if($conexion -> affected_rows >= 1){
                echo '<br> registro borrado <br>';
            }
        }
        $sql = 'select * from usuarios';
        $resultado = $conexion -> query($sql);
        if($resultado -> num_rows){
            ?>
            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <legend>Eliminar Cuentas</legend>
                    <br>
                    <select name="eliminar" class="browser-default custom-select">
                        <?php
                            while($fila = $resultado -> fetch_assoc()){
                                echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
                            }
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" value="submit" name="submit">Eliminar</button>
                </form>
            </div>
            <?php
            }
            else{
                echo "no hay datos";
            }
            
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
     
    <style>
    div{
   
   width:20%;
 }
 body{
     margin:50px;
 }
    </style>
</head>
<body>
</body>
</html>