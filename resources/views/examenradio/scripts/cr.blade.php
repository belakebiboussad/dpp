<script  type="text/javascript" charset="utf-8" async defer>
      function imgToBase64(url, callback, imgVariable) {
            if (!window.FileReader) {
                  callback(null);
                  return;
            }
            var xhr = new XMLHttpRequest();
            xhr.responseType = 'blob';
            xhr.onload = function() {
                   var reader = new FileReader();
                    reader.onloadend = function() {
                          imgVariable = reader.result.replace('text/xml', 'image/jpeg');
                          callback(imgVariable);
                    };
                    reader.readAsDataURL(xhr.response);
            };
            xhr.open('GET', url);
            xhr.send();
      }
       function header(doc)
      {      
             doc.setFontSize(40);
              doc.setTextColor(40);
            doc.setFontStyle('normal');
              if (base64Img) {
                doc.addImage(base64Img, 'JPEG', margins.left, 10, 540,80);       
         }
        doc.line(3, 92, margins.width + 43,92); // horizontal line
      }
       function headerFooterFormatting(doc, totalPages)
      {
        for(var i = totalPages; i >= 1; i--)
        {    
          doc.setPage(i);                            
          header(doc);
          footer(doc, i, totalPages);
          doc.page++; 
        }
      }
      function footer(doc, pageNumber, totalPages){
            doc.setFontSize(40);
            doc.setTextColor(40);
            doc.setFontStyle('normal');
            if (footer64Img) {
                    doc.addImage(footer64Img, 'JPEG', margins.left, doc.internal.pageSize.height - 30, 540,30);       
             } 
      }
      function generate()
      {
             var pdf = new jsPDF('p', 'pt', 'a4');
             pdf.setFontSize(18);
             pdf.fromHTML(document.getElementById('pdfContent'), 
            margins.left, // x coord
            margins.top,
            {
                    width: margins.width// max width of content on PDF
            },function(dispose) {
                    headerFooterFormatting(pdf, pdf.internal.getNumberOfPages());
            }, 
           margins);
           iframe =document.getElementById('ipdf');
            iframe.src = pdf.output('datauristring'); 
            $("#crrModal").modal(); 
      } 
</script>