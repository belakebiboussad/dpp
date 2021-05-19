@extends('app')
@section('main-content')
<div class="row" width="100%"><?php $patient = $demande->consultation->patient; ?> @include('patient._patientInfo')</div>
<div class="space-12"></div>
 <h3 style="display: inline;"><strong>Modifier la demande d'examens Radiologiques :</strong></h3>
 <div class="content">
  <div class="row">
    <div class="col-sm-3"></div> <div class="col-sm-3"></div> <div class="col-sm-3"></div>
    <div class="col-sm-3">
      <a href="/showdemandeexr/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right" title="Imprimer">
         <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right">
        <i class="ace-icon fa fa-backward"></i>&nbsp; precedant
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 widget-container-col">
      <div class="widget-box" id="infopatient">
        <div class="widget-header"><h5 class="widget-title"><b>Demande des examens Radiologiques :</b></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
              <div class="col-xs-12">
                  <label><b>Date Demande:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $demande->Date }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <label><b>Informations cliniques pertinentes :</b></label>
                &nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}.</span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Explication de la demande de diagnostic :</b></label>
                 &nbsp;&nbsp;<span>{{ $demande->Explecations }}.</span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Informations supplémentaires pertinentes :</b></label>
                <div>
                  <ul class="list-inline"> 
                    @foreach($demande->infossuppdemande as $index => $info)
                      <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Examen(s) proposé(s) :</b></label>
                <div>
                  <table class="table table-striped table-bordered">
                     <thead>
	                      <tr>
		                        <th class="center" width="10%">#</th>
		                        <th class="center"><strong>Nom</strong></th>
		                        <th class="center"><strong>Type</strong></th>
		                        <th><a href="" class="btn btn-primary btn-xs pull-right " data-toggle="modal"><div class="fa fa-plus-circle"></div></a></th>
	                      </tr>
                     </thead>
                    <tbody>
	                    @foreach ($demande->examensradios as $index => $examen)
	                    <tr>
		                    <td class="center">{{ $index + 1 }}</td>
		                    <td>{{ $examen->nom }}</td>
		                    <td>
                          <span class="badge badge-success">{{ (App\modeles\TypeExam::FindOrFail($examen->pivot->examsRelatif))->nom }}
		                    </td>
                        <td class ="center">
                          <?php $id =$examen->id.'|'.$demande->id ?>
                          <form method="POST" action="{{ route('demandeexr.destroy', [ 'id'=>$id]) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn  btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>
                          </form>
                        </td>
  		                  <!-- ici -->
	                    </tr>
	                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- row -->
          </div><!-- widget-main -->
        </div>
      </div>
     </div>
  </div>
{{--  <div class="row">   <div class="col-sm-12"><label>Résultat :</label>&nbsp;&nbsp;     @isset($demande->resultat) <span><a href='/download/{{ $demande->resultat }}'>{{ $demande->resultat }} &nbsp;<i class="fa fa-download"></i></a></span>
      @endisset  </div> </div> --}}
</div>
@endsection