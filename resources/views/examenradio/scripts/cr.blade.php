<script  type="text/javascript" charset="utf-8" async defer>
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
                              return  row.consultation.date;
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
                          },title:'Médecin traitant',"orderable": false,
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