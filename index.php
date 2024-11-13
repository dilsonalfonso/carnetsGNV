<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js"></script>
    <script>
        function Guardar(id) {
            
            //import * as htmlToImage from 'html-to-image';

            var node = document.getElementById('carnet-'+id);
            alert('carnet-'+id);
            htmlToImage.toPng(node)
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download =document.getElementById('nombre-'+id).value+'.png';
                link.href = dataUrl;
                link.click();
            })
            .catch(function (error) {
                console.error('Oops, something went wrong!', error);
            });
        }
    </script>
    <style>
        .carnet {
            width: 690px;
            height: 1014px;
            background-image: url("images/plantilla.png");
        }
        .foto {
            position: relative;
            z-index: -1;
        }
        .boton { 
            background-color: whitesmoke;
            border-style: solid;
            border-color: green;
            border-radius: 20px;
            padding: 0px 5px;
            margin: 15px;
        }
        a {
            color: black;
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
    <main><?php
        $archivo="Relación-Fotos-2024-2025.csv";
        $arreglo=file($archivo);
        for( $i=1; $i<count($arreglo); $i++){
            $estudiante=explode(";",$arreglo[$i]);
            $curso_Estudiante=str_replace(" ", "_", $estudiante[0]);
            $nombre_Estudiante=$estudiante[1];
            $cod_Foto=$estudiante[2];
            if($cod_Foto!='' && $curso_Estudiante==$_GET['curso']){
                $cod_Foto=explode("-",$estudiante[2]);
                $cod_Foto_Estudiante=$cod_Foto[1]*1;
            ?>
        <div class="carnet" id="carnet-<?php echo $cod_Foto_Estudiante;?>" onclick="Guardar(<?php echo $cod_Foto_Estudiante;?>)">
            <div class="foto" style="background-color:cornflowerblue; margin:5px;">
                <img src="Fotos/IMG_<?php echo $cod_Foto_Estudiante;?>.JPG" width="1500" height="" style="clip-path: rect(25px 1097px 794px 421px); margin-top: -16px; margin-left: -424px;">
            </div>
            <input style="display:none;" id="nombre-<?php echo $cod_Foto_Estudiante;?>" value="<?php echo $nombre_Estudiante;?>" />
        </div>
        <?php } }?>
    </main>
</body>
</html>