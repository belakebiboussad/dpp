@extends('app')
@section('title')
  	Nouvelle Consultation
@endsection
@section('style')
<style>
	.modalord {
		width:104.7% !important;
		right:-16% !important;
		left:-2.5% !important;
		top:-3.1% !important;
	}
	.with-margin {
	 	margin-bottom: 5px;
	}
	.spacer5 {
	  	height: 5px;
	}
	.modal-body
	{
	  top: -1px !important;
	}
	.modal-footer {
		  background-color: transparent;
		  position: absolute;
		  right:2px;		
  		bottom: 0px;
	}
	.modal.modal-wide .modal-dialog {
	  width: 60%;
	  height:900px !important;
	  overflow: scroll; 
	}
	.modal-wide .modal-body {
	  overflow-y: auto;
	}
	.modal-content {
	  height: 100%; /* = 100% of the .modal-dialog block */
	}
	#ord {/*position: absolute;*/
  		 top:1%;	
  		 left:-5%%;
	}
	iframe {
	    display: block;
	    margin: 0 auto;
	    border: 0;
	    position:relative;
	    z-index:999;
	}
	#mymainWidget div {
		height: 250px !important;
	}/*fin*/
	.dataTables_wrapper {
      font-family: tahoma;
      font-size: 10px;
      position: relative;
      clear: both;
      zoom: 1;
      zoom: 1;
	}
	.btn-transparent {
	      background: transparent;
	      color: #F2F2F2;
	      -webkit-transition: background .2s ease-in-out, border .2s ease-in-out;
	      -moz-transition: background .2s ease-in-out, border .2s ease-in-out;
	      -o-transition: background .2s ease-in-out, border .2s ease-in-out;
	      transition: background .2s ease-in-out, border .2s ease-in-out;
	      border: 2px solid #4992B7;
	}
	.btn-transparent:hover {
      color: white;
      background-color: rgba(255,255,255,0.2);
	}
</style>
@endsection
@section('page-script')
<script>
	function IMC1(){
		var poids = $("#poids").val();
		var taille = $("#taille").val();
		if(poids==""){
      alert("STP, saisir le poids");
     	$("#poids").focus();
      	return 0;
    }else if (isNaN(poids)) {
     	alert("poids doit être un nombre!");  
     	$("#poids").select();
     	return 0;
   	}
 		if(taille==""){
			alert("STP, Saisir la taille");
 			$("#taille").focus();
 			return 0;
 		}else if (isNaN(taille)) {
     	alert("taille doit être un nombre!");  
     	$("#txtaltura").select();
     	return 0;
    }
    var imc = poids / Math.pow(taille,2);
    var imc = Math.round(imc).toFixed(2);
		$("#imc").attr("value", imc);
    if(imc<17){
      $("#interpretation").attr("value", "Anorexie");
    }else if(imc>=17.1 && imc<=18.49){
      $("#interpretation").attr("value", "Migreur");
    }else if(imc>=18.5 && imc<=24.99){
      $("#interpretation").attr("value", "Poids Normale");
    }else if(imc>=25 && imc<=29.99){
      $("#interpretation").attr("value", "surpois");
    }else if(imc>=30 && imc<=34.99){
			$("#interpretation").attr("value", "Obésité I");
	  }else if(imc>=35 && imc<=39.99){
	   	$("#interpretation").attr("value", "Obésité II (sévère)");	
	  }else if(imc>=40){
	   	$("#interpretation").attr("value", "Obésité III (morbide)");	
    }
	}
	function storeord1()
	{
		var arrayLignes = document.getElementById("ordonnance").rows;
    		var longueur = arrayLignes.length; 
   		 var ordonnance = [];
	       for(var i=1; i<longueur; i++)
		{
		      ordonnance[i-1] = { med: arrayLignes[i].cells[1].innerHTML, posologie: arrayLignes[i].cells[5].innerHTML }
		    }
	    var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(ordonnance)+"' hidden>");
	    champ.appendTo('#consultForm');
  	}
 	function lettreorientation()
	{
		$('#specialite').val($('#specialiteOrient').val());
		$('#medecin').val($('#medecinOrient').val());
		$('#motifOr').val($('#motifOrient').val());
	}
	function demandehosp()
	{
		$('#modeAdmission').val($('#modeAdmissionHospi').val());// $("#degreurg").appendTo('#consultForm');
		$('#specialiteDemande').val($('#specialiteHospi').val());	
		$('#service').val($('#serviceHospi').val());
	}
	function ajaxfunc(patientid)
 	{        
		var habitudeAlim = null; var tabac=null ; var ethylisme = null;
		var antecedant = $('#Antecedant').val();
		var typeAntecedant = $('#typeAntecedant').val();
		var soustype = $('#sstypeatcdc').val();    
		var dateATCD = $('#dateAntcd').val()
		var description = $("#description").val();               
		if(typeAntecedant =="Physiologiques")
		{
		      habitudeAlim= $('#habitudeAlim').val();
		      tabac = $("#tabac").is(":checked") ? 1:0;
		      ethylisme = $("#ethylisme").is(":checked") ? 1:0;
		}
		if (description == "")
		{
		}else{
		      $.ajax({
			       headers: {
			               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
			        type:"POST",
			        url:'/AddANTCD',
			        data:{ antecedant:antecedant,typeAntecedant:typeAntecedant,soustype:soustype,dateATCD:dateATCD,description:description,patientid:patientid,habitudeAlim:habitudeAlim,tabac:tabac,ethylisme:ethylisme 
			        },
		          	success:function(data){
		             		$("#msg").html(data.msg);
		          	}
		       }); 
		       $('#ants-tab').append("<tr><td>"+$('#Antecedant').val()+"</td><td>"+$('#dateAntcd').val()+"</td><td>"+$('#description').val()+"</td><td></td></tr>");  
		        resetField(); 
		}
  	}
	function resetField()
	{
		$("#description").val(' ');$('#dateAntcd').val('');
	}
	function atcdhide()
	{  
		resetField();
		if($('#typeAntecedant').val() === "Pathologiques")
		{
	    $('#atcdsstypehide').attr("hidden",false);
	    $('#PhysiologieANTC').attr("hidden",true);
	    $('#habitudeAlim').val(null);$('#tabac').prop('checked', false); 
	    $('#ethylisme').prop('checked', false);   
		}else{
		  $('#atcdsstypehide').attr("hidden",true);
			$('#PhysiologieANTC').attr("hidden",false);
		}
	}
	function createordXhr(patId,employeId)
	{
		var keys=[], meds=[];
	 	$("#ordonnance thead tr th").each(function(){
		  	if(($(this).html() == "id") || ($(this).html() == "Posologie"))
		  	{
		  	  keys.push($(this).html());
		  	}  
		});
		$("#ordonnance tbody tr").each(function(){
	  	var obj={}, i=0;
		$(this).children("td").each(function(index){
		    if((index == 1) || (index == 5) )
		  	{
		  		obj[keys[i]]=$(this).html();
		    		i++;
		  	}
	      })
  		meds.push(obj);	
	 	});
	 	var formData = {
       		id_patient:patId,
       		id_employe:employeId,
       		meds:JSON.stringify(meds),
	 	};
		$.ajaxSetup({
	    		headers: {
	        		'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    		}
	  	});
		$.ajax({
			beforeSend: function (xhr) {
	      			var token = $('meta[name="_token"]').attr('content');
	      			if (token) {
	      				return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	       			}
   	 		 },
			type: "POST",
			url: "/ordonnaces/print",
			data:formData,//contentType: "application/j-son;charset=UTF-8",
		  	dataType: "json",
		  	success: function (data,status, xhr) {	  	
			   	$('#iframe-pdf').contents().find('html').html(data.html);
			  	$("#ordajax").modal();	// $('#iframe-pdf').focus();//$("#iframe-pdf").get(0).contentWindow.print();			        
		  	},	
	   		error: function (data) {
     	 			console.log('Error:', data);
     			}
  		})
	}
	function print()
	{
		document.title = 'ordonnance-'+$.trim($('#nom').text())+'-'+$.trim($('#prenom').text());
		$('#iframe-pdf').get(0).contentWindow.print();
		document.title = 'Nouvelle Consultation';
	}
	function rdvDelete(rdvId)
	{
	  var url ="/rdv/"+rdvId;
	  $.ajaxSetup({
		  headers: {
		            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		  }
		}); 
		var token = $("meta[name='csrf-token']").attr("content");
		$.ajax({
          type : 'DELETE',
          url : url,
          data: {
      			"id": rdvId,
        		"_token": token,
    			},
          success:function(data){  	   		
           	$('.calendar1').fullCalendar('removeEvents', data.id);              	
          },
          error:function(jqXHR, textStatus, errorThrown){
            	console.log(errorThrown);
          }
		});
	}
	function createexbio(nomp,prenomp,age,ipp){  
		 var img = new Image();
    img.src = '{{ asset("/img/logo.png") }}';
    img.onload = function () {
      createexbioF(img,nomp,prenomp,age,ipp);
    };
	}
	function createexbioF(imge,nomp,prenomp,age,ipp){  
		html2canvas($("#dos"), {
        onrendered: function(canvas) {
          moment.locale('fr');//var IPP = ipp.toString();
        	var formattedDate = moment(new Date()).format("l");         
          var imgData = canvas.toDataURL('image/png');              
          var doc = new jsPDF('p', 'mm');
         	doc.text(105,9, 'DIRECTION GENERAL DE LA SURETE NATIONALE', null, null, 'center');
         	doc.setFontSize(13);
          doc.text(105,16, 'HOPITAL CENTRAL DE LA SURETE NATIONALE "LES GLYCINES"', null, null, 'center');
          doc.setFontSize(12);
          doc.text(105,21, '12, Chemin des Glycines - ALGER', null, null, 'center');
          doc.text(105,26, 'Tél : 23-93-34 - 23-93-58', null, null, 'center');
          doc.addImage(imge, 'JPEG', 95, 27, 17, 17);
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
	    	   doc.text(100,270, 'Docteur : ' +'{{$employe->nom}}'+ ' '+ '{{$employe->prenom}}', null, null); 
          doc.save('ExamBiolo-'+nomp+'-'+prenomp+'.pdf');
        }
    });    
	}
	function createexbioOrg(nomp,prenomp,age){      
	    var exbio = new jsPDF();//var d = new Date();
	    moment.locale('fr');
	    var formattedDate = moment(new Date()).format("l");
	    exbio.text(200,20, 'Date : '+formattedDate , null, null, 'right');
	    exbio.text(20,25, 'Nom : '+nomp, null, null);
	    exbio.text(20,35, 'Prénom : '+prenomp, null, null);
	    exbio.text(20,45, 'Age : '+ age+' ans', null, null);
	    exbio.setFontType("bold");
	    exbio.text(105,55, 'Priére de faire', null, null, 'center');
	    exbio.setFontSize(14);
	    exbio.text(45,65,'Analyses Demandées :',null,null,'center');
	    exbio.setFontSize(13);
	    var i =0;
	    $('input.ace:checkbox:checked').each(function(index, value) {
	      exbio.text(25,72+i,this.nextElementSibling.innerHTML+", "); //alert(value.nextElementSibling.innerHTML);
	      i=i+10;
	    });
	    exbio.save('ExamBio-'+nomp+'-'+prenomp+'.pdf');
  }
  function createeximg(nomp,prenomp,age,ipp) {
    var img = new Image();
    img.src = '{{ asset("/img/logo.png") }}';
    img.onload = function () {
      createeximgF(img,nomp,prenomp,age,ipp);
    };
  } 
  function createeximgF(imge,nomp,prenomp,age,ipp)
  {  
  	html2canvas($("#dos"), {
        onrendered: function(canvas) {         
        	moment.locale('fr');//var IPP = ipp.toString();
        	var formattedDate = moment(new Date()).format("l");
          var imgData = canvas.toDataURL('image/png');              
          var doc = new jsPDF('p', 'mm');
          doc.addImage(imgData, 'PNG', 10, 10); //JsBarcode("#itf",IPP); //bonne
          JsBarcode("#itf", ipp.toString(), {
				  	lineColor: "#000",
				  	width:4,
				  	height:40,
				 	  displayValue: true,
				 	  fontSize : 28,
				 	  textAlign: "left"
					});
				  const img = document.querySelector('img#itf');
          doc.text(105,9, 'DIRECTION GENERAL DE LA SURETE NATIONALE', null, null, 'center');
          doc.setFontSize(13);
          doc.text(105,16, 'HOPITAL CENTRAL DE LA SURETE NATIONALE "LES GLYCINES"', null, null, 'center');
          doc.setFontSize(12);
          doc.text(105,21, '12, Chemin des Glycines - ALGER', null, null, 'center');
          doc.text(105,26, 'Tél : 23-93-34 - 23-93-58', null, null, 'center');
          doc.addImage(imge, 'JPEG', 95, 27, 17, 17);
          doc.setFontSize(14);
          doc.text(200,60, 'Alger :' +formattedDate , null, null, 'right'); 
          doc.text(20,63, 'Nom : '+nomp, null, null);
          doc.text(20,68, 'Prénom : '+prenomp, null, null);
          doc.text(20,73, 'Age : '+ age+' ans', null, null);
          doc.addImage(img.src, 'JPEG', 20, 75, 50, 15);
          doc.text(20,110, 'Prière de faire', null, null);
					doc.setFontSize(16);
					doc.text(50,125,'Examens Demandées :',null,null)
          var res = doc.autoTableHtmlToJson(document.getElementById('ExamsImgtab'));
          var height = doc.internal.pageSize.height;
          doc.autoTable(res.columns, res.data, {
     				startY: 135,
  				});
  				doc.setFontSize(12);
  				doc.text(100,270, 'Docteur : ' +'{{$employe->nom}}'+ ' '+ '{{$employe->prenom}}', null, null);  // var string = doc.output('datauristring');// $('#exradiopdf').attr('src', string);
  			  doc.save('ExamRadio-'+nomp+'-'+prenomp+'.pdf');
        }
    });
  }
	function addCIMCode(code)
	{
		$("#codesim").val(code);
		$('#liste_codesCIM').empty();
		$("#chapitre").val($("#chapitre option:first").val());
		$("#schapitre").val($("#schapitre option:first").val());
		$('#cim10Modal').modal('toggle');
	}
	$('document').ready(function(){
		$( 'ul.nav li' ).on( 'click', function() {
			$(this).siblings().addClass('filter');
		});
		$('.wysiwyg-editor').on('input',function(e){
		  	var a = $(this).parent().nextAll("div.clearfix");
	   		var i = a.find("button:button").each(function(){
		   		$(this).removeAttr('disabled');
	 		});
		});
		$('.select2').css('width','400px').select2({allowClear:true})
   		$('#select2-multiple-style .btn').on('click', function(e){
 			var target = $(this).find('input[type=radio]');
  			var which = parseInt(target.val());
 			if(which == 2) 
 				$('.select2').addClass('tag-input-style');
		     	else
		     	 $('.select2').removeClass('tag-input-style');
 		});
		$(function() {
			var checkbox = $("#isOriented");  // Get the form fields and hidden div
			var hidden = $("#hidden_fields");  // Setup an event listener for when the state of the    // checkbox changes.
	   		 checkbox.change(function() {
			   	if (checkbox.is(':checked')) {
			  		hidden.show();
			   	} else {
			     		hidden.hide();
			     		$("#lettreorientaioncontent").val("");
			   	 }
			})
 		}); 
	  $(".two-decimals").change(function(){
	    			this.value = parseFloat(this.value).toFixed(2);
	  });
		$("button").click(function (event) {
	 		which = '';
	 		str ='send';
	 		which = $(this).attr("id");
	 		var which = $.trim(which);
	 		var str = $.trim(str);
			if(which==str){
	    			return true;
			}
 		});
	 $("#btnCalc").click(function(event){
	    	event.preventDefault();
	  });
	$('#medc_table').DataTable({
	      processing: true, //serverSide: true,
	      ordering: true,
	      bInfo : false,
	      searching: true,
	      pageLength: 5,         
	      bLengthChange: false,
	      nowrap:true,
	      "language": {
	                    "url": '/localisation/fr_FR.json'
	      },
	      ajax: '/getmedicaments',
	       columns: [
	                    {data: 'Nom_com'},
	                    {data: 'Forme'},
	                    {data: 'Dosage'},
	                    {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	});
	jQuery('#btn-add, #AntFamil-add').click(function () {//ADD
		jQuery('#EnregistrerAntecedant').val("add");
		jQuery('#modalFormData').trigger("reset");
		$('#AntecCrudModal').html("Ajouter un Antecedant");
		if(this.id == "AntFamil-add")
    		{
 			$("#EnregistrerAntecedant").attr('data-atcd','Famille'); 
 			if(! ($( "#modalFormData > #sous_type" ).hasClass( "hidden" )))
 				jQuery('#modalFormData > #sous_type').addClass('hidden'); 
		}else{	
				$("#EnregistrerAntecedant").attr('data-atcd','Perso'); 
				if( ($( "#modalFormData > #sous_type" ).hasClass( "hidden" )))
					jQuery('#modalFormData > #sous_type').removeClass('hidden'); 
		}
		  jQuery('#antecedantModal').modal('show');
	});	
	jQuery('body').on('click', '.open-modal', function (event) {//EDIT
		var atcd_id = $(this).val();
		$.get('/atcd/' + atcd_id, function (data) { 
		 	$('#atcd_id').val(data.id);
			if( ($( "#modalFormData > #sous_type" ).hasClass( "hidden" )))
				jQuery('#modalFormData > #sous_type').removeClass('hidden');
			 $('#typeAntecedant').val(data.typeAntecedant).change();
		 	if(data.typeAntecedant   === 'Pathologiques')
				  $('#sstypeatcdc').val(data.stypeatcd).change();
		 	if(data.typeAntecedant   === 'Physiologiques')
			{
				$('#habitudeAlim').val(data.habitudeAlim);
				(data.tabac) ? $('#tabac').prop('checked',true) : '';
				(data.ethylisme) ? $('#ethylisme').prop('checked',true) : '';
			}
			$('#dateAntcd').val(data.date);
			$('#description').val(data.descrioption);
			$("#EnregistrerAntecedant").attr('data-atcd',"Perso");
			$('#AntecCrudModal').html("Editer un Antecedant");	
		 	 jQuery('#EnregistrerAntecedant').val("update");	
			jQuery('#antecedantModal').modal('show');
	   	 });
	});
	jQuery('body').on('click', '.open-modalFamil', function (event) {//edit famill
		var atcd_id = $(this).val();
	 	$.get('/atcd/' + atcd_id, function (data) { 
		 	$('#atcd_id').val(data.id);
			$('#dateAntcd').val(data.date);
		  $('#description').val(data.descrioption);
		 	jQuery('#EnregistrerAntecedant').val("update");
		 	$("#EnregistrerAntecedant").attr('data-atcd',"Famille")	
			if(! ($( "#modalFormData > #sous_type" ).hasClass( "hidden" )))
	   			jQuery('#modalFormData > #sous_type').addClass("hidden");
 			 jQuery('#antecedantModal').modal('show');
		});
	});
	$("#EnregistrerAntecedant").click(function (e) {//save
	 	 var habitudeAlim = null; var tabac=null ; var ethylisme = null;
		e.preventDefault();
  		if($("#EnregistrerAntecedant").attr('data-atcd') == "Perso")
		{
		 	var tabName = "antsTab";
		 	var formData = {
	  			Patient_ID_Patient      : '{{ $patient->id }}',
		      		Antecedant           : 'Personnels',//jQuery('#Antecedant').val()
		       	typeAntecedant       : jQuery('#typeAntecedant').val(),
		       	stypeatcd            : jQuery('#sstypeatcdc').val(),
		     		date                    : $('#dateAntcd').val(),
		       	descrioption         : $("#description").val(),
  			};
  			if(formData.typeAntecedant =="Physiologiques")
 	  		{
				formData.habitudeAlim = $('#habitudeAlim').val();
				formData.tabac = $("#tabac").is(":checked") ? 1:0;
				formData.ethylisme = $("#ethylisme").is(":checked") ? 1:0;     
 		 	}
		}else
		{
	 	 	var tabName = "antsFamTab";
			var formData = {
		  		Patient_ID_Patient   : '{{ $patient->id }}',
			      	Antecedant           : 'Familiaux',
			      	date                 : $('#dateAntcd').val(),
		       	descrioption         : $("#description").val(),
  			};
		}
  		if(!($("#description").val() == ''))
	  	{	
			if($('.dataTables_empty').length > 0)
				$('.dataTables_empty').remove();
    			$.ajaxSetup({
	     		 	 headers: {
	      			      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	     		 	 }
  		  	});
	    		var state = jQuery('#EnregistrerAntecedant').val();
   			var type = "POST";
    			var atcd_id = jQuery('#atcd_id').val();
    			var ajaxurl = '/atcd/';
		      	if (state == "update") {
			      	type = "PUT";
			      	ajaxurl = '/atcd/' + atcd_id;
	       	}   
	       	$.ajax({
				       type: type,
				       url: ajaxurl,
				       data: formData,
				       dataType: 'json',
				       success: function (data) {
				    	   	if(data.Antecedant == "Personnels")
				    	   	{
							var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.Patient_ID_Patient + '</td><td>' + data.typeAntecedant +'</td><td>'+data.stypeatcd+'</td><td>'+ data.date + '</td><td>' + data.descrioption + '</td>';
			              		atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
			            			  atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
	              			}else
	              			{
		              			var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.Patient_ID_Patient + '</td><td>' + data.date + '</td><td>' + data.descrioption + '</td>';
			              		atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
			            		  	atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';

	              			}
		              		if (state == "add") { 
		       				jQuery('#' + tabName+' tbody').append(atcd);
		              		} else {
		                  		$("#atcd" + atcd_id).replaceWith(atcd);
		              		}
			            		 jQuery('#modalFormData').trigger("reset");
			             		 jQuery('#antecedantModal').modal('hide');
		       		 },
				        error: function (data) {
				              console.log('Error:', data);
				       }
				});
    			}          
		 });
		$('#antecedantModal').on('hidden.bs.modal', function () {
		   	  $('#PhysiologieANTC').attr("hidden",true); //$("#sous_type").attr("hidden",true);
			  $("#atcdsstypehide").attr("hidden",true);
		});
  		jQuery('body').on('click', '.delete-atcd', function (e) {
  			event.preventDefault();
  			var atcd_id = $(this).val();
  			$.ajaxSetup({
	       		headers: {
	        			 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	          		}
	      		});
       		$.ajax({
	       		type: "DELETE",
	        		url: '/atcd/' + atcd_id,
	       		success: function (data) {
	            			$("#atcd" + atcd_id).remove();
	         		 },
			        error: function (data) {
			             console.log('Error:', data);
			        }
      			});
		});
		$('#examensradio').on('select2:select', function (e) { 
			if($("input[name='exmns[]']").is(":checked"))
	 			$(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
		});
		$('#examensradio').on('select2:unselecting', function(event) {
	 		$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
		});
		$('.exmns').on('change', function(){ // on change of state
		  if(this.checked) 
		  {
		  	if(! isEmpty($('#examensradio').val()))
		  		$(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
		  }else{
		  		$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
		  }
		});
   	$('#btn-addImgExam').click(function(){
	  	var selected = []; var array = [];
	  	$('#ExamIgtModal').modal('toggle');
			$.each($("input[name='exmns[]']:checked"), function(){
				selected.push($(this).next('label').text());
				array.push($(this).val());
				$(this). prop("checked", false);
	  	});   
	 	  var exam = '<tr id="acte-'+$("#examensradio").val()+'"><td id="idExamen" hidden>'+$("#examensradio").val()+'</td><td>'+$("#examensradio option:selected").text()+'</td><td id ="types" hidden>'+array+'</td><td>'+selected+'</td><td class="center" width="5%">';
	 	  exam += '<button type="button" class="btn btn-xs btn-danger delete-ExamImg" value="'+$("#examensradio").val()+'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';     
	  	$('#ExamsImg').append(exam);
		 	$('#examensradio').val(' ').trigger('change');
		 	$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
		});
		jQuery('body').on('click', '.delete-ExamImg', function () {
	  	$("#acte-" + $(this).val()).remove();
	});
	 $("#consultForm").submit(function(e){
   		if(!checkConsult())
   		{
   			activaTab("Interogatoire");
   			return false;
   		}
   		var ExamsImg = [];
   		var arrayLignes = document.getElementById("ExamsImg").rows;
  		for(var i=0; i< arrayLignes.length; i++)
  		{
  			ExamsImg[i] = { acteImg: arrayLignes[i].cells[0].innerHTML, types: arrayLignes[i].cells[2].innerHTML }
  		}
   	 	var champ = $("<input type='text' name ='ExamsImg' value='"+JSON.stringify(ExamsImg)+"' hidden>");
    		champ.appendTo('#consultForm');
	}); //calendrier  	
      var CurrentDate = (new Date()).setHours(23, 59, 59, 0);
	var today = (new Date()).setHours(0, 0, 0, 0);
	$('.calendar1').fullCalendar({
	      plugins: [ 'dayGrid', 'timeGrid' ],
	      header: {
		          left: 'prev,next today',
		          center: 'title,dayGridMonth,timeGridWeek',
		          right: 'month,agendaWeek,agendaDay'
		},
	       defaultView: 'agendaWeek',
	       height: 650,
		firstDay: 0,
	       slotDuration: '00:15:00',
	  	minTime:'08:00:00',
    	maxTime: '17:00:00',
      navLinks: true,
      selectable: true,
      selectHelper: true,
      eventColor  : '#87CEFA',
      editable: true,
     	hiddenDays: [ 5, 6 ],
     	weekNumberCalculation: 'ISO',
     	aspectRatio: 1.5,
     	eventLimit: true,
    	allDaySlot: false,
   		eventDurationEditable : false,
   		weekNumbers: true,
    	views: {},
	    events: [
		       @foreach($employe->rdvs as $rdv)
		       {
			       title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
			       start : '{{ $rdv->Date_RDV }}',
			       end:   '{{ $rdv->Fin_RDV }}',
			       id :'{{ $rdv->id }}',
			       idPatient:{{$rdv->patient->id}},
			       tel:'{{$rdv->patient->tele_mobile1}}',
			       age:{{ $rdv->patient->getAge() }},
			       specialite: {{ $rdv->employe["specialite"]}},
			       fixe:  {{ $rdv->fixe }},          
		      	},
		       @endforeach 
	    ],
      eventRender: function (event, element, webData) {
       if(event.start < today) // element.find('.fc-title').append("," + event.tel);// element.css("font-size", "1em");
				 element.css('background-color', '#D3D3D3');
				else
				{	
       				if(event.fixe)
         					element.css('background-color', '#87CEFA'); 
         				else
         					element.css('background-color', '#378006');
         				element.css("padding", "5px"); 
				}
				element.popover({
			  		delay: { "show": 500, "hide": 100 },  // title: event.title,
			      		content: event.tel,
			        	trigger: 'hover',
			             animation:true,
			             placement: 'bottom',
			             container: 'body',
			             template:'<div class="popover" role="tooltip"><div class="arrow"></div><h6 class="popover-header">'+event.tel+'</h6><div class="popover-body"></div></div>',
			 	});		    
			}, 
		       select: function(start, end) {
				if(start > CurrentDate){
	                             Swal.fire({
		                                 title: 'Confimer vous  le Rendez-Vous ?',
		                                 html: '<br/><h4><strong id="dateRendezVous">'+start.format('dddd DD-MM-YYYY')+'</strong></h4>',
		                                 input: 'checkbox',
		                                 inputPlaceholder: 'Redez-Vous Fixe',
		                                 showCancelButton: true,
		                                 confirmButtonColor: '#3085d6',
		                                 cancelButtonColor: '#d33',
		                                 confirmButtonText: 'Oui',
		                                 cancelButtonText: "Non",
	                        	 }).then((result) => {
                             		 if(!isEmpty(result.value))
                               			createRDVModal(start,end,'{{ $patient->id }}',result.value);//createRDVModal(start,end,$('#id').val(),result.value);	
                        		  })
				}else
					$('.calendar1').fullCalendar('unselect');
			},
		 	eventClick: function(calEvent, jsEvent, view) {
		      	 	editRdv(calEvent);
		   	},
   			eventAllow: function(dropLocation, draggedEvent) {
	    			if(draggedEvent.start < CurrentDate)
	      	 		return false;  	     
	   		},
			eventDrop: function(event, delta, revertFunc) { 
  				$('#updateRDV').removeClass('invisible');
  				jQuery('#btnclose').click(function(){
   		 			revertFunc();
  				});
  				editRdv(event);
    			},
		     	eventResize: function (event, delta, revertFunc) {},
		    	eventDragStop: function (event, jsEvent, ui, view) {} 
		}); // calendar
    $('#updateRDV').click(function(){
			var url = '{{ route("rdv.update", ":slug") }}'
			 url = url.replace(':slug',$('#idRDV').val());
			$.ajaxSetup({
	          		headers: {
	                		'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	          		}
	        	});
		       	$.ajax({
			              type : 'PUT',
			              url : url,
			              data: {
			          		  "id": $('#idRDV').val(),
			          		   "daterdv" : $('#daterdv').val(),
			          		   'datefinrdv' :$('#datefinrdv').val(),
			        	},
			        	success:function(data){  	   		
			              		 $('#fullCalModal').modal('toggle');
			                	 $('#updateRDV').addClass('invisible');
			              },
			              error:function(jqXHR, textStatus, errorThrown){
			              	  console.log(textStatus);		      
			              }
    			});
    		});
      $('#chapitre').click(function(){
        if(! isEmpty($("#chapitre").val()) && $("#chapitre").val()!=0)
    		{
    	  	$.ajax({
           type : 'get',
            url : '{{URL::to('schapitres')}}',
              data:{'search':$("#chapitre").val()},
              success:function(data,status, xhr){
              	$( "#schapitre" ).prop( "disabled", false );
          	    var select = $('#schapitre').empty();
                select.append("<option value='0'>Selectionnez une Sous Chapitre</option>");   
                  $.each(data,function(){
                    select.append("<option value='"+this.	C_S_CHAPITRE+"'>"+this.TITRE_S_CHAPITRE+"</option>");
                  });
              }
          });
    	}
    	else
		$( "#schapitre" ).prop( "disabled", true );
    });
    $('#schapitre').click(function(){//sous chapitre
     	if($("#schapitre").val() != 0)
    	{
    		$.ajax({
            type : 'get',
            url : '{{URL::to('maladies')}}',
            data:{'search':$("#schapitre").val()},
            success:function(data,status, xhr){
            	$(".numberResult").html(Object.keys(data).length);//$("#liste_codesCIM tbody").html(data);
					   	 	$('#liste_codesCIM' ).DataTable( {
           			 	processing: true,
           			 	bInfo : false,
           			 	pageLength: 5,
           			 	pageLength: 5,
           			 	"language": { "url": '/localisation/fr_FR.json' },
           			 	"data" : data,
           			 	columns: [ 
           			 			{data: 'CODE_DIAG'},
           			 			{data: 'NOM_MALADIE'},
					            {data: null, title :'<em class="fa fa-cog"></em>', orderable: false, searchable: false,
					            	"render": function(data,type,full,meta){
					            		if( type === 'display' ) {
					            			return '<button class="btn btn-xs btn-primary" data-dismiss="modal" onclick="addCIMCode(\''+ data.CODE_DIAG+'\')"><i class="ace-icon fa fa-plus-circle"></i></button>';
					            		}
					            		return data;
					            	}      	
					          	}
					      	],
					      	"columnDefs": [
			   								{"targets": 1 ,  className: "dt-head-center" },
			   								{"targets": 2 ,  className: "dt-head-center dt-body-center","orderable": false },
			   					]
        			});    
          },
          error:function(){
     				console.log("error");
     			},
        });
    	}
    });
	});// ready
</script>	
@endsection
@section('main-content')
<div class="page-header" width="100%">
	<div class="row">
		<div class="col-sm-12" style="margin-top: -3%;">@include('patient._patientInfo')	</div>
	</div>
</div>
<div class="content"><!-- style="height:800px;" -->
	<div class="row">
	<form  class="form-horizontal" action="{{ route('consultations.store') }}" method="POST" role="form" id ="consultForm">
	  {{ csrf_field() }}
	    <input type="hidden" name="id" id="id" value="{{ $patient->id }}">
	  <div class="form-group" id="error" aria-live="polite">
		@if (count($errors) > 0)
		  <div class="alert alert-danger">
				<ul>
				 @foreach ($errors->all() as $error)
			 	  <li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
		</div>
		<div id="prompt"></div>
		<div class="tabpanel">
			<ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
				<li role= "presentation" class="active col-md-4">
				  <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
				    <i class="fa fa-commenting" aria-hidden="true"></i><span class="bigger-160"> Interogatoire</span>
				  </a>
				</li>
				<li role= "presentation"  class="col-md-4">
	         <a href="#ExamClinique"  ria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
	         <span class="bigger-160">Examen Clinique</span></a>
				</li>
				<li role= "presentation" class="col-md-4">
				          <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
				         		<span class="bigger-160">Examen Complémentaire</span>
					</a>
				</li>
		  </ul>
		  <div class ="tab-content"  style = "border-style: none;" >
		   	<div role="tabpanel" class = "tab-pane active " id="Interogatoire"> 
				  <div class= "col-md-12 col-xs-12">
				    @include('consultations.Interogatoire')
				  </div>  {{--  <div class= "col-md-3 col-xs-9"> </div> --}}
				</div>
				<div role="tabpanel" class = "tab-pane" id="ExamClinique">
				  <div class= "col-md-12 col-xs-12">
				     	@include('consultations.examenClinique')
				  </div>
				</div>  {{-- row --}}{{-- finexamenclinique --}}
				<div role="tabpanel" class = "tab-pane" id="ExamComp">
				  <div class= "col-md-12 col-xs-12">    
				     	@include('consultations.ExamenCompl')   
				  </div>{{-- <div class= "col-md-3 col-xs-9"> </div> --}}
				</div> 
		  </div>{{-- content --}}
  	</div>{{-- tabpanel --}}
		</div><!-- row -->
		<div class="row">
			<div class="col-sm12">
			<!-- les input de modal form(Demande Hospitalisation)  -->
				<input type="hidden" name="service" id="service">
				<input type="hidden" name="specialiteDemande" id="specialiteDemande">
				<input type="hidden" name="modeAdmission" id="modeAdmission"><!-- les input de modal form(Lettre Orientation)  -->
				<input type="hidden" name="specialite" id="specialite">
				<input type="hidden" name="medecin" id="medecin">
				<input type="hidden" name="motifOr" id="motifOr">
			</div>
		</div>
		<div class="row">
			<div class="col-sm12">
				<div class="center bottom" style="bottom:0px;">
					<button class="btn btn-info btn-sm" type="submit" id="send">
						<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
					</button>&nbsp; &nbsp; &nbsp;
					<a href="{{ route('patient.show',$patient->id) }}" class="btn btn-warning btn-sm">
						<i class="ace-icon fa fa-close bigger-110"></i>Annuler
					</a>
				</div>
			</div>
		</div><!-- row -->
	</form>
</div><!-- content     -->
<div class="row">	@include('consultations.LettreOrientation')</div>
<div class="row">	@include('consultations.DemadeHospitalisation')</div>
<div class="row">	@include('antecedents.AntecedantModal')</div>
<div class="row">@include('consultations.ModalFoms.Ordonnance')</div>
<div class="row">@include('consultations.ModalFoms.imprimerOrdonnance')</div>
<div class="row">@include('consultations.ModalFoms.imprimerOrdonnanceAjax')</div>
<div class="row">@include('consultations.ModalFoms.rendezVous')</div>
<div class="row">@include('cim10.cimModalForm')</div>
@endsection