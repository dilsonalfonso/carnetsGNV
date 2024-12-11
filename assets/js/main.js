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