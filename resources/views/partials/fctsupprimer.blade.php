      function createexbioF(image,nomp,prenomp,age,ipp){ 
        html2canvas($("#dos"), {
          onrendered: function(canvas) {
              moment.locale('fr');//var IPP = ipp.toString();
              var formattedDate = moment(new Date()).format("l");         
              var imgData = canvas.toDataURL('image/png');              
              var doc = new jsPDF('p', 'mm');
              doc.text(105,9,'{{ Session::get('etabTut') }}', null, null, 'center');
              doc.setFontSize(13);
              doc.text(105,16,'{{ Session::get('etabname') }}', null, null, 'center');
              doc.setFontSize(12);
              doc.text(105,21,'{{ Session::get('etabAdr') }}', null, null, 'center');
              doc.text(105,26, 'Tél : {{ Session::get('etabTel') }} - {{ Session::get('etabTel') }}', null, null, 'center');//doc.text(105,26, 'Tél : 023-93-34 - 23-93-58', null, null, 'center');
              doc.addImage(image, 'JPEG', 95, 27, 17, 17);
              doc.setFontSize(14);
              doc.addImage(imgData, 'JPEG', 10, 10);
              JsBarcode("#itf", ipp.toString(), {
                lineColor: "#000",
                width:4,
                height:40,
                displayValue: true,
                fontSize : 28,
                textAlign: "left"
              });
              doc.text(200,60, 'Alger :' +formattedDate , null, null, 'right'); 
              doc.text(20,63, 'Nom : '+nomp, null, null);
              doc.text(20,68, 'Prénom : '+prenomp, null, null);
              doc.text(20,73, 'Age : '+ age+' ans', null, null); 
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
              doc.text(100,270, 'Docteur : {{ Auth::user()->employ->nom}} {{ Auth::user()->employ->prenom}}', null, null); 
              doc.save('ExamBiolo-'+nomp+'-'+prenomp+'.pdf');
          }
        });    
    }  
     


    function createeximgF(image,nomp,prenomp,age,ipp)
    {  
        html2canvas($("#dos"), {
            onrendered: function(canvas) {         
              // moment.locale('fr');//var IPP = ipp.toString();
              // var formattedDate = moment(new Date()).format("l");
              // var imgData = canvas.toDataURL('image/png');              
              // var doc = new jsPDF('p', 'mm');
              // doc.addImage(imgData, 'PNG', 10, 10); //JsBarcode("#itf",IPP); //bonne
              // JsBarcode("#itf", ipp.toString(), {
              //   lineColor: "#000",
              //   width:4,
              //   height:40,
              //   displayValue: true,
              //   fontSize : 28,
              //   textAlign: "left"
              // });
              // const img = document.querySelector('img#itf');
              // doc.text(105, 9,'{{ Session::get('etabTut') }}', null, null, 'center');
              
              // doc.setFontSize(13);
              // doc.text(105,16, '{{ Session::get('etabname') }}', null, null, 'center');
              // doc.setFontSize(12);
              // doc.text(105,21, '{{ Session::get('etabAdr') }}', null, null, 'center');
              // doc.text(105,26, 'Tél : {{ Session::get('etabTel') }} - {{ Session::get('etabTel2') }}', null, null, 'center');
              // doc.addImage(image, 'JPEG', 95, 27, 17, 17);
              // doc.setFontSize(14);
              // doc.text(200,60, 'Alger :' +formattedDate , null, null, 'right'); 
              // doc.text(20,63, 'Nom : '+nomp, null, null);
              // doc.text(20,68, 'Prénom : '+prenomp, null, null);
              // doc.text(20,73, 'Age : '+ age+' ans', null, null);
              // doc.addImage(img.src, 'JPEG', 20, 75, 50, 15);
              // doc.text(20,110, 'Prière de faire', null, null);
              // doc.setFontSize(16);
              // doc.text(50,125,'Examens Demandées :',null,null)
              // var res = doc.autoTableHtmlToJson(document.getElementById('ExamsImgtab'));
              // var height = doc.internal.pageSize.height;
              // doc.autoTable(res.columns, res.data, {
              //   startY: 135,
              // });
              // doc.setFontSize(12);
              // doc.text(100,270, 'Docteur : {{ Auth::user()->employ->nom}} {{ Auth::user()->employ->prenom}}', null, null); 
              // doc.save('ExamRadio-'+nomp+'-'+prenomp+'.pdf');
            }
        });
    }

    function lettreoriet(logo,nompatient,prenompatient,agepatient)
      {
        // var specialite = $( "#specialiteOrient option:selected" ).text().trim();
        // var medecin =  $("#medecinOrient option:selected").text().trim();
        // $('#lettreorientation').show();
        // $('#lettreorientation').removeClass("hidden");
        // var d = new Date(); var dd = d.getDate(); var mm = d.getMonth()+1;          
        // var yyyy = d.getFullYear();
        // var lettre = new jsPDF({orientation: "p", lineHeight: 1.5})
        // lettre.setFontSize(15);
        // lettre.lineHeightProportion = 100;
        // lettre.text(105,20, '{{ Session::get('etabTut') }}', null, null, 'center');
        //  lettre.text(105,28, 'ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE "LES GLYCINES"', null, null, 'center');
          lettre.text(105,28, '{{ Session::get('etabname') }}', null, null, 'center');
        
        // lettre.setFontSize(12);
        // lettre.text(105,36, '{{ Session::get('etabAdr') }}', null, null, 'center');//12, Chemin des Glycines - ALGER
        // lettre.text(105,44, 'Tél : {{ Session::get('etabTel') }} - {{ Session::get('etabTel2') }}', null, null, 'center');
        // lettre.text(200,58, 'Alger,le : '+dd+'/'+mm+'/'+yyyy, null, null, 'right');
        // lettre.text(20,68, 'Emetteur : {{ Auth::User()->employ->nom }} {{Auth::User()->employ->prenom }}', null, null);

        // lettre.text(20,76, 'Tél : {{Auth::User()->employ->tele_mobile }}', null, null);
        // lettre.text(200,68, 'Destinataire : '+medecin , null, null, 'right');
        // lettre.text(200,76, 'Specialite : '+specialite , null, null,'right');
        // lettre.setFontType("bold");
        // lettre.text(105,90, "Lettre d'orientation", null, null, 'center');
        // var text = "permettez moi de vous adresser le(la) patient(e) sus-nommé(e), "+nompatient+" "+prenompatient+" âgé(e) de "+agepatient+" ans, qui s'est présenté ce jour pour  "+$('#motifOrient').val()+"  . je vous le confie pour prise en charge spécialisé. respectueusement confraternellement.";
        // lines = lettre.splitTextToSize(text, 185);
        // lettre.text(20,110,lines,null,null);
        // lettre.text(200,180,'signature',null,null,'right');
        // var string = lettre.output('datauristring');
        // $('#lettreorientation').attr('src', string);
      }