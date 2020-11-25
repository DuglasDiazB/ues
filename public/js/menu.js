// Accediendo al contenedor activo de la clase contenedor
const contenedor = document.querySelector('#contenedor');
// Accediendo al boton menu y detectar cuando se de un click
document.querySelector('#boton-menu').addEventListener('click', () => {
    contenedor.classList.toggle('active');
});


//para que se esconda el menu cuando va minimizando la pantalla
const comprobarAncho = () => {
	if(window.innerWidth <= 768){
		contenedor.classList.remove('active');
	} else {
		contenedor.classList.add('active');
	}
}

comprobarAncho();

window.addEventListener('resize', () => {
	comprobarAncho();
});

// function abrirNuevoUsu() {
//     document.getElementById('nuevo-usuario').style.display="block";
//     display = document.querySelector("#blur");
//     display.classList.toggle('active');

// }
// function eliminarUsu(){
//     document.getElementById('eliminar-usuario').style.display="block";
//     display = document.querySelector("#blur");
//     display.classList.toggle('active');
// }
function cerrar(){
    if (document.getElementById('eliminar-usuario')) {
        
        document.getElementById('eliminar-usuario').style.display="none";
    }
    else if( document.getElementById('activar-usuario')){

        document.getElementById('activar-usuario').style.display="none";
    }
    $('.container.active').removeClass("active");
    
}