/**
 * Modal para agregar un nuevo empleado
 */
async function modalRegistrarEmpleado() {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("agregarEmpleadoModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    const response = await fetch("modales/modalAdd.php");

    if (!response.ok) {
      throw new Error("Error al cargar la modal");
    }

    const data = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = data;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#agregarEmpleadoModal")
    );
    myModal.show();
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para enviar el formulario al backend
 */
async function registrarEmpleado(event) {
  try {
    event.preventDefault(); // Evitar que la página se recargue al enviar el formulario

    const formulario = document.querySelector("#formularioEmpleado");
    // Crear un objeto FormData para enviar los datos del formulario
    const formData = new FormData(formulario);

    // Mostrar una notificación mientras se procesa el registro
    toastr.options = window.toastrOptions;
    toastr.info("Registrando el nuevo empleado...");

    // Enviar los datos del formulario al backend usando Axios
    const response = await axios.post("acciones/acciones.php", formData);

    // Verificar la respuesta del backend
    if (response.status === 200) {
      console.log("Empleado registrado correctamente");

      // Llamar a la función para actualizar la tabla de empleados (si existe)
      if (typeof window.insertEmpleadoTable === "function") {
        window.insertEmpleadoTable();
      }

      setTimeout(() => {
        // Cerrar la modal
        $("#agregarEmpleadoModal").modal("hide");

        // Llamar a la función para mostrar un mensaje de éxito
        toastr.success("¡El empleado se registró correctamente!");
      }, 600);
    } else {
      console.error("Error al registrar el empleado");
      toastr.error("Hubo un problema al registrar el empleado.");
    }
  } catch (error) {
    console.error("Error al enviar el formulario", error);
    toastr.error("Hubo un problema al enviar los datos.");
  }
  setTimeout(() => {
    location.reload();
  }, 1750); // Recarga después de 1.7 segundos
}
