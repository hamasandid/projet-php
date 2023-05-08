function exportPDF() {
    // Make an AJAX request to the PHP script that generates the PDF
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'pdf.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.responseType = 'blob'; // Set the response type to blob
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Create a URL for the PDF blob
        var url = URL.createObjectURL(this.response);
        // Create a link and click it to download the PDF
        var link = document.createElement('a');
        link.href = url;
        link.download = 'blog.pdf';
        link.click();
        // Display a success message
        alert('PDF exported successfully');
      }
    };
    xhr.send('export=1');
  }