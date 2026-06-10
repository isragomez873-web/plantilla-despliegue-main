async function agregarTarea() {

    let descripcion = document.getElementById("nuevaTarea").value.trim();

    if (descripcion === "") {
        alert("Por favor, ingresa una tarea");
        return;
    }

    let datos = new FormData();
    datos.append("descripcion", descripcion);

    await fetch("guardar_tarea.php", {
        method: "POST",
        body: datos
    });

    document.getElementById("nuevaTarea").value = "";

    cargarTareas();
}

async function cargarTareas() {

    let respuesta = await fetch("obtener_tareas.php");

    let tareas = await respuesta.json();

    let lista = document.getElementById("listaTareas");

    lista.innerHTML = "";

    tareas.forEach(tarea => {

        let li = document.createElement("li");

        li.textContent = tarea.descripcion + " ";

        let botonEliminar = document.createElement("button");

        botonEliminar.textContent = "Eliminar";

        botonEliminar.onclick = () => eliminarTarea(tarea.id);

        li.appendChild(botonEliminar);

        lista.appendChild(li);
    });
}

async function eliminarTarea(id) {

    let datos = new FormData();

    datos.append("id", id);

    await fetch("eliminar_tarea.php", {
        method: "POST",
        body: datos
    });

    cargarTareas();
}

document.addEventListener("DOMContentLoaded", cargarTareas);

if ("serviceWorker" in navigator) {
    window.addEventListener("load", () => {
        navigator.serviceWorker.register("../service-worker.js")
            .then(registro => {
                console.log("Service Worker registrado:", registro);
            })
            .catch(error => {
                console.log("Error al registrar Service Worker:", error);
            });
    });
}