  const inputOptions = new Promise((resolve) => {
               setTimeout(() => {
                          resolve({
                            '#ff0000': 'CNI',
                            '#00ff00': 'Permis',
                            '#0000ff': 'CP'
                          })
                 }, 1000)
        })
   /* save adm with swal*/
      swal.mixin({
        input: 'text',
        confirmButtonText: 'Suivant',
        showCancelButton: true,
        progressSteps: ['1', '2', '3']
      }).queue([
        {
          title: 'pièces adminstratifs',
          //text: 'CIN , permis' //html : radbuttonsCNIPer
           input: 'radio',
            inputOptions: inputOptions,
        },
        'Imprimer BA',
        'Imprimer BS'
      ]).then((result) => {
        if (result.value) {
          swal({
            title: 'All done!',
            html:
              'Your answers: <pre><code>' +
                JSON.stringify(result.value) +
              '</code></pre>',
            confirmButtonText: 'Lovely!'
          })
        }
      })