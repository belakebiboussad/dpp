   (async function backAndForth() {
        const steps = ['1', '2', '3']
        const swalQueueStep = Swal.mixin({
              confirmButtonText: 'Forward',
              cancelButtonText: 'Back',
              progressSteps: steps,  //input: 'text',
               html:htmlChecBox ,
              inputAttributes: {
                       required: true
              },
              reverseButtons: true,
               validationMessage: 'This field is required'   
        })
        const values = []
        let currentStep
        for (currentStep = 0; currentStep < steps.length;) {
                const result = await swalQueueStep.fire({
                        title: `Question ${steps[currentStep]}`,
                      inputValue: values[currentStep],
                       showCancelButton: currentStep > 0,
                       currentProgressStep: currentStep
                })
              if (result.value) {
                     values[currentStep] = result.value
                      currentStep++
              } else if (result.dismiss === Swal.DismissReason.cancel) {
                       currentStep--
               } else {
                      break
                }
        }
  })();