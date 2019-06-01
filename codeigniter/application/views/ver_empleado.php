<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Ver Empleado </title>
</head>
<body>

<h1> Hola </h1>

<pre>
    <?php print_r($usuario) ?>
</pre>

<?php
    $nombre = $usuario[0]->Nombre;
    $apellido = $usuario[0]->Apellido;
    $id = $usuario[0]->id;
?>

<h1> <?php echo $nombre ?> </h1>
<h1> <?php echo $apellido ?> </h1>
<h1> <?php echo $id ?> </h1>
</body>
</html>