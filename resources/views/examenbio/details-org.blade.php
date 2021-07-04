@extends('app_laboanalyses')
@section('page-script')
<script>
  $('document').ready(function(){
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
});
</script>
@endsection
@section('main-content')
 <?php
   if(isset($demande->id_consultation))
      $patient = $demande->consultation->patient;
  else
    $patient = $demande->visite->hospitalisation->patient;
  ?>
 <div class="row" width="100%"> @include('patient._patientInfo',$patient) </div>
<div class="row">
  <div class="col-md-5 col-sm-5"><h3>Demande d'examen biologique</h3></div>
  <div class="col-md-7 col-sm-7">
    <a href="/dbToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right"><i class="ace-icon fa fa-print"></i>&nbsp;Imprimer</a>&nbsp;&nbsp;
    @if('Auth::user()->role_id ' == 11)
    <a href="/home" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    @else
    <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    @endif
  </div>
</div><hr>
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4></div>
      <div class="widget-body">
        <div class="widget-main">
        <div class="row">
          <div class="col-xs-12">
            <div class="user-profile row">
            <div class="col-xs-12 col-sm-3 center">
              <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                  <div class="profile-info-name">Date : </div>
                  <div class="profile-info-value"><span class="editable">
                  @if(isset($demande->consultation))
                    {{  (\Carbon\Carbon::parse($demande->consultation->Date_Consultation))->format('d/m/Y') }}
                  @else
                    {{  (\Carbon\Carbon::parse($demande->visite->date))->format('d/m/Y') }}
                  @endif 
                  </span></div>
                </div>
              </div>
              <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                  <div class="profile-info-name">Etat :</div>
                  <div class="profile-info-value">
                      @if($demande->etat == null)
                        <span class="badge badge-success">En Cours
                      @elseif($demande->etat == 1)
                        <span class="badge badge-primary">Validé  
                      @elseif($demande->etat == 0)
                        <span class="badge badge-warning">Rejeté
                      @endif
                      </span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"> Demandeur : </div>
                  <div class="profile-info-value">
                    <span class="editable" id="username">{{ $medecin->nom }} {{ $medecin->prenom }}</span>
                  </div>
                </div>
              </div><!-- profile-user-info  -->
            </div>
            </div><br>
            <div class="user-profile row">
            <form class="form-horizontal" method="POST" action="/uploadresultat" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="center" width="5%">#</th>
                    <th class="center" width="35%">Nom Examen</th>
                    <th class="center" width="20%">Nom Examen</th>
                    <th class="center" width="40%"><em class="fa fa-cog"></em></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($demande->examensbios as $index => $exm)
                  <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $exm->nom_examen }}</td>
                    <td>{{ $exm->Specialite->specialite }}</td>
                    @if($loop->first)
                    <td rowspan ="{{ $demande->examensbios->count()}}" class="center">
                      <label class="control-label no-padding-right" for="resultat"><strong> Attacher le Résultat: </strong></label>
                      <!-- <div class="form-group"></div>  -->
                      <input type="file" class="form-control" id="resultat" name="resultat" alt="Résultat du l'éxamen" accept="image/*,.pdf" required/> 
                    </td>
                     @endif
                  </tr>
                  @endforeach                         
                </tbody>
      </table>
      <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nom"><strong>Compte Rendu : </strong></label>
        <div class="col-sm-9"> 
                <textarea name="crb" name="crb" class="form-control col-xs-12 col-sm-12" placeholder="Compte  rendu des examens" rows=3 ></textarea> 
        </div>
      </div>
      <div class="clearfix form-actions">
        <div class="col-md-offset-5 col-md-7">
           <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
  </div>
  </div><!-- ROW -->
  
      </div> <!-- widget-main -->
      </div> <!-- widget-body -->
    </div>
  </div> <!-- col-sm-12 -->
</div><!-- row -->
@endsection