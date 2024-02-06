document.getElementById('btn_export').addEventListener('click', () => {

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

