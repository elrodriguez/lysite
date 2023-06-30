let globalComments;
function setGlobolComments(data) {
    globalComments = data;
}

function buscarYCambiar() {

    var elements = document.getElementsByClassName("ly-suggestion-marker-deletion");

    for (let index = 0; index < elements.length; index++) {
        for (let x = 0; x < globalComments.length; x++) {
            //console.log(elements[index].children[0]);
            
            if(elements[index].children[0].includes("fsdf sdfsdfsd fsdf sdf sdf sdfd por la ptm")){
                elements[index].id = globalComments[x].selecction_id;
                console.log(elements[index].id);
            }
            //if (elements[index].children[0] == "<p>" + globalComments[x].selecction_text + "</p>") { //fsdf sdfsdfsd fsdf sdf sdf sdfd por la ptm       
        }
    }
}

// Ejecutamos la función cada 5 segundos
setInterval(buscarYCambiar, 2000);

/*
var str = "Este es un ejemplo de texto";
    var searchStr = "ejemplo";

    // Buscamos la posición de la primera ocurrencia de la cadena buscada
    var position = str.indexOf(searchStr);

    if (position !== -1) {
        // Si la cadena buscada se encuentra en la cadena, hacemos algo
        console.log("La cadena buscada se encuentra en la posición " + position);
    } else {
        // Si la cadena buscada no se encuentra en la cadena, hacemos algo diferente
        console.log("La cadena buscada no se encuentra en la cadena");
    }
    */