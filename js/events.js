

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
