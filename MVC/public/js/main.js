//Array de todos los elementos que tienen la clase eliminar
const botones = document.querySelectorAll(".bEliminar");

botones.forEach(boton => {
    boton.addEventListener("click", function() {
        //console.log("presionaste boton eliminar");
        //Obtener la matricula por medio del data atributte
        const matricula = this.dataset.matricula;
        //console.log(matricula);

        //Mostrar el pop up para confirmar si se quiere eliminar el alumno
        const confirm = window.confirm(`¿Deseas eliminar el alumno ${matricula}?`);

        //validar respuesta del confirm
        if (confirm) {
            //Solicitud AJAX
            httpRequest(`http://localhost/CursoPHP/MVC/consulta/eliminarAlumno/${matricula}`, function() {
                console.log(this.responseText); //this.responseText: Retorna el contenido de la solicitud http

                //Mostrar el mensaje de que se elimino el alumno
                document.querySelector("#respuesta").innerHTML = this.responseText;

                const tbody = document.querySelector("#tbody-alumnos");
                const fila = document.querySelector(`#fila-${matricula}`);
                //console.log(fila);

                //Eliminar el alumno
                tbody.removeChild(fila);
            });
        } else {

        }

        //ejecutar la solicitud Http 
        function httpRequest(url, callback) {
            const http = new XMLHttpRequest();
            http.open("GET", url);
            http.send();

            //mapear cuando la solicitud cambie de estado
            http.onreadystatechange = function() {
                //ReadyState = 4 significa que se mando la solicitud , Status = 200 que la solicitud ha sido exitosa
                if (this.readyState == 4 && this.status == 200) {
                    callback.apply(http);
                }
            }
        }
    });
});