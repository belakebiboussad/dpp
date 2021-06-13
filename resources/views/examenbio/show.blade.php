@extends('app')
@section('main-content')
      <div class="row" width="100%"> @include('patient._patientInfo') </div>
      <div class="content">
      <div class="row">
            <div class="col-sm-5"><h3>Détails de la demande Biologique</h3></div> <div class="col-sm-5"></div>
            <div class="col-sm-7">
                    <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right">
                           <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
                    </a>
                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right">
                          <i class="ace-icon fa fa-backward"></i>&nbsp; precedant
                    </a>
            </div>
       </div><div class="space-12 hidden-xs"></div>
       <div class="row">
            <div class="col-sm-12">
     	      <table class="table table-striped table-bordered">
     		       <thead>
		      <tr>
		             <th class="center"><strong>#</strong></th><th class="center"><strong>Nom Examen</strong></th><th class="center">Etat</em></th>
		      </tr>
	             </thead>
      	             <tbody>
     			@foreach($demande->examensbios as $index => $exm)
          	       <tr>
                          <td class="center">{{ $index + 1 }}</td>
                          <td>{{ $exm->nom_examen }}</td>
                      	@if($loop->first)
            	         	     <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
            		            @if($demande->etat == "E")
                                <span class="badge badge-danger"> En Attente</span>
                                 @elseif($demande->etat == "V")
                                        <span class="badge badge-success">Validé</span>       
                                         @else
                                         <span class="badge badge-success">Rejeté</span>   
                                       @endif
            		            </td>
                     	@endif
		        </tr>
         	@endforeach            
	       </tbody>
      </table>
    </div>
  </div>
@endsection