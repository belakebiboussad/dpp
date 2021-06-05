@extends('app')
@section('main-content')
<div class="row" width="100%"> <?php $patient = $visite->hospitalisation->patient; ?>@include('patient._patientInfo') </div>
<div class="content">
  <div class="row">
    <div class="col-sm-4"><h3>Détails de la visite</h3></div> <div class="col-sm-5"></div>
    <div class="col-sm-3">
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    </div>
  </div><div class="space-12 hidden-xs"></div>
  @if(isset($visite->demandeexmbio))
  <div class="row">
    <div class="col-sm-12">
      <caption style="text-align:right"><h4>Détails de la demande Biologique</h4></caption>
     	<table class="table table-striped table-bordered">
     		<thead>
		      <tr>
		        <th class="center"><strong>#</strong></th><th class="center"><strong>Nom Examen</strong></th><th class="center">Etat</th>
            <th class="center"><em class="fa fa-cog"></em></th>
		      </tr>
	      </thead>
      	<tbody>
     		  @foreach($visite->demandeexmbio->examensbios as $index => $exm)
          	<tr>
              <td class="center">{{ $index + 1 }}</td>
              <td>{{ $exm->nom_examen }}</td>
               	@if($index ==0)
            		<td rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">
            			@if($visite->demandeexmbio->etat == "E")
                    <span class="badge badge-danger"> En Attente</span>
                  @elseif($visite->demandeexmbio->etat == "V")
                    <span class="badge badge-success">Validé</span>       
                  @else
                    <span class="badge badge-success">Rejeté</span>   
                  @endif
            		</td>
                <td rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">
                  <a href="/showdemandeexb/{{ $visite->demandeexmbio->id }}" title = "Imprimer"  target="_blank" class="btn btn-xs btn-primary">
                    <i class="ace-icon fa fa-print"></i>
                  </a>
                </td>
            	@endif
		        </tr>
         	@endforeach            
         
	       </tbody>
      </table>
    </div>
    @endif
    @if(isset($visite->examensradiologiques))
    <div class="row">
      <caption style="text-align:right"><h4>Détails de la demande Imagerie</h4></caption>
        <a href="/showdemandeexr/{{ $visite->examensradiologiques->id }}" target="_blank" class="btn btn-xs btn-primary pull-right">
          <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
        </a>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="center"><strong>#</strong></th><th class="center"><strong>Nom Examen</strong></th><th class="center">Etat Demande</em></th>
          </tr>
        </thead>
        <tbody>
          
         
         </tbody>
      </table>
     </div> 
    @endif

  </div>
@endsection