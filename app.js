var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');
var funcion = document.getElementById('funcion');
var alCuadrado = document.getElementById('alcuadrado');
var alCubo = document.getElementById('alcubo');
var alaN = document.getElementById('alan');

alCuadrado.addEventListener('click',function(){
    console.log("diste clic en x2");
    document.getElementById('valor').value += '^2';
    document.getElementById('valor').focus();
});
alCubo.addEventListener('click',function(){
    console.log("diste clic en x2");
    document.getElementById('valor').value += '^3';
    document.getElementById('valor').focus();
})
alaN.addEventListener('click',function(){
    let potencia = prompt('Ingrese la potencia  la que desea elevar:');
    document.getElementById('valor').value += '^'+potencia;
    document.getElementById('valor').focus();
})
/**formulario.addEventListener('submit',function(e){
    e.preventDefault();
    console.log('me diste click');

    var datos = new FormData(formulario);
    console.log(datos);
    console.log(datos.get('funcion'));

    fetch('api.php',{
        method : 'POST',
        body : datos
    })
    .then(res => res.json())
    .then(data =>{
        console.log(data);
        if(data === "error"){
            respuesta.innerHTML = `
            <div class="alert alert-danger" role="alert">
                No se recibio ningun dato
            </div>
            `
        }else{
            respuesta.innerHTML = `
            <div class="alert alert-primary" role="alert">
                ${data}
            </div>
            `;
        }
    })

});**/
