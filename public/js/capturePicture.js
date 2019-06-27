var video = document.querySelector("#videoElement");

if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(function(stream) {
            video.srcObject = stream;
        })
        .catch(function(err0r) {
            console.log("Something went wrong!");
        });
}

let button = document.getElementById("capturar");
let img = document.getElementById("img-default");
let Inputfoto = document.getElementById("foto");
let canvas = document.getElementById("canvas");
let context = canvas.getContext("2d");

video.addEventListener("play", function() {
    draw(this, context, 650, 550);
}, false);

function draw(video, context, width, height) {
    context.drawImage(video, 0, 0, width, height);
    setTimeout(draw, 10, video, context, width, height);
}

button.addEventListener("click", function() {
    let dataUrl = canvas.toDataURL("image/png");
    img.src = dataUrl;
    let cleanData = dataUrl.replace("data:image/png;base64,", "");
    cleanData = cleanData.replace(" ", "+");
    Inputfoto.value = cleanData;
    // console.log(Inputfoto.value);
});