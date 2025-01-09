function Guardar(id) {
    var node = document.getElementById('carnet-'+id);
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
function GuardarTodos(){
    const carnets=document.getElementsByClassName('carnet');
    console.log(carnets.length);
    for (var i=0; i<carnets.length; i++) {
        carnets[i].click();
    }
}
function changeHorizontal(id){
    const positionHorizontal=document.getElementById('horizontal-control-'+id).value;
    const userPhoto=document.getElementById('user-photo-'+id);
    console.log('Position: '+positionHorizontal+'; photo: '+id);
    userPhoto.style.marginLeft=positionHorizontal+'px';
}
function changeVertical(id){
    const positionVertical=document.getElementById('vertical-control-'+id).value;
    const userPhoto=document.getElementById('user-photo-'+id);
    console.log('Position: '+positionVertical+'; photo: '+id);
    userPhoto.style.marginTop=positionVertical+'px';
}
function changeZoom(id) {
    const zoomValue = document.getElementById('zoom-control-' + id).value; // Obtén el valor del control de zoom
    const userPhoto = document.getElementById('user-photo-' + id); // Obtén la imagen
    console.log('Zoom: ' + zoomValue + '; photo: ' + id);

    // Asegúrate de que el valor sea un número válido y dentro de un rango aceptable
    const zoomLevel = parseFloat(zoomValue);
    if (isNaN(zoomLevel) || zoomLevel <= 0) {
        console.error('Valor de zoom inválido');
        return;
    }

    // Cambiar el tamaño de la imagen usando transform: scale()
    userPhoto.style.transform = 'scale(' + zoomLevel + ')';
}
function changeSaturation(id) {
    const saturationValue = document.getElementById('saturation-control-' + id).value; // Obtén el valor del control de saturación
    const userPhoto = document.getElementById('user-photo-' + id); // Obtén la imagen
    console.log('Saturation: ' + saturationValue + '; photo: ' + id);

    // Asegúrate de que el valor sea un número válido
    const saturationLevel = parseFloat(saturationValue);
    if (isNaN(saturationLevel) || saturationLevel < 0) {
        console.error('Valor de saturación inválido');
        return;
    }

    // Cambiar la saturación de la imagen usando filter: saturate()
    userPhoto.style.filter = 'saturate(' + saturationLevel + ')';
}