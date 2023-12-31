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
        var table = $('#demandes_table').DataTable();
        var rows = table.rows().remove().draw();
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
                          return moment(row.imageable.date).format('YYYY-MM-DD');
                        },title:'Date',"orderable": true,
                  },
                  { data: null,
                        render: function ( data, type, row ) {
                          if(row.imageable.medecin.service != null)
                            return row.imageable.medecin.service.nom ; 
                        },title:'Service',"orderable": true,
                  },
                  { data: null,
                          render: function ( data, type, row ) {
                            return row.imageable.medecin.full_name ;
                          },title:'Médecin demandeur',"orderable": false,
                  },
                  { data: null,
                    render: function ( data, type, row ) {
                      var lieu =  (row.imageable_type == 'App\\modeles\\visite') ? 'Hospitalisation':'Consultation';
                      return row.imageable.patient.full_name +' <small class="text-primary">('+ lieu +')</small>';
                    },title:'Patient',"orderable": true,
                  },
                  {
                    data: 'etat', title:'Etat',
                      render: function ( data, type, row ) {
                        classe = (row.etat == 'Validée') ? 'success' : 'primary';
                        return '<span class="badge badge-'+ classe +'">' + row.etat +'</span>';
                      }
                  },
                  { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}
            ],
              "columnDefs": [
                {"targets": 5 , "orderable": false, className: "dt-head-center dt-body-center" },
                {"targets": 6 , "orderable": false, className: "dt-head-center dt-body-center" },
              ] 
          });
      }
    });
  }
</script>