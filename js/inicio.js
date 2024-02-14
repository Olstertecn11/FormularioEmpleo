
let txt_filter = document.getElementById('txt_filter');
let btn_filter = document.getElementById('btn_filter');
let cmb_dates = ['date1', 'date2'];
let _option = document.getElementById('_option');

document.addEventListener('DOMContentLoaded', _config_filters, false);


function _config_filters() {
  document.getElementById("txt_filter").style.display = "none";
}



function filterChange(e) {
  const op = e.target.value;
  switch (op) {
    case "0":
      searchByDate();
      _option.value = '0';
      break;
    case "1":
      searchByName();
      _option.value = '1';
      break;
    case "2":
      searchByPosition();
      _option.value = '2';
      break;
    default:
      showAll();
      _option.value = '3';
  }
}

function showAll() {
  btn_filter.innerText = 'Ver Todo';
  changeDateCmbStatate();
}

function searchByPosition() {
  btn_filter.innerText = 'Filtrar';
  txt_filter.style.display = "block";
  txt_filter.placeholder = "Ingrese el puesto";
  changeDateCmbStatate();
  txt_filter.name = "puesto";
}

function searchByDate() {
  txt_filter.style.display = 'none';
  changeDateCmbStatate('block');
}


function changeDateCmbStatate(new_state = 'none') {
  cmb_dates.forEach((item) => document.getElementById(item).style.display = new_state);
}


function searchByName() {
  btn_filter.innerText = 'Filtrar';
  txt_filter.style.display = "block";
  txt_filter.placeholder = "Ingrese el nombre";
  txt_filter.name = "nombre";
  changeDateCmbStatate();
}







