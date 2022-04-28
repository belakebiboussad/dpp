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
                             return row.consultation.medecin.service.nom ;
                          else
                            return  row.visite.medecin.service.nom;
                          return data;  
                        },title:'Service',"orderable": true,
            },
            { data: null,
                          render: function ( data, type, row ) {
                            if(data.id_consultation != null)
                               return row.consultation.medecin.full_name ;
                            else
                              return row.visite.medecin.full_name;
                            return data;  
                          },title:'Médecin demandeur',"orderable": false,
            },
            { data: null,
                          render: function ( data, type, row ) {
                              if(data.id_consultation != null)
                                return  row.consultation.patient.full_name +' <small class="text-primary">(Consultation)</small>';
                              else
                                return row.visite.hospitalisation.patient.full_name +' <small class="text-warning">(Hospitalisation)</small>';
                              return data;  
                          },title:'Patient',"orderable": true,
            },
            { data: 'etat', title:'Etat',
                  render: function ( data, type, row ) {
                    return '<span class="badge badge-info">' + row.etat +'</span>';
                  }
              },
              { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}
          ],
          "columnDefs": [
            {"targets": 5 , "orderable": false, className: "dt-head-center dt-body-center" },
            {"targets": 6 , "orderable": false, className: "dt-head-center dt-body-center" },
          ] 
        });// datatable
      }
    });
  }
</script>