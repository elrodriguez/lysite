let autors;
let title;
let grade;
let editorial;
let volumen;
let university;
let pais;
let institucion;
let issn;
let isbn;
let enlace;
let date;
let date_consulta;
let namepage;
let normativa;
let edicion;
let doi;
let repositorio;
let selectedRadioButton; 
let numero;
let paginas;

function refresh_values(){
normativa   = document.getElementById('select-normativa')   .value;
editor      = document.getElementById("input-editor")       .value;
autors      = document.getElementById("input-autor")        .value;
title       = document.getElementById("input-titulo")       .value;
grade       = document.getElementById("input-grado")        .value;
editorial   = document.getElementById("input-editorial")    .value;
edicion     = document.getElementById("input-edicion")      .value;
volumen     = document.getElementById("input-volumen")      .value;
university  = document.getElementById("input-universidad")  .value;
pais        = document.getElementById("input-pais")         .value;
institucion = document.getElementById("input-institucion")  .value;
issn        = document.getElementById("input-issn")         .value;
isbn        = document.getElementById("input-isbn")         .value;
enlace         = document.getElementById("input-enlace")       .value;
namepage    = document.getElementById("input-namepage")     .value;
date        = document.getElementById("input-date")         .value;
doi         = document.getElementById("input-doi-a")        .value;
repositorio = document.getElementById("input-repositorio")  .value;
numero      = document.getElementById("input-numero")       .value;
paginas     = document.getElementById("input-paginas")      .value;
date_consulta= document.getElementById("input-date-consulta").value;
date = new Date(date + 'T00:00:00');
date.setMinutes(date.getTimezoneOffset());
date_consulta = new Date(date_consulta + 'T00:00:00');
date_consulta.setMinutes(date_consulta.getTimezoneOffset());
if(!doi.startsWith("http://dx.doi.org/")){
    doi = "http://dx.doi.org/" + doi;
    }
}

function manual_citation(event){ 
    entidad_autor_swap(event);            
    let cita_autores="";
    refresh_values();            
    // obtiene el elemento HTML del botón de opción seleccionado
    //let selectedRadioButton = document.querySelector('input[name="input-type"]:checked').value;
    let concatenado;

    // verificar si la cadena termina con ";"
    if (autors.endsWith(";") || autors.endsWith(".") || autors.endsWith(",")) {
    // si termina con ";", eliminar el último carácter
    autors = autors.slice(0, -1);
    }
    // separar el string en cada persona usando ";"
    let personas = autors.split(";");

    // matriz para almacenar los nombres y apellidos separados
    let nombresApellidos = [];

    // para cada persona, separar el nombre y los apellidos usando ","
    try {
        personas.forEach(persona => {
            let nombreApellido = persona.trim().split(",");
            let nombres = nombreApellido[0].trim().split(" ");
            let apellidos = nombreApellido[1].trim().split(" ");
        
            let primerNombre = nombres[0] ? nombres[0] : "";
            let segundoNombre = nombres[1] ? nombres.slice(1).join(" ") : "";
            let primerApellido = apellidos[0] ? apellidos[0] : "";
            let segundoApellido = apellidos[1] ? apellidos.slice(1).join(" ") : "";
        
        nombresApellidos.push({ primerNombre, segundoNombre, primerApellido, segundoApellido });
        });   
    } catch (error) {
    }
    autors = nombresApellidos;
    let fecha = new Date(date);
    let fecha_consulta = new Date(date_consulta);
        // Obtener el día y el mes de la fecha, y utilizarlos para crear la nueva cadena
        let dia = fecha.getDate();
        let mes = fecha.toLocaleString('default', { month: 'long' });
        let anio = fecha.getFullYear();
        let dia_consulta = fecha_consulta.getDate();
        let mes_consulta = fecha_consulta.toLocaleString('default', { month: 'long' });
        let anio_consulta = fecha_consulta.getFullYear();


    
                if(selectedRadioButton=="article"){
                            if(normativa=="apa"){
                                        
                                        autors.forEach((autor, index) => {
                                        var espacio = " ";
                                        if (!autor.segundoApellido)espacio = "";
                                        
                                        cita_autores += autor.primerApellido+espacio+autor.segundoApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                        if (index === autors.length - 1){
                                            cita_autores += " ";
                                        } else {
                                            cita_autores += ", ";
                                        }
                                        }); 
                                        let volnum;
                                        if(volumen.length<1 && numero.length<1){
                                            volnum="";
                                        }else{
                                            volnum = volumen.trim() + "(" + numero.trim()+ "), ";
                                        } 
                                        concatenado = cita_autores + "(" +anio+ "). <em>"+ title.trim() + ",</em> - " + institucion.trim() + ", " + volnum + paginas + ". " + doi;            
                                            
                            }  

                            if(normativa=="iso690"){
                                        autors.forEach((autor, index) => {
                                            autor.primerApellido = autor.primerApellido.toUpperCase();
                                            cita_autores += autor.primerApellido+", "+autor.primerNombre;
                                            if (index === autors.length - 1){
                                                cita_autores += " ";
                                            } else {
                                                cita_autores += ", ";
                                            }
                                        }); 
                                        
                                        if(issn.length<1){
                                            issn = " ";
                                        }else{
                                            issn = "ISSN: "+issn;
                                        }
                                        let volnum;
                                        if(volumen.length<1 && numero.length<1){
                                            volnum="";
                                        }else{
                                            volnum = volumen.trim() + "(" + numero.trim()+ "): ";
                                        } 
                                        concatenado = cita_autores + ". <em>"+ title.trim() + "</em> - " + institucion.trim() + "-[en línea] "+ mes + " " + anio + ", " + volnum + paginas.trim() + " [Fecha de consulta:" + dia_consulta + " de " + mes_consulta + " de " + anio_consulta + "]. Disponible en: " + doi + " " + issn;        

                            }  


                            if(normativa=="vancouver"){
                                        autors.forEach((autor, index) => {
                                        autor.primerApellido = autor.primerApellido;
                                        cita_autores += autor.primerApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                        if (index === autors.length - 1){
                                            cita_autores += " ";
                                        } else {
                                            cita_autores += ", ";
                                        }
                                    }); 
                                    let volnum;
                                    if(volumen.length<1 && numero.length<1){
                                        volnum="";
                                    }else{
                                        volnum = volumen.trim() + "(" + numero.trim()+ "): ";
                                    }  
                                    concatenado = cita_autores +  title.trim() + ", " + institucion + ", "+ anio + "; " + volnum + paginas.trim() + ". " + doi;
                            }

    }
    if(selectedRadioButton=="book"){ //LIBROS VIRTUALES

                            if(normativa=="apa"){
                                                    
                                        autors.forEach((autor, index) => {
                                        var espacio = " ";
                                        if (!autor.segundoApellido)espacio = "";
                                        
                                        cita_autores += autor.primerApellido+espacio+autor.segundoApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                        if (index === autors.length - 1){
                                            cita_autores += " ";
                                        } else {
                                            cita_autores += ", ";
                                        }
                                    }); 
                                    if(edicion<2){
                                        edicion = "";
                                    }else{
                                        edicion = "("+edicion+"° edición).";
                                    }
                                    concatenado = cita_autores + "(" +anio+ "). <em>"+ title.trim() + ".</em> " + editorial.trim()+ "." + enlace;                
                        
                            }  

                            if(normativa=="iso690"){
                                autors.forEach((autor, index) => {
                                    autor.primerApellido = autor.primerApellido.toUpperCase();
                                    cita_autores += autor.primerApellido+", "+autor.primerNombre;
                                    if (index === autors.length - 1){
                                        cita_autores += " ";
                                    } else {
                                        cita_autores += ", ";
                                    }
                                }); 
                                if(edicion<2){
                                    edicion = " ";
                                    }else{
                                        edicion = edicion+"° edición. ";
                                    }
                                if(isbn.length<1){
                                        isbn = " ";
                                    }else{
                                        isbn = "ISBN: "+isbn;
                                    }
                                concatenado = cita_autores + ". <em>"+ title.trim() + "</em> [en línea]. " + edicion.trim() + pais.trim() + ": " + editorial.trim()+ ", " + anio +" [Fecha de consulta: " + dia_consulta + " de " + mes_consulta + " de " + anio_consulta + "]. Disponible en: " +  enlace + isbn;        

                            }   
                            
                            if(normativa=="vancouver"){
                                    autors.forEach((autor, index) => {
                                    autor.primerApellido = autor.primerApellido;
                                    cita_autores += autor.primerApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                    if (index === autors.length - 1){
                                        cita_autores += " ";
                                    } else {
                                        cita_autores += ", ";
                                    }
                                    }); 
                                    if(edicion<2){
                                        edicion = "";
                                        }else{
                                            edicion = edicion+"° ed. ";
                                        }

                                    concatenado = cita_autores +  title.trim() + "[Internet]. "+ pais + ": "+ editorial + "; " + anio + ". Disponible en: " + enlace;
                        
                            }   

    }
    if(selectedRadioButton=="book-fisico"){
                            if(normativa=="apa"){
                            
                                    autors.forEach((autor, index) => {
                                    var espacio = " ";
                                    if (!autor.segundoApellido)espacio = "";
                                    
                                    cita_autores += autor.primerApellido+espacio+autor.segundoApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                    if (index === autors.length - 1){
                                        cita_autores += " ";
                                    } else {
                                        cita_autores += ", ";
                                    }
                                }); 
                                if(edicion<2){
                                    edicion = "";
                                }else{
                                    edicion = "("+edicion+"° edición).";
                                }
                                concatenado = cita_autores + "(" +anio+ "). <em>"+ title.trim() + ".</em> " + edicion.trim() + " " + pais.trim() + ": " + editorial.trim()+ ".";                
                            
                            }  

                            if(normativa=="iso690"){
                                    autors.forEach((autor, index) => {
                                        autor.primerApellido = autor.primerApellido.toUpperCase();
                                        cita_autores += autor.primerApellido+", "+autor.primerNombre;
                                        if (index === autors.length - 1){
                                            cita_autores += " ";
                                        } else {
                                            cita_autores += ", ";
                                        }
                                    }); 
                                    if(edicion<2){
                                        edicion = " ";
                                        }else{
                                            edicion = edicion+"° edición. ";
                                        }
                                    if(isbn.length<1){
                                            isbn = " ";
                                        }else{
                                            isbn = "ISBN: "+isbn;
                                        }
                                    concatenado = cita_autores + ". <em>"+ title.trim() + ".</em> " + edicion.trim() + pais.trim() + ": " + editorial.trim()+ ", " + anio +". " + isbn;        

                            }         


                        if(normativa=="vancouver"){
                                    autors.forEach((autor, index) => {
                                    autor.primerApellido = autor.primerApellido;
                                    cita_autores += autor.primerApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                    if (index === autors.length - 1){
                                        cita_autores += " ";
                                    } else {
                                        cita_autores += ", ";
                                    }
                                    }); 
                                    if(edicion<2){
                                        edicion = "";
                                        }else{
                                            edicion = edicion+"° ed. ";
                                        }

                                    concatenado = cita_autores +  title.trim() + ". "+ edicion + pais + ": "+ editorial + "; " + anio + ".";
                        
                            }       
    }
    if(selectedRadioButton=="thesis"){

                            if(normativa=="apa"){
                                                        
                                        autors.forEach((autor, index) => {
                                        var espacio = " ";
                                        if (!autor.segundoApellido)espacio = "";
                                        
                                        cita_autores += autor.primerApellido+espacio+autor.segundoApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                        if (index === autors.length - 1){
                                            cita_autores += " ";
                                        } else {
                                            cita_autores += ", ";
                                        }
                                    });                                 
                                    
                                    concatenado = cita_autores + "(" +anio+ "). <em>"+ title.trim() + ".</em> " + "[" + grade + ", " + institucion + "]. " + enlace;                
                                
                            }  

                            if(normativa=="iso690"){
                                    autors.forEach((autor, index) => {
                                        autor.primerApellido = autor.primerApellido.toUpperCase();
                                        cita_autores += autor.primerApellido+", "+autor.primerNombre;
                                        if (index === autors.length - 1){
                                            cita_autores += " ";
                                        } else {
                                            cita_autores += ", ";
                                        }
                                    }); 

                                    concatenado = cita_autores + ". <em>"+ title.trim() + ".</em> Tesis [" + grade + "] " + pais.trim() + ": " + institucion.trim()+ ", " + anio +". Disponible en: " + enlace;        

                            }  


                            if(normativa=="vancouver"){
                                    autors.forEach((autor, index) => {
                                    autor.primerApellido = autor.primerApellido;
                                    cita_autores += autor.primerApellido+", "+autor.primerNombre[0].toUpperCase()+".";
                                    if (index === autors.length - 1){
                                        cita_autores += " ";
                                    } else {
                                        cita_autores += ", ";
                                    }
                                    }); 

                                    concatenado = cita_autores +  title.trim() + " [" + grade + "]. Sede: " + pais + ": "+ repositorio + "; " + anio + ". "+ enlace;
                        
                            }   
        
    }
    if(selectedRadioButton=="document-gubernamental"){
        
    }
    if(selectedRadioButton=="page"){                
        /*
        Apellido mayúscula, Nombre minúscula. Título de la página web, año. Disponible en: link de la pagina
        */
        if(normativa=="apa"){
        date = `${dia} de ${mes} de ${anio}`;

        autors.forEach((autor, index) => {
            var espacio = " ";
            if (!autor.segundoApellido)espacio = "";
            
            cita_autores += autor.primerApellido+espacio+autor.segundoApellido+", "+autor.primerNombre[0].toUpperCase()+".";
            if (index === autors.length - 1){
                cita_autores += " ";
            } else {
                cita_autores += ", ";
            }
        });      
        concatenado = cita_autores + "(" +date+ "). <em>"+ title.trim() + ".</em> " + namepage.trim() + ". " + enlace.trim();       
        }




        if(normativa=="iso690"){
            autors.forEach((autor, index) => {
            autor.primerApellido = autor.primerApellido.toUpperCase();
            cita_autores += autor.primerApellido+", "+autor.primerNombre;
            if (index === autors.length - 1){
                cita_autores += " ";
            } else {
                cita_autores += ", ";
            }
        });  
        concatenado = cita_autores + "<em>"+ title.trim() + ",</em> " + anio + ". Disponible en: " + enlace.trim();
        } 



        if(normativa=="vancouver"){
            autors.forEach((autor, index) => {
            autor.primerApellido = autor.primerApellido;
            cita_autores += autor.primerApellido+", "+autor.primerNombre[0].toUpperCase()+".";
            if (index === autors.length - 1){
                cita_autores += " ";
            } else {
                cita_autores += ", ";
            }
        });  
        concatenado = cita_autores +  title.trim() + " [Internet]. " + pais + ": "+ editor + "; " + anio + ". Disponible en: " + enlace.trim();
        }

    }

//concatenado = editor + ";" + cita_autores + ";" + title + ";" + grade + ";" + editorial + ";" + volumen + ";" + university + ";" + pais + ";" + institucion + ";" + issn + ";" + isbn + ";" + enlace;

document.getElementById("ly-ck-dialog-references-result").innerHTML = '<div class="alert alert-primary" role="alert">'+concatenado+'</div>';        
}

function select_citation(tipoInput){  
    if(tipoInput!="changenormative"){
        selectedRadioButton = tipoInput;
    }
    
    switch (selectedRadioButton) {
            case "article":
                document.getElementById('tipo-referencia').innerHTML="Artículo";                        
                break;
            case "page":
                document.getElementById('tipo-referencia').innerHTML="Página Web";                       
            break;
            case "book":
                document.getElementById('tipo-referencia').innerHTML="Libro Virtual";                       
            break;
            case "book-fisico":
                document.getElementById('tipo-referencia').innerHTML="Libro en Físico";                       
            break;
            case "document-gubernamental":
                document.getElementById('tipo-referencia').innerHTML="Documento Gubernamental";                       
            break;
            case "document-legal":
                document.getElementById('tipo-referencia').innerHTML="Documento Legal";                       
            break;
            case "thesis":
                document.getElementById('tipo-referencia').innerHTML="Tésis";                       
            break;
    
        default:
            break;
    }
    refresh_values();                      
    try {
        manual_citation();
    } catch (error) {
        console.log("Falta llenar formulario");
    }
    hide_all_inputs();
    show_selected_inputs();
}


function hide_all_inputs(){
    function hide_input(id){
        let input = document.getElementById(id);// Obtener los inputs por su id
        
        let div = input.parentElement;// Obtener el div que contiene cada input
        
        div.style.display = 'none';// Ocultar el div utilizando la propiedad display
    }                    
            hide_input('input-autor');
            hide_input('input-doi-a');
            hide_input('input-titulo');
            hide_input('input-namepage');
            hide_input('input-date');               //fecha de publicacion
            hide_input('input-date-consulta');      //fecha de consulta
            hide_input('input-grado');
            hide_input('input-universidad');
            hide_input('input-pais');
            hide_input('input-institucion');
            hide_input('input-issn');
            hide_input('input-isbn');
            hide_input('input-volumen');
            hide_input('input-paginas');
            hide_input('input-editor');
            hide_input('input-editorial');
            hide_input('input-enlace');
            hide_input('input-numero');
            hide_input('input-edicion');
            hide_input('input-siglas');
            hide_input('input-repositorio'); //
            let label = document.querySelector("label[for='input-autor']");
            label.textContent = "Autor/es:";
            label = document.getElementById("input-autor");
            label.placeholder = "John Miguel, Gutierrez Sosa; Carmen María, Mendoza Villa";
            label = document.querySelector("label[for='input-pais']");
            label.textContent = "Pais o Ciudad:";
            label = document.querySelector("label[for='input-institucion']");
            label.textContent = "Institución, Entidad o Revista:";
            label = document.getElementById("input-institucion");
            label.placeholder = "Escriba aquí...";
            let input = document.getElementById("input-grado");
            input.placeholder = "Bachiller, Maestría, Doctorado";
}


function show_selected_inputs(){

            //NORMATIVA APA

    if(normativa=="apa"){
        //page
        if(selectedRadioButton=="page"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-namepage');
            show_input('input-date');                    
            show_input('input-enlace');
        }
        //article
        if(selectedRadioButton=="article"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-institucion'); //institucion, entidad o revista
            show_input('input-volumen');
            show_input('input-numero');
            show_input('input-paginas');
            show_input('input-date');           //fecha publicacion         
            show_input('input-doi-a');
        }
        //libro virtual
        if(selectedRadioButton=="book"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-date');           //fecha publicacion    
            show_input('input-date-consulta');     
            show_input('input-editorial');
            show_input('input-enlace');             
        }
        //libro físico
        if(selectedRadioButton=="book-fisico"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-date');           //fecha publicacion         
            show_input('input-editorial');
            show_input('input-edicion');
            show_input('input-pais');
        }
        //documento gubernamental
        if(selectedRadioButton=="document-gubernamental"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-pais');
            show_input('input-institucion');
            let label = document.querySelector("label[for='input-institucion']");
            label.textContent = "ó Autor Entidad:";
            label = document.querySelector("label[for='input-autor']");
            label.innerHTML ="Autor Persona:";
            label = document.querySelector("label[for='input-pais']");
            label.textContent = "Ciudad:";
            show_input('input-siglas');         //Siglas de entidad
            show_input('input-date');           //fecha publicacion 
            show_input('input-enlace');   
        }
         //TESIS
        if(selectedRadioButton=="thesis"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-date');           //fecha publicacion         
            show_input('input-grado');
            show_input('input-institucion');
            let label = document.querySelector("label[for='input-grado']");
            label.textContent = "Titulación en que especialidad o carrera:";
            let input = document.getElementById("input-grado");
            input.placeholder = "titulación en Ingeniería Industrial, Titulación en Maestría o Doctorado";
            label = document.querySelector("label[for='input-institucion']");
            label.textContent = "Universidad:";
            show_input('input-enlace');

        }
        
    }






            //NORMATIVA ISO690

    if(normativa=="iso690"){
        //page
        if(selectedRadioButton=="page"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-namepage');
            show_input('input-date');                    
            show_input('input-enlace');
        }
          //article
        if(selectedRadioButton=="article"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-institucion'); //institucion, entidad o revista
            show_input('input-volumen');
            show_input('input-numero');
            show_input('input-paginas');
            show_input('input-date');                    //fecha publicacion                 
            show_input('input-date-consulta');          //fecha consulta      
            show_input('input-doi-a');
            show_input('input-issn');
        }
        //libro
        if(selectedRadioButton=="book"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-date');           //fecha publicacion       
            show_input('input-date-consulta');      //fecha consulta            
            show_input('input-edicion');
            show_input('input-editorial');
            show_input('input-pais');
            show_input('input-isbn');
            show_input('input-enlace');
        }
        //libro físico
        if(selectedRadioButton=="book-fisico"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-edicion');
            show_input('input-pais');
            show_input('input-editorial');
            show_input('input-date');           //fecha publicacion                                
            show_input('input-isbn');
        }
        //documento gubernamental
        if(selectedRadioButton=="document-gubernamental"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-pais');
            let label = document.querySelector("label[for='input-autor']");
            label.textContent = "Autor o Entidad:";
            label = document.querySelector("label[for='input-pais']");
            label.textContent = "Ciudad:";
            show_input('input-siglas');         //Siglas de entidad
            show_input('input-date');           //fecha publicacion 
            show_input('input-enlace');   
        }
        //TESIS
        if(selectedRadioButton=="thesis"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-institucion');
            show_input('input-grado');
            let label = document.querySelector("label[for='input-grado']");
            label.textContent = "Titulación en que especialidad o carrera:";
            let input = document.getElementById("input-grado");
            input.placeholder = "titulación en Ingeniería Industrial, Titulación en Maestría o Doctorado";
            label = document.querySelector("label[for='input-institucion']");
            label.textContent = "Universidad:";
            show_input('input-pais');
            label = document.querySelector("label[for='input-pais']");
            label.textContent = "País:";
            show_input('input-date');           //fecha publicacion                                
            show_input('input-enlace');
        }
    }






            //NORMATIVA VANCOUVER

    if(normativa=="vancouver"){
        //page
        if(selectedRadioButton=="page"){
            show_input('input-autor');
            show_input('input-pais');
            show_input('input-titulo');
            show_input('input-editor');
            show_input('input-date');                    
            show_input('input-enlace');
        }
        //article
        if(selectedRadioButton=="article"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-institucion'); //institucion, entidad o revista
            show_input('input-volumen');
            show_input('input-numero');
            show_input('input-paginas');
            show_input('input-date');                    //fecha publicacion     
            show_input('input-doi-a');
        }
        //libro virtual
        if(selectedRadioButton=="book"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-date');           //fecha publicacion   
            show_input('input-editorial');
            show_input('input-pais');
            show_input('input-enlace');
        }
         //libro físico
        if(selectedRadioButton=="book-fisico"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-pais');
            show_input('input-edicion');
            show_input('input-editorial');
            show_input('input-date');           //fecha publicacion  
        }
        //documento gubernamental
        if(selectedRadioButton=="document-gubernamental"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-pais');
            let label = document.querySelector("label[for='input-autor']");
            label.textContent = "Autor o Entidad:";
            label = document.querySelector("label[for='input-pais']");
            label.textContent = "Ciudad:";
            show_input('input-siglas');         //Siglas de entidad
            show_input('input-date');           //fecha publicacion 
            show_input('input-enlace');   
        }
        //Tesis
        if(selectedRadioButton=="thesis"){
            show_input('input-autor');
            show_input('input-titulo');
            show_input('input-date');           //fecha publicacion   
            show_input('input-grado');
            let label = document.querySelector("input[id='input-grado']");
            label.placeholder = "Tesis de pregrado ó Tesis de posgrado:";
            show_input('input-pais');
            label = document.querySelector("label[for='input-pais']");
            label.textContent = "Sede:";
            show_input('input-repositorio');
            show_input('input-enlace');
        }
    }

}


function show_input(id){
    const input = document.getElementById(id);
    const div = input.parentElement;
    div.style.display = 'block';
}

function entidad_autor_swap(event){
    
    if(selectedRadioButton=="document-gubernamental"){
        let id = event.target.id; 
        if(id == "input-autor"){
                document.querySelector('input#input-institucion').value="";
                document.querySelector('input#input-institucion').placeholder="Solo llene o Autor o Entidad";
        }
        if(id == "input-institucion"){
                document.querySelector('textarea#input-autor').value="";
                document.querySelector('textarea#input-autor').placeholder="Solo llene o Autor o Entidad";
        }
    }

}