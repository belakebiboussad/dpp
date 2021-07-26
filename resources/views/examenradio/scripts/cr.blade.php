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
        doc.line(10, 95, margins.width + 33,95); // horizontal line
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
                    doc.addImage(footer64Img, 'JPEG', margins.left, doc.internal.pageSize.height - 50, 540,50);       
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
        function getRequests(url,field,value)
      {
            $.ajax({
              url :url,
              data: {    
                      "field":field,
                      "value":value,
              },
       dataType: "json",
       success: function(data) {
              $(".numberResult").html(data.length);
              $("#demandes_table").DataTable ({ 
                    "processing": true,
                        "paging":   true,
                        "destroy": true,
                        "ordering": true,
                        "searching":false,
                        "info" : false,
                        "responsive": true,
                        "language":{"url": '/localisation/fr_FR.json'},
                        "data" : data,
                        "columns": [
                          { data:null,title:'#', searchable: false,
                        render: function ( data, type, row ) {
                                  if ( type === 'display' ) {
                                      return '<input type="checkbox" class="editor-active check" name="" value="'+data.id+'" /><span class="lbl"></span>';
                                  }
                                  return data;
                            }, className: "dt-body-center","orderable":false, 
                    },
                    { data: null,
                                render: function ( data, type, row ) {
                                    if(data.id_consultation != null)
                                      return  row.consultation.Date_Consultation;
                                    else
                                      return row.visite.date;
                                    return data;  
                                },title:'Date',"orderable": true,
                    },
                    { data: null,
                                render: function ( data, type, row ) {
                                  if(data.id_consultation != null)
                                     return row.consultation.docteur.service.nom ;
                                  else
                                    return  row.visite.hospitalisation.medecin.service.nom;
                                  return data;  
                                },title:'Service',"orderable": true,
                    },
                    { data: null,
                                  render: function ( data, type, row ) {
                                    if(data.id_consultation != null)
                                       return row.consultation.docteur.nom + ' ' + row.consultation.docteur.prenom ;
                                    else
                                      return row.visite.hospitalisation.medecin.nom + ' ' + row.visite.hospitalisation.medecin.prenom;
                                    return data;  
                                  },title:'Médecin demandeur',"orderable": false,
                    },
                    { data: null,
                                  render: function ( data, type, row ) {
                                      if(data.id_consultation != null)
                                        return  row.consultation.patient.Nom + ' ' + row.consultation.patient.Prenom+' <small class="text-primary">(Consultation)</small>';
                                      else
                                        return row.visite.hospitalisation.patient.Nom + ' ' + row.visite.hospitalisation.patient.Prenom+' <small class="text-warning">(Hospitalisation)</small>';
                                      return data;  
                                  },title:'Patient',"orderable": true,
                    },
                    { data: 'etat', title:'Etat',"orderable":true,
                          render: function ( data, type, row ) {
                                  switch(row.etat)
                          {
                            case null:
                              return '<span class="badge badge-success">En Cours</span>';
                              break;
                            case "1":
                              return '<span class="badge badge-info">Validée</span>';
                              break;
                            case "0":
                              return '<span class="badge badge-warning">Rejetée</span>';
                              break;
                            default:
                              return "UNKNOWN";
                              break;      
                          }        
                            }
                      },
                      { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}
                ] 
              });// datatable
      }
    });
  }
</script>