<?php
require_once "../public/serv-admin/operaciones_admin.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      background-color: gray !important;
    }
  </style>
</head>

<body class="login_page">
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0"> -->

    <script>
  // Si la navegación fue "back/forward", forzamos recarga
  window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
      window.location.reload();
    }
  });
</script>
  </head>
  <script>
  </script>

  <body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <div class="card-body">
          <h1 class="card-title text-center mb-4">Iniciar sesión</h1>

          <form action="login.php" method="post" id="form">
            <input type="text" name="fakeusernameremembered" style="display:none" autocomplete="off">
            <input type="password" name="fakepasswordremembered" style="display:none" autocomplete="off">

            <div class="mb-3">
              <label for="usua" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="usua" oninput="eliminarError()" placeholder="Usuario" required autocomplete="off">
              <span class="text-danger st-text">
                <?php if (isset($falso)) {
                  echo "$falso";
                  unset($falso);
                } ?>
              </span>
            </div>

            <div class="mb-3">
              <label for="pass" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="pass" placeholder="Contraseña" oninput="eliminarError()" required autocomplete="new-password">
              <span class="text-danger st-text">
                <?php if (isset($error)) {
                  echo "$error";
                  unset($error);
                } ?>
              </span>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="iniciar">Iniciar</button>

          </form>
        </div>
      </div>
    </div>
    <!-- completamos los names-values dinamicamente para evitar que el navegador recuerde al dar back -->
    <script>
  window.onload = function() {
    // Encuentra el formulario por ID o clase
    const form = document.querySelector("#form");
    if (form) {
      // Limpia todos los campos del formulario
      form.reset(); // Borra datos visibles
    document.getElementById('usua').value = "";
    document.getElementById('pass').value = "";

    // Asignar los name dinámicamente
    document.getElementById('usua').name = 'usua';
    document.getElementById('pass').name = 'pass';

    }
  };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function eliminarError() {

        document.querySelectorAll(".st-text").forEach((span) => {
          span.innerHTML = "";
        });
      }
    </script>
  </body>

  </html>

</html>