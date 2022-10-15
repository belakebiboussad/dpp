     /*
        Swal.fire({ 
            title:'êtes-vous sûr ?',
            type:'question',
            icon: 'question',
            input: 'text',
            inputAttributes: {
              placeholder :"Remarque...",
              autocapitalize: 'off'
            },
            html:content ,
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: "Non",
            dangerMode: true,
            showCloseButton: true,
            progressSteps: ['1', '2']
          }).then((result) => {
              if(result.value)
              {
                var formData = { _token: CSRF_TOKEN, "id_RDV": data.id, "demande_id" : data.id_demande };
                var url = "{{--route('admission.store') --}}"; 
                $.ajax({
                    type : 'POST',
                    url :url,
                    data:formData,
                    success:function(data){ 
                      $("#rdv-" + data.id).remove(); 
                      // swal("Poof! Your imaginary file has been deleted!", {
                      //   icon: "success",
                      // });
                    }
                });
              }else
                swal("Your imaginary file is safe!");
          });
      */
      //deb