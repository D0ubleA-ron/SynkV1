const loadFile = function (event) {
    const image = document.getElementById("createimage")
    image.src = URL.createObjectURL(event.target.files[0])
}
