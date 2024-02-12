document.getElementById('btn_export_pdf').addEventListener('click', () => {

  const elementToConvert = document.getElementById('pdf');

  const options = {
    filename: 'documento.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 1 },
    jsPDF: { unit: 'in', format: 'legal', orientation: 'portrait' }
  };

  // Convertir el elemento HTML a PDF
  html2pdf().from(elementToConvert).set(options).save();
});

function showHide(_display = 'none') {
  document.querySelector(".header").style.display = _display;
  document.querySelector(".span-line").style.display = _display;
  document.querySelector(".span-line").style.display = _display;
  document.querySelector('.actions-buttons-container').style.display = _display;

}


document.getElementById('btn_print_pdf').addEventListener('click', () => {

  const elementToConvert = document.getElementById('pdf');

  const options = {
    filename: 'documento.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 1 },
    jsPDF: { unit: 'in', format: 'legal', orientation: 'portrait' }
  };
  showHide();
  window.print();
  showHide('block');
});

