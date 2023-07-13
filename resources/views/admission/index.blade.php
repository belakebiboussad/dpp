@extends('app')
@section('page-script')
<script type="text/javascript">
  var dt = new Date(),field ="date";
  function admValidfct(isRdv,id){
    var className= "rdv_hospitalisation";
    url= "/rdvHospi/";
    if(!isRdv) 
    {
      className= "DemandeHospitalisation";
      url= "/demandehosp/";
      var formData = { _token: CSRF_TOKEN, "demande_id" : id};
    }else
      var formData = { _token: CSRF_TOKEN, "id_RDV": id };
    $.get(url + id +'/edit  ', function (data) { 
     var htmlChecBox=`<div class="form-check"><input class="form-check-input cards" type="checkbox" value="0" id="cni">
                       <label class="form-check-label" for="cni">CNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> </div>
                <div class="form-check">
                      <input class="form-check-input cards" type="checkbox" value="1" id="permis">
                      <label class="form-check-label" for="permis"> Permis </label>
                </div>
                <div class="form-check"><input class="form-check-input cards" type="checkbox" value="2" id="cp">
                       <label class="form-check-label" for="cp">CP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>`;
      var BAPrintBtn = '<a class="btn btn-xs btn-success" target="_blank" href="reportprint/'+ className +'/'+ id+'/8'+'" ><i class="ace-icon fa fa-print">  Imprimer</i>';
      var BSPrintBtn = '<a class="btn btn-xs btn-success" target="_blank" href="reportprint/'+ className +'/'+ id+'/9'+'" ><i class="ace-icon fa fa-print">  Imprimer</i>';
       (async function backAndForth() {
      let currentStep =0;    const values = [];  const steps = ['1', '2', '3']; var cards = [];
      swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-warning'
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
                  if(cards == "")
                    swal.showValidationMessage("Veuillez selectionner un document !!");
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
                  if(! isEmpty(data.id_demande))
                    formData.demande_id = data.id_demande; 
                  formData.pieces = JSON.stringify(cards); 
                  var url = "{{ route('admission.store')  }}"; 
                  $.ajax({
                      type : 'POST',
                      url :url,
                      data:formData,
                      success:function(data){ 
                        $("#adm-" + data).remove(); 
                      }
                  });
                }
            }else if (result.dismiss === Swal.DismissReason.cancel) { 
              return false;
            } 
          }
        })
      })(); 
    });
  }
  function getModeAdmission(modeId){
    var mode="";
    var cssClass="primary";
    switch(modeId){
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
    return mode;
  }
  function getBedAffectation(bed_affectation){
    var bedAffect = "</td><td></td><td>";
    if(bed_affectation != null)
    {
      bedAffect  = bed_affectation.lit.salle.service.nom + '</td><td>';
      bedAffect += bed_affectation.lit.salle.nom + '</td><td>';
      bedAffect += bed_affectation.lit.nom; 
    }
    return bedAffect; 
  }
  function fill(rdv)
  {
    var rows ="";
    var disabled = 'disabled';
    var filter= new Date($("#date").val());
    var bedAffect = getBedAffectation(rdv.demande_hospitalisation.bed_affectation);
     if(areSameDate(dt, filter) &&(rdv.demande_hospitalisation.bed_affectation!=null))
      disabled ='';
    var actions ='<button type="button" class="btn btn-info btn-sm" onclick = "admValidfct(1,' + rdv.id + ')" title = "Valider l\'admission du patient" data-placement="bottom" '+ disabled +'><i class="fa fa-check"></i></button>';
    rows += '<tr id="adm-'+ rdv.id_demande +'"><td hidden>'+ rdv.id + '</td><td>';
    rows +=  rdv.demande_hospitalisation.consultation.patient.full_name +'</td><td>';
    rows +=  rdv.demande_hospitalisation.service.nom +'</td><td><span class ="red"><b>';
    rows +=  moment(rdv.date).format('YYYY-MM-DD') + '</b></span></td><td>' + getModeAdmission(rdv.demande_hospitalisation.modeAdmission) + '</td><td>' + bedAffect + '</td><td class="center">' + actions + '</td></tr>';    
    return rows;
  }
  function fillUrg(dh)
  {
    var rows ="";
    actions ='<button type="button" class="btn btn-info btn-sm" onclick = "admValidfct(0,' + dh.id + ')" title = "Valider l\'admission du patient" data-placement="bottom"><i class="fa fa-check"></i></button>';
    rows += '<tr id="adm-'+ dh.id +'"><td hidden>'+ dh.id + '</td><td>';
    rows +=  dh.consultation.patient.full_name +'</td><td>';
    rows +=  dh.service.nom +'</td><td><span class ="red"><b>';
    rows +=  moment(dh.consultation.date).format('YYYY-MM-DD') + '</b></span></td><td>' + getModeAdmission(dh.modeAdmission) + '</td><td>' + getBedAffectation(dh.bed_affectation) + '</td><td class="center">' + actions + '</td></tr>';    
    return rows;
  }
  function getAdmissions(field,value)
	{
    $('#rdvs').empty();
    var rows ="";
    $.ajax({
      url : '{{ route("rdvHospi.index")}}',
      data: { "field":field, "value":value },
      success: function(data) {
        var admissions = $('#rdvs').empty();
        $('#total_records').text(data.length);
        if(data.length > 0){
          $.each(data,function(key,rdv){
            rows +=  fill(rdv);
          });
          $('#rdvs').html(rows); 
        } 
      } //success
    });
     var filter= new Date($("#date").val());
    if(areSameDate(dt, filter) && (field == 'date'))
    {
      url= '{{ route ("demandehosp.urg", ":slug") }}';
      url = url.replace(':slug',$("#date").val());
      $.ajax({
          url: url,
          dataType: 'JSON',
          success:function(data)
          {
            if(data.length > 0){
             $.each(data,function(key,dh){
                 rows +=  fillUrg(dh);
              });
             $('#rdvs').html(rows); 
            }
          } // success
     }) //ajax
    }
	}
 	$(function(){
    getAdmissions(field,$('#'+field).val().trim());
    $(".admiSearch").click(function(e){    
        getAdmissions(field,$('#'+field).val().trim());
 	});
  });
</script>
@stop
@section('main-content')
<div class="row">
	<div class="col-sm-12 col-md-12">
  	<div class="panel panel-default"><div class="panel-heading">Rechercher une admission</div>
    	<div class="panel-body">
        <div class="row">
           <div class="col-sm-4">
      			<div class="form-group"><label class="control-label">Date</label>
    			    <div class="input-group">
    			      <input type="text" id ="date" class="date-picker form-control filter" value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" >
                <span class="input-group-addon fa fa-calendar"></span> 
    					 </div>
  	        </div>
        	</div>
    		 <div class="col-sm-4">
          <div class="form-group"><label class="control-label">IPP</label><input type="text" id="IPP" class="form-control filter"></div>
        </div>	
    	</div>
    	</div>
        	<div class="panel-footer">
        		<button type="submit" class="btn btn-sm btn-primary admiSearch"><i class="fa fa-search"></i> Rechercher</button>
        	</div>
  	</div>
	</div>
</div>
<div class="row">
  <div class="widget-box widget-color-blue">
    <div class="widget-header">
      <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>
        Liste des admissions <b><span id="total_records" class = "badge badge-info numberResult"></span></b>
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
          <tbody id="rdvs"> </tbody>
          </table>
      </div>
    </div>
   </div>
</div>{{-- row --}}
@include('hospitalisations.ModalForms.EtatSortie')
@stop