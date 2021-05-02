//function createexbioF(imge,nomp,prenomp,age,ipp, nomEmploye,prenomEmploye){ 
  function createexbioF(patient,employe,etablissement,image){  
    html2canvas($("#dos"), {
        onrendered: function(canvas) {
          moment.locale('fr');//var IPP = ipp.toString();
          var formattedDate = moment(new Date()).format("l");         
          var imgData = canvas.toDataURL('image/png');              
          var doc = new jsPDF('p', 'mm');
          //doc.text(105,9, 'DIRECTION GENERAL DE LA SURETE NATIONALE', null, null, 'center');
          doc.text(105,9, '{{ $etablissement->tutelle }}', null, null, 'center');
          doc.setFontSize(13);
          // doc.text(105,16, 'HOPITAL CENTRAL DE LA SURETE NATIONALE "LES GLYCINES"', null, null, 'center');
          doc.text(105,16, '{{ $etablissement->nom }}', null, null, 'center');
          doc.setFontSize(12);
          doc.text(105,21, '12, Chemin des Glycines - ALGER', null, null, 'center');
          doc.text(105,26, 'Tél : 023-93-34 - 23-93-58', null, null, 'center');
          doc.addImage(image, 'JPEG', 95, 27, 17, 17);
          doc.setFontSize(14);
          doc.addImage(imgData, 'JPEG', 10, 10);
          // JsBarcode("#itf", ipp.toString(), {
          //   lineColor: "#000",
          //   width:4,
          //   height:40,
          //   displayValue: true,
          //   fontSize : 28,
          //   textAlign: "left"
          // });

          JsBarcode("#itf", '{{ $employe->IPP}}', {
              lineColor: "#000",
              width:4,
              height:40,
              displayValue: true,
              fontSize : 28,
              textAlign: "left"
          });
          doc.text(200,60, 'Alger :' +formattedDate , null, null, 'right'); 
          //doc.text(20,63, 'Nom : '+nomp, null, null);
          
          doc.text(20,63, 'Nom : '+'{{ $patient->Nom }}', null, null);

          //doc.text(20,68, 'Prénom : '+prenomp, null, null);
          doc.text(20,68, 'Prénom : ' + '{{ $patient->Prenom }}', null, null);

          //doc.text(20,73, 'Age : '+ age+' ans', null, null); 
          doc.text(20,73, 'Age : '+ '{{ $patient->getAge() }}' +' ans', null, null); 
          
          const img = document.querySelector('img#itf');
          doc.addImage(img.src, 'JPEG', 20, 75, 50, 15);
          doc.text(20,110, 'Prière de faire', null, null);
          doc.setFontSize(16);
          doc.text(50,125,'Analyses Demandées :',null,null) 
          var i =0;
          $('input.ace:checkbox:checked').each(function(index, value) {
            doc.text(20,135+i, ++index + ' : '+this.nextElementSibling.innerHTML+" . ");
            i=i+10;
          });
          doc.setFontSize(12);
          //doc.text(100,270, 'Docteur : ' +nomEmploye+ ' '+ prenomEmploye, null, null); 
          doc.text(100,270, 'Docteur : ' +'{{ $employe->nom }}'+ ' '+ '{{ $employe->nom }}', null, null); 
          
          //doc.save('ExamBiolo-'+nomp+'-'+prenomp+'.pdf');
          doc.save('ExamBiolo-' + '{{ $patient->Nom }}' + '-'+ '{{ $patient->Prenom }}' +'.pdf');
          }
        });    
      }