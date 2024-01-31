document.querySelector(".btn-login").addEventListener('click', login)








function login() {
  var mydata = {
    username: $('#username').val(),
    password: $('#password').val()
  };
  request('POST', './php/login/login_controller.php', mydata)
    .then(function(response) {
      loginController(response.response);
    })
    .catch(function(error) {
      console.error('Error en la solicitud:', error);
    });
}




function request(method, url, params) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: url,
      method: method,
      data: params,
      success: function(response) {
        resolve(response);
      },
      error: function(xhr, status, error) {
        reject(error);
      }
    });
  });
}



function loginController(interruptResponse) {
  if (interruptResponse == 1) {
    Swal.fire({
      title: "Bienvenido",
      text: "Bienvenido al sistema",
      icon: "success",
      showCloseButton: false
    });
    setTimeout(() => {
      window.location.href = "./inicio.php"
    }, 1000);
    // window.location.href = "./inicio.html"
  }
  if (interruptResponse == 2) {
    Swal.fire({
      title: "Error",
      text: "Contraseña o Usuario incorrectos",
      icon: "error"
    });
    $('#username').val('');
    $('#password').val('');
  }
  if (interruptResponse == 3) {
    Swal.fire({
      title: "Error",
      text: "Debe llenar todos los campos del formulario",
      icon: "error"
    });
  }
}
