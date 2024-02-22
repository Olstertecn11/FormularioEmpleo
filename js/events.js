



function logout() {
  save('Saliendo de la aplicacion', 'Logout');
  window.location.href = 'signup.php';
}

window.onload = () => {
  loadHeader();
}




function loadHeader() {
  fetch('./navbar.html')
    .then(res => res.text())
    .then(content => {
      if (content != '') {
        $('header').html(content);
      }
    });
}
