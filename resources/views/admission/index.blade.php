@extends('app')
@section('page-script')
<script type="text/javascript">
  var dt = new Date(),field ="date";
  var time = dt.getHours() + ":" + dt.getMinutes();  
  
  function admValidfct(rdvid){
    $.get('/rdvHospi/' + rdvid +'/edit  ', function (data) { 
      // $("#patName").text(data.demande_hospitalisation.consultation.patient.full_name);  // $(".orange").text(data.date);// $(".red").text(time);  // $('#admValiForm').modal('show');
         var content ='<br/><h6>Vous allez Confirmer l\'Admission du patient <b>"';
        content += data.demande_hospitalisation.consultation.patient.full_name +' </b>"</h6><br>';
       var htmlChecBox=`<div class="form-check"><input class="form-check-input cards" type="checkbox" value="0" id="cni" >
                       <label class="form-check-label" for="cni">CNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> </div>
                <div class="form-check">
                      <input class="form-check-input cards" type="checkbox" value="1" id="permis">
                      <label class="form-check-label" for="permis"> Permis </label>
                </div>
                <div class="form-check"><input class="form-check-input cards" type="checkbox" value="2" id="cp">
                       <label class="form-check-label" for="cp">CP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>`;
        var   BAPrintBtn =   '<a class="btn btn-md btn-default" target="_blank" href="reportprint/rdv_hospitalisation/'+ data.id+'/8'+'" ><i class="ace-icon fa fa-print">  Imprimer</i>';
        var   BSPrintBtn =   '<a class="btn btn-md btn-default" target="_blank" href="reportprint/rdv_hospitalisation/'+ data.id+'/9'+'" ><i class="ace-icon fa fa-print">  Imprimer</i>';
      //debut
      (async function backAndForth() {
             let currentStep =0;    const values = [];  const steps = ['1', '2', '3']; var cards = [];
              swal.mixin({
                      customClass: {
                            confirmButton: 'btn btn-success',
                              cancelButton: 'btn btn-danger'
                      },
                      confirmButtonText: 'Suivant',
                       reverseButtons: true,
                       showCancelButton: true,
                       cancelButtonText: 'Annuler',
                      progressSteps:steps
               }).queue([
               {
                     title: 'pièces adminstratifs', 
                    html:htmlChecBox ,
                     preConfirm: function(value)
                      {
                              $('input.cards:checkbox:checked').each(function () {
                                   cards.push($(this).val());
                                });
                      }
              },{
                      title: 'BULTTIN  ADMISSION', 
                        html:BAPrintBtn ,
              },{
                      title: 'BILLET DE SALLE',
                       html:BSPrintBtn ,
              }
              ]).then((result) => { 
                       for (currentStep = 0; currentStep < steps.length;) {
                            if (result.value) {
                                     values[currentStep] = result.value;
                                     currentStep++;
                                    if(currentStep== 3){
                                             var formData = { _token: CSRF_TOKEN, "id_RDV": data.id, "demande_id" : data.id_demande, "pieces": JSON.stringify(cards) };
                                           $.each(formData, function(key, value){
                                            alert(key + ":" +value);
                                           })
                                            var url = "{{ route('admission.store')  }}"; 
                                            $.ajax({
                                                    type : 'POST',
                                                    url :url,
                                                   data:formData,
                                                   success:function(data){ 
                                                           $("#rdv-" + data.id).remove(); 
                                                   }
                                          });/* Swal.fire(   'The answer',    'Your answers: <pre><code>' + JSON.stringify(cards) +   '</code></pre>', 'question'   )*/
                                    }
                              }else if (result.dismiss === Swal.DismissReason.cancel) { 
                                return false;
                              } 
                      }
              })
        })();
     //fin
    });
  }
  function getAdmissions(field,value)
	{
    var rows =""; var bedAffect = "";$('#rdvs').empty();
    var filter= new Date($("#date").val());
    $.ajax({
      url : '{{ route("rdvHospi.index")}}',
      data: { "field":field, "value":value },
      success: function(data) {
        var admissions = $('#rdvs').empty();
        $('#total_records').text(data.length);
        if(data.length > 0){
          $.each(data,function(key,rdv){
            var disabled = 'disabled';var mode="";var cssClass="primary";bedAffect = "<td></td><td></td><td></td>";
            var date = new Date(rdv.date);
            switch(rdv.demande_hospitalisation.modeAdmission){
              case 0:
                mode ="Programme"; 
                break;
              case 1:
                mode ="Ambulatoire"; 
                break;
              case 2:
                mode ="Urgence";cssClass="danger"; 
                break;
              default :
                mode ="Programme"; 
                break;  
            }
            mode ='<span class ="badge badge-'+cssClass +'">' + mode + '</span>';
            if((rdv.demande_hospitalisation.bed_affectation != null) && (areSameDate(date, filter)))
            {
              bedAffect  = rdv.demande_hospitalisation.bed_affectation.lit.salle.service.nom + '</td><td>';
              bedAffect += rdv.demande_hospitalisation.bed_affectation.lit.salle.nom + '</td><td>';
              bedAffect += rdv.demande_hospitalisation.bed_affectation.lit.nom; 
              disabled ='';
            }
            actions ='<button type="button" class="btn btn-info btn-sm" onclick = "admValidfct(' + rdv.id + ')" title = "Valider l\'admission du patient" data-placement="bottom" '+ disabled +'><i class="fa fa-check"></i></button>';
            rows += '<tr id="rdv-'+ rdv.id +'"><td hidden>'+ rdv.id + '</td><td>';
            rows +=  rdv.demande_hospitalisation.consultation.patient.full_name +'</td><td>';
            rows +=  rdv.demande_hospitalisation.service.nom +'</td><td><span class ="text-danger"><b>';
            rows +=  rdv.date + '</b></span></td><td>' + mode + '</td><td>' + bedAffect + '</td><td class="center">' + actions + '</td></tr>';    
          });
          $('#rdvs').html(rows); 
        } 
      } //success
    }); //ajax programme // if((dt.setHours(0,0,0,0) == filter.setHours(0,0,0,0)) &&(field == 'date')) {
    if(areSameDate(dt, filter) && (field == 'date'))
    {
      url= '{{ route ("demandehosp.urg", ":slug") }}';
      url = url.replace(':slug',$("#date").val());
      $.ajax({
            url: url,  //type :'GET',
            dataType: 'JSON',
            success:function(result,status, xhr)
            {
             if(result.length > 0){
              for(var i=0; i<result.length; i++){
               var disabled = 'disabled'; 
               bedAffect = "<td></td><td></td><td></td>"
               if(result[i]['bed_affectation'] != null )
               {
                  bedAffect ='<td>'+result[i]['bed_affectation']['lit']['salle']['service'].nom+'</td><td>'+result[i]['bed_affectation']['lit']['salle'].nom+'</td><td>'+result[i]['bed_affectation']['lit'].nom+'</td>'; 
                  disabled='';
               }
              mode ='<span class ="badge badge-warning">Urgence</span>';
              form ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" data-target="#'+result[i].id+'" tilte="Confirmer l\'entrer du patient" data-placement="bottom"'+disabled+'><i class="fa fa-check"></i></button>&nbsp;';
              form +='<a data-toggle="modal" class ="btn btn-info btn-sm" onclick ="ImprimerEtat(1,\'DemandeHospitalisation\','+result[i].id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom" '+disabled+'><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
              form +='<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id+'">'+'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+'<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">confirmer l\'entrée du patient</h4></div><div class="modal-body"><p><h3>'+result[i]['consultation']['patient'].full_name+'</h3></p><p><h3>le &quot;<span  class="orange">' +result[i]['consultation'].date +'</span>&quot;&nbsp;à&nbsp;<span class="red">'+time+'</span></h3></p></div><form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="/admission">{{ csrf_field() }} <input type="hidden" name="demande_id" value="' +result[i].id+'">' + '<div class="modal-footer"><button type="submit" class="btn btn-xs btn-success"><i class="ace-icon fa fa-check"></i>Valider</button><button   type="button" class="btn btn-xs btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button></div></form></div></div></div>';
              rows  +='<tr id="rdv-'+ data.id +'"+><td style="display: none;">'+result[i].id 
                            +'</td><td>'+result[i]['consultation']['patient'].full_name+'</td><td>'
                            + result[i]['service'].nom +'</td><td><span class ="text-danger"><b>'
                            + result[i]['consultation'].date +'</b></span></td><td>'
                            + mode +'</td>'+bedAffect+'<td class="center">'+ form +'</td></tr>'; 
              }
              $('#rdvs').html(rows); 
             }
            } // success
     }) //ajax
  }
	}
 	$(function(){
    getAdmissions(field,$('#'+field).val().trim());
    $(".admiSearch").click(function(e){    
      getAdmissions(field,$('#'+field).val().trim());//if(field != "date") $('#'+field).val('');  
    });
    $('.admValid').bind('click', function() {
      alert("fsfd");
      //$('#admValidModal').modal('show');
    });
 	});
	
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-sm-12 col-md-12">
  	<div class="panel panel-default"><div class="panel-heading">Rechercher une admission</div>
    	<div class="panel-body">
                <div class="row">
                   <div class="col-sm-4">
              			<div class="form-group"><label class="control-label">Date :</label>
            			    <div class="input-group">
            			      <input type="text" id ="date" class="date-picker form-control filter" value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" >
            					  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
              				</div>
          	        </div>
                	</div>
            		 <div class="col-sm-4">
                  <div class="form-group"><label class="control-label">IPP:</label><input type="text" id="IPP" class="form-control filter"></div>
                </div>	
            	</div>
    	</div>
        	<div class="panel-footer">
        		<button type="submit" class="btn btn-sm btn-primary admiSearch"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
        	</div>
  	</div>
	</div>
</div>
<div class="row">
  <div class="widget-box widget-color-blue" id="widget-box-2">
    <div class="widget-header">
      <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>
        Liste des admissions <b><span id="total_records" class = "badge badge-info numberResult" >{{-- count($rdvs) --}}</span></b>
       </h5>
    </div>
    <div class="widget-body">
      <div class="widget-main no-padding">
        <table class="table table-striped table-bordered table-hover irregular-header">
          <thead class="thin-border-bottom thead-light">
            <tr>
              <th rowspan="2" class="center">Patient</th> 
              <th rowspan="2" class="center">Service</th>
              <th rowspan="2" class="center">Date d'entrée</th>
              <th rowspan="2" class="center">Mode d'entrée</th>
              <th colspan="3" scope="colgroup" class="center">Hébergement</th>
              <th rowspan="2" class="center"><em class="fa fa-cog"></em></th>  
            </tr>
            <tr>
              <th scope="col" class="center">Service</th>
              <th scope="col" class="center">Salle</th>
              <th scope="col" class="center">Lit</th>              
            </tr>
          </thead>
          <tbody id="rdvs">
          </tbody>
        </table>
      </div>
    </div>
   </div>
</div>{{-- row --}}
@include('hospitalisations.ModalFoms.EtatSortie')
@include('admission.modalForm.admValidModForm')
@endsection