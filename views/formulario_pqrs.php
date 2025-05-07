<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Radicación de PQRS - Colegio Laura Vicuña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="main.css" />
  <style>
    .container-fluid {
      max-width: 100%;
      padding-left: 0;
      padding-right: 0;
    }
    .form-control {
      width: 100%;
    }
    .text-end {
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 text-end mb-3">
        <a href="consultar_estado_pqrs.php" class="btn btn-info">Consultar estado de PQRS</a>
      </div>
      <div class="col-md-12 px-4">
        <h5 class="mb-3 text-primary">Datos del solicitante</h5>

        <!-- FORMULARIO -->
        <form id="formPqrs" action="../controllers/PQRSController.php" method="POST" enctype="multipart/form-data" novalidate>
          <!-- Tipo de persona -->
          <div class="mb-3">
            <label class="form-label">Tipo de persona</label><br />
            <div class="btn-group" role="group" aria-label="Tipo de persona">
              <input type="radio" class="btn-check" name="tipoPersona" id="natural" value="natural" checked />
              <label class="btn btn-outline-primary" for="natural">Natural</label>

              <input type="radio" class="btn-check" name="tipoPersona" id="juridica" value="juridica" />
              <label class="btn btn-outline-primary" for="juridica">Jurídica</label>
            </div>
          </div>

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o razón social</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required />
            <div class="invalid-feedback">Este campo es obligatorio.</div>
          </div>

          <!-- Tipo documento -->
          <div class="mb-3">
            <label for="tipoDocumento" class="form-label">Tipo de documento</label>
            <select class="form-select" id="tipoDocumento" name="tipoDocumento" required>
              <option value="">Seleccione una opción</option>
              <option value="cc">Cédula de ciudadanía</option>
              <option value="ce">Cédula de extranjería</option>
              <option value="pasaporte">Pasaporte</option>
            </select>
            <div class="invalid-feedback">Debe seleccionar un tipo de documento.</div>
          </div>

          <!-- Número documento -->
          <div class="mb-3">
            <label for="numeroDocumento" class="form-label">Número de documento</label>
            <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" required />
            <div class="invalid-feedback">Este campo es obligatorio.</div>
          </div>

          <!-- Lugar expedición -->
          <div class="mb-3">
            <label for="lugarExpedicion" class="form-label">Lugar de expedición</label>
            <input type="text" class="form-control" id="lugarExpedicion" name="lugarExpedicion" required />
            <div class="invalid-feedback">Este campo es obligatorio.</div>
          </div>

          <!-- Dirección -->
          <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required />
            <div class="invalid-feedback">Este campo es obligatorio.</div>
          </div>

          <!-- Ciudad -->
          <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" required />
            <div class="invalid-feedback">Este campo es obligatorio.</div>
          </div>

          <!-- Teléfono -->
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required pattern="\d{10}" />
            <div class="invalid-feedback">Ingrese un número de celular válido de 10 dígitos.</div>
          </div>

          <!-- Correo -->
          <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required />
            <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
          </div>

          <!-- Archivos -->
          <div class="mb-3">
            <label for="anexos" class="form-label">Anexar documentos (PDF, JPG, PNG, DOCX, XLSX)</label>
            <input type="file" class="form-control" id="anexos" name="anexos[]" multiple accept=".pdf,.jpg,.jpeg,.png,.docx,.xlsx" />
            <div class="invalid-feedback" id="fileFeedback"></div>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcionPqrs" class="form-label">Describa su PQRS</label>
            <textarea class="form-control" id="descripcionPqrs" name="descripcionPqrs" rows="5" required></textarea>
            <div class="invalid-feedback">Por favor describa su solicitud.</div>
          </div>

          <!-- Botón enviar -->
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Radicar PQRS</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Script de validación Bootstrap + archivo -->
  <script>
    (function () {
      'use strict';
      const form = document.getElementById('formPqrs');
      const archivoInput = document.getElementById('anexos');
      const fileFeedback = document.getElementById('fileFeedback');

      form.addEventListener('submit', function (event) {
        // Limpia mensajes de archivo
        archivoInput.classList.remove("is-invalid");
        fileFeedback.textContent = "";

        // Validación Bootstrap
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        // Validar archivos
        const archivos = archivoInput.files;
        const extensionesPermitidas = ['pdf', 'jpg', 'jpeg', 'png', 'docx', 'xlsx'];
        let archivosValidos = true;

        if (archivos.length > 10) {
          archivoInput.classList.add("is-invalid");
          fileFeedback.textContent = "Solo se permiten máximo 10 archivos.";
          archivosValidos = false;
        }

        for (const archivo of archivos) {
          const ext = archivo.name.split('.').pop().toLowerCase();
          if (!extensionesPermitidas.includes(ext)) {
            archivoInput.classList.add("is-invalid");
            fileFeedback.textContent = `El archivo "${archivo.name}" tiene una extensión no permitida.`;
            archivosValidos = false;
            break;
          }

          if (archivo.size > 30 * 1024 * 1024) {
            archivoInput.classList.add("is-invalid");
            fileFeedback.textContent = `El archivo "${archivo.name}" supera el límite de 30 MB.`;
            archivosValidos = false;
            break;
          }
        }

        if (!archivosValidos) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);
    })();
  </script>
</body>
</html>
