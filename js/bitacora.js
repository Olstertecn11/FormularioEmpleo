

function save(_action, _module) {

  var _user = localStorage.getItem('user');

  fetch('./php/utils/bitacora_controller.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      username: _user,
      action: _action,
      module: _module
    })
  }).then(function(response) {
    if (response.ok) {
      console.log('Registro de bitácora exitoso');
    } else {
      console.error('Error en la solicitud:', response.statusText);
    }
  }).catch(function(error) {
    console.error('Error en la solicitud:', error);
  });
}
