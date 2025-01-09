<?php 
    $verticalPosition = 111;
    $horizontalPosition = -84;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="assets/js/main.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .user-photo {
            margin-top: <?php echo $verticalPosition;?>px;
            margin-left: <?php echo $horizontalPosition;?>px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Canvas Carnetización</h1>
    </header><?php
    $archivo="Relación-Fotos-2024-2025.csv";
    $arreglo=file($archivo);
    $curso_Estudiante_Aux=" ";
    for($i=1; $i<count($arreglo); $i++){
        $estudiante=explode(";",$arreglo[$i]);
        $curso_Estudiante=str_replace(" ", "_", $estudiante[0]);
        if ($curso_Estudiante!=$curso_Estudiante_Aux) {?>
            <a class="boton" href="index.php?curso=<?php echo $curso_Estudiante;?>"><?php echo $curso_Estudiante?></a><?php
            $curso_Estudiante_Aux=$curso_Estudiante; }
     } ?>
    <main>
        <a class="boton" onclick="GuardarTodos()" href="#">Guardar Todos</a><br><?php
        $archivo="Relación-Fotos-2024-2025.csv";
        $arreglo=file($archivo);
        for( $i=1; $i<count($arreglo); $i++){
            $estudiante=explode(";",$arreglo[$i]);
            $curso_Estudiante=str_replace(" ", "_", $estudiante[0]);
            $nombre_Estudiante=$estudiante[1];
            $cod_Foto=$estudiante[2];
            if($cod_Foto!='' && $curso_Estudiante==$_GET['curso']){
                $cod_Foto=explode("-",$estudiante[2]);
                $cod_Foto_Estudiante=$cod_Foto[1];
                if ($cod_Foto_Estudiante!='') {
                    $nombreAux=explode(", ", $nombre_Estudiante);
                    $nombreMostrar=explode(" ", $nombreAux[1]);
                    $apellidoMostrar=explode(" ", $nombreAux[0]);
            ?>
        <div class="carnet-group">
            <div class="carnet" id="carnet-<?php echo $cod_Foto_Estudiante;?>" onclick="Guardar(<?php echo $cod_Foto_Estudiante;?>)">
                <div class="foto" style="background-color:cornflowerblue; margin:5px;">
                    <img class="user-photo" id="user-photo-<?php echo $cod_Foto_Estudiante;?>" src="Fotos/JPEG/IMG_<?php echo $cod_Foto_Estudiante;?>.JPG" width="650">
                </div>
                <h3 class="nombre uppercase"><?php echo utf8_encode($nombreMostrar[0]." ".$apellidoMostrar[0]);?></h3>
                <h3 class="nombre grado"><?php echo $estudiante[4];?></h3>
                <div style="text-align:center">
                    <img data-value="<?php echo $estudiante[3]?>" data-text="<?php echo $estudiante[3]?>" class="codigo">
                </div>
                <script>JsBarcode(".codigo").init();</script>
                <input style="display:none;" id="nombre-<?php echo $cod_Foto_Estudiante;?>" value="<?php echo utf8_encode($nombre_Estudiante);?>" />
            </div>
            <div class="control">
                <h3>Controles</h3>
                <div class="horizontal-control flex-control">
                    <label for="horizontal-control">Alineación Horizontal</label>
                    <input class="input-control" type="number" name="horizontal-control" id="horizontal-control-<?php echo $cod_Foto_Estudiante;?>" value="<?php echo $horizontalPosition; ?>" onChange="changeHorizontal('<?php echo $cod_Foto_Estudiante;?>')">
                </div>
                <div class="vertical-control flex-control">
                    <label for="vertical-control">Alineación Vertical</label>
                    <input class="input-control" type="number" name="vertical-control" id="vertical-control-<?php echo $cod_Foto_Estudiante;?>" value="<?php echo $verticalPosition; ?>" onChange="changeVertical('<?php echo $cod_Foto_Estudiante;?>')">
                </div>
                <div class="zoom-control flex-control">
                    <label for="zoom-control">Zoom</label>
                    <input class="input-control" type="number" name="zoom-control" id="zoom-control-<?php echo $cod_Foto_Estudiante;?>" value="1" step="0.01" onChange="changeZoom('<?php echo $cod_Foto_Estudiante;?>')">
                </div>
                <div class="saturation-control flex-control">
                    <label for="saturation-control">Saturación</label>
                    <input class="input-control" type="number" name="saturation-control" id="saturation-control-<?php echo $cod_Foto_Estudiante;?>" value="1" step="0.05" onChange="changeSaturation('<?php echo $cod_Foto_Estudiante;?>')">
                </div>
            </div>
        </div>
        <br>
        <?php } } }?>
    </main>
</body>
</html>