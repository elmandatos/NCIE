/**
 * Crear una instancia de Instacan y desplegar en un div lo que ve la camara
 * content es el contenido que hay en el codigo QR
 * en este caso va a ser el ID del usuario.
 * Si existe el usuario en la BD, entonces nos reedirecionara a su pagina con sus datos
 * si no existe nos enviara un mensaje de error diciendo que no existe
 */

let imagenUser = document.getElementById("id-img");
let idUser = document.getElementById("id_user");
let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
scanner.addListener('scan', function(content) {
    let id = content;
    let url = "/getFotoURL/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: (foto) => {
            imagenUser.src = "https://ncie.test/img/users/" + foto;
            idUser.value = id;
            // alert(idUser.value);
        },
        error: () => {
            alert("No existe usuario con id: " + id);
        }
    });

});

/**
 * Obtiene las camaras que hay en la PC, 0 es para la webcam interna
 * 1 es para la webcam externa
 */
Instascan.Camera.getCameras().then(function(cameras) {
    console.log(cameras);

    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
    }
}).catch(function(e) {
    console.error(e);
});