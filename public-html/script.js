function guardarTareas() {
    let tareas = [];

    document.querySelectorAll("#listaTareas li").forEach(li => {
        tareas.push(li.firstChild.textContent.trim());
    });

    localStorage.setItem("tareas", JSON.stringify(tareas));
}

function agregarTarea() {

    // Obtener el texto de la tarea
    let nuevaTareaTexto = document.getElementById("nuevaTarea").value.trim();

    // Validar que no esté vacío
    if (nuevaTareaTexto === "") {
        alert("Por favor, ingresa una tarea.");
        return;
    }

    // Crear elemento de la lista
    let nuevaTarea = document.createElement("li");
    nuevaTarea.textContent = nuevaTareaTexto + " ";

    // Crear botón eliminar
    let botonEliminar = document.createElement("button");
    botonEliminar.textContent = "Eliminar";

    botonEliminar.onclick = function () {
        nuevaTarea.remove();
        guardarTareas();
    };

    // Agregar botón a la tarea
    nuevaTarea.appendChild(botonEliminar);

    // Agregar tarea a la lista
    document.getElementById("listaTareas").appendChild(nuevaTarea);

    // Guardar tareas
    guardarTareas();

    // Limpiar cuadro de texto
    document.getElementById("nuevaTarea").value = "";
}

function cargarTareas() {

    // Obtener tareas del localStorage
    let tareas = JSON.parse(localStorage.getItem("tareas")) || [];

    // Recorrer cada tarea almacenada
    tareas.forEach(texto => {

        let nuevaTarea = document.createElement("li");
        nuevaTarea.textContent = texto + " ";

        let botonEliminar = document.createElement("button");
        botonEliminar.textContent = "Eliminar";

        botonEliminar.onclick = function () {
            nuevaTarea.remove();
            guardarTareas();
        };

        nuevaTarea.appendChild(botonEliminar);

        document.getElementById("listaTareas").appendChild(nuevaTarea);
    });
}

// Cargar tareas al abrir la página
document.addEventListener("DOMContentLoaded", cargarTareas);

// Registrar Service Worker para la PWA
if ("serviceWorker" in navigator) {
    window.addEventListener("load", () => {
        navigator.serviceWorker.register("./service-worker.js")
            .then(registro => {
                console.log("Service Worker registrado:", registro);
            })
            .catch(error => {
                console.log("Error al registrar Service Worker:", error);
            });
    });
}