@extends('app')
@section('page-script')
<script type="text/javascript">
       var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes();  
       var field ="date"; 
 	function getAdmissions(field,value)
	{
              var rows =""; var bedAffect = "";
              $('#rdvs').empty();
              var filter= new Date($("#date").val());
               $.ajax({
                      url : '{{ URL::to('/getRdvs') }}',
                      data: { "field":field, "value":value },
                      dataType: "json",// recommended response type
                      success: function(result) {
                             var admissions = $('#rdvs').empty();
                            $('#total_records').text(result.length);
                             if(result.length != 0){
                                    for(var i=0; i<result.length; i++){  
                                            var disabled = 'disabled';
                                            var mode="";var cssClass="primary";       
                                            bedAffect = "<td><strong>/</strong></td><td><strong>/</strong></td><td><strong>/</strong></td>"
                                            var date = new Date(result[i].date);
                                           if(result[i]['demande_hospitalisation']['bed_affectation'] != null && areSameDate(date, filter))
                                            {
                                                   bedAffect ='<td>'+result[i]['demande_hospitalisation']['bed_affectation']['lit']['salle']['service'].nom+'</td><td>'+result[i]['demande_hospitalisation']['bed_affectation']['lit']['salle'].nom+'</td><td>'+result[i]['demande_hospitalisation']['bed_affectation']['lit'].nom+'</td>'; 
                                                  disabled ='';
                                            }
                                            switch(result[i]['demande_hospitalisation'].modeAdmission){
                                                   case "0":
                                                          mode ="Programme"; 
                                                          break;
                                                  case "1":
                                                          mode ="Ambulatoire"; 
                                                          break;
                                                  case "2":
                                                          mode ="Urgence";cssClass="danger"; 
                                                          break;
                                            }
                                            mode ='<span class ="badge badge-'+cssClass +'"">'+mode+'</span>';
                                              form ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" data-target="#'+result[i].id+'" '+disabled+'><i class="fa fa-check"></i>&nbsp;Confirmer</button>&nbsp;';
                                             form +='<a data-toggle="modal" class ="btn btn-info btn-sm" onclick ="ImprimerEtat(\'rdv_hospitalisation\','+result[i].id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom" '+disabled+'><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Imprimer</a>';
                                            form +='<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id+'">'+'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+'<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">confirmer l\'entrée du patient:</h4></div><div class="modal-body"><p><span style="color: blue;"><h3><strong>'+result[i]['demande_hospitalisation']['consultation']['patient'].full_name+'</strong></h3></span></p><br><p><h3>le &quot;<span  style="color: orange;"><strong>' +result[i].date +'</strong></span>&quot;&nbsp;à&nbsp;<span style="color: red;"><strong>'+time+'</strong></span></h3></p></div><form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="/admission">{{ csrf_field() }} <input id="id_RDV" type="text" name="id_RDV" value="' +result[i].id+'" hidden>' + '<div class="modal-footer"><button type="submit" class="btn btn-success"><i class="ace-icon fa fa-check bigger-120"></i>Valider</button><button   type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-120"></i>Annuler</button></div></form></div></div></div>';
                                             rows  +='<tr><td style="display: none;">'+result[i].id 
                                                        +'</td><td>'+result[i]['demande_hospitalisation']['consultation']['patient'].full_name+'</td><td>'
                                                        + result[i]['demande_hospitalisation']['service'].nom +'</td><td><span class ="text-danger"><strong>'
                                                        + result[i].date +'</strong></span></td><td>'
                                                        + mode +'</td>'+bedAffect+'<td class="center">'+ form +'</td></tr>'
                                     }
                                      $('#rdvs').html(rows);
                              }
                       } //success
               }); //ajax programme
               if(areSameDate(dt, filter) && (field == 'date'))
              {
                      url= '{{ route ("demandehosp.urg", ":slug") }}';
                      url = url.replace(':slug',$("#date").val());
                      $.ajax({
                      url: url,
                      //type :'GET',
                      dataType: 'JSON',
                      success:function(result,status, xhr)
                      {
                             if(result.length > 0){
                                    for(var i=0; i<result.length; i++){
                                             var disabled = 'disabled'; 
                                             bedAffect = "<td><strong>/</strong></td><td><strong>/</strong></td><td><strong>/</strong></td>"
                                              if(result[i]['bed_affectation'] != null)
                                             {
                                                   bedAffect ='<td>'+result[i]['bed_affectation']['lit']['salle']['service'].nom+'</td><td>'+result[i]['bed_affectation']['lit']['salle'].nom+'</td><td>'+result[i]['bed_affectation']['lit'].nom+'</td>'; 
                                                   disabled='';
                                             }
                                            mode ='<span class ="badge badge-warning">Urgence</span>';
                                            form ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" data-target="#'+result[i].id+'" '+disabled+'><i class="fa fa-check"></i>&nbsp;Confirmer</button>&nbsp;';
                                            form +='<a data-toggle="modal" class ="btn btn-info btn-sm" onclick ="ImprimerEtat(\'DemandeHospitalisation\','+result[i].id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom" '+disabled+'><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Imprimer</a>';
                                            form +='<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id+'">'+'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+'<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">confirmer l\'entrée du patient:</h4></div><div class="modal-body"><p><span style="color: blue;"><h3><strong>'+result[i]['consultation']['patient'].full_name+'</strong></h3></span></p><br><p><h3>le &quot;<span  style="color: orange;"><strong>' +result[i]['consultation'].date +'</strong></span>&quot;&nbsp;à&nbsp;<span style="color: red;"><strong>'+time+'</strong></span></h3></p></div><form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="/admission">{{ csrf_field() }} <input id="id_RDV" type="text" name="id_RDV" value="' +result[i].id+'" hidden>' + '<div class="modal-footer"><button type="submit" class="btn btn-success"><i class="ace-icon fa fa-check bigger-120"></i>Valider</button><button   type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-120"></i>Annuler</button></div></form></div></div></div>';
                                            rows  +='<tr><td style="display: none;">'+result[i].id 
                                                          +'</td><td>'+result[i]['consultation']['patient'].full_name+'</td><td>'
                                                          + result[i]['service'].nom +'</td><td><span class ="text-danger"><strong>'
                                                          + result[i]['consultation'].date +'</strong></span></td><td>'
                                                          + mode +'</td>'+bedAffect+'<td class="center">'+ form +'</td></tr>'; 
                                            }
                                            $('#rdvs').html(rows); 
                                      } // if
        } // success
      }) //ajax
    }
	}
 	$(function(){
    $(".admiSearch").click(function(e){    
      getAdmissions(field,$('#'+field).val().trim());
      if(field != "date")
        $('#'+field).val('');  
		})
 	});
	
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-sm-12 col-md-12"> <h4><strong>Rechercher une admission</strong></h4>
  	<div class="panel panel-default"><div class="panel-heading">Recherchers</div>
    	<div class="panel-body">
                <div class="row">
                   <div class="col-sm-4">
              			<div class="form-group"><label class="control-label" for="" ><strong>Date :</strong></label>
            			    <div class="input-group">
            			      <input type="text" id ="date" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" >
            					  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
              				</div>
          	        </div>
                	</div>
            		 <div class="col-sm-4">
                  <div class="form-group"><label class="control-label"><strong>IPP:</strong></label><input type="text" id="IPP" class="form-control filter"></div>
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
              <th rowspan="2" class="center"><h5><strong>Patient</strong></h5></th> 
              <th rowspan="2" class="center"><h5><strong>Service</strong></h5></th>
              <th rowspan="2" class="center"><h5><strong>Date d'entrée</strong></h5></th>
              <th rowspan="2" class="center"><h5><strong>Mode d'entrée</strong></h5></th>
              <th colspan="3" scope="colgroup" class="center"><h5><strong>Hébergement</strong></h5></th> <!-- merge four columns -->
              <th rowspan="2" class="center"><em class="fa fa-cog"></em></th>  
            </tr>
            <tr>
              <th scope="col" class="center"><h6><strong>Service</strong></h6></th>
              <th scope="col" class="center"><h6><strong>Salle</strong></h6></th>
              <th scope="col" class="center"><h6><strong>Lit</strong></h6></th>              
            </tr>
          </thead>
                                     <tbody id="rdvs">
                                     @foreach($rdvs as $rdv)
                                        <tr>
                                          <td>{{ $rdv->demandeHospitalisation->consultation->patient->full_name }}
                                          </td>
                                          <td>{{ $rdv->demandeHospitalisation->Service->nom }}</td>
                                          <td><span class ="text-danger"><strong>{{ $rdv->date }}</strong></span></td>
                                          <td>
                                              @foreach(config('settings.ModeAdmissions') as $key=>$value)
                                                @if($value == $rdv->demandeHospitalisation->modeAdmission)
                                                  <span class="badge badge-success">
                                                  {{ $key}}
                                                  </span>
                                                @endif
                                              @endforeach
                                          </td>
                                          @if($rdv->demandeHospitalisation->bedAffectation)
                                            <td>{{ $rdv->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</td>
                                            <td>{{ $rdv->demandeHospitalisation->bedAffectation->lit->salle->nom}}</td>
                                            <td>{{ $rdv->demandeHospitalisation->bedAffectation->lit->nom}}</td>
                                          @else
                                            <td><strong>/</strong></td>
                                            <td><strong>/</strong></td>
                                            <td><strong>/</strong></td>
                                          @endif
                                          <td class="center">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rdv->id }}" @if(!(isset($rdv->demandeHospitalisation->bedAffectation))) disabled @endif><i class="fa fa-check"></i>&nbsp;Confirmer</button>
                                            @include('admission.modalForm.confirmEntreeProg')
                                            <a data-toggle="modal" href="#" class ="btn btn-info btn-sm" onclick ="ImprimerEtat('rdv_hospitalisation',{{ $rdv->id }});" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom" @if(!(isset($rdv->demandeHospitalisation->bedAffectation))) disabled @endif><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Imprimer</a>
                                          </td>
                                          </tr>
                                          @endforeach
                                          @foreach($demandesUrg as $demande)
                                            <tr>
                                                    <td>{{ $demande->consultation->patient->full_name }}</td>
                                                    <td>{{ $demande->Service->nom }}</td>
                                                    <td><span class ="text-danger"><strong>{{ $demande->consultation->date }}</strong></span></td>
                                                    <td>
                                                     <span class="badge badge-danger">
                                                      @foreach(config('settings.ModeAdmissions') as $key=>$value)
                                                        @if($value == $demande->modeAdmission)
                                                          {{ $key}}
                                                        @endif
                                                      @endforeach
                                                    </span>
                                                    </td>
                                                    <td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->salle->service->nom}} @else <strong>/</strong> @endif </td>
                                                    <td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->salle->nom}} @else <strong>/</strong> @endif </td>
                                                    <td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->nom}} @else <strong>/</strong> @endif </td>
                                                    <td class="center">
                                                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $demande->id }}" @if(!(isset($demande->bedAffectation))) disabled @endif data-toggle="tooltip" title="valider l'admission" data-placement="bottom"> <i class="fa fa-check"></i>Confirmer</button>  
                                                      @include('admission.modalForm.confirmEntreeUrg')
                                                      <a data-toggle="modal" href="#" class ="btn btn-info btn-sm" onclick ="ImprimerEtat('DemandeHospitalisation',{{ $demande->id }});" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom" @if(!(isset($demande->bedAffectation))) disabled @endif ><i class="fa fa-file-pdf-o" aria-hidden="true">&nbsp;Imprimer</i></a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                     </tbody>
                            </table>
                      </div>
              </div>
        </div>
</div>{{-- row --}}
  <div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
@endsection