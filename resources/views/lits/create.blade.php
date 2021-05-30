@extends('app')
@section('page-script')
<script type="text/javascript">
	$('document').ready(function(){
		$('#service').change(function(){
			$('#chambre').removeAttr("disabled");
		  $.ajax({
          //url : '/getsalles/'+ $('#service').val(),
          url : '/salles/'+ $('#service').val(),
          type : 'GET',
          dataType : 'json',
          success : function(data){
            if(data.length != 0){
              	var select = $('#chambre').empty();
                  $.each(data,function(){
                       select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                  });
            }else
              $('#chambre').html('<option value="" disabled selected>Pas de salle</option>');
              
          },
      });
		})
	});
</script>
@endsection
@section('main-content')
	<div class="page-header">
		<h1>Ajouter un Lit</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<div class="widget-box" id="widget-box-1">
			<div class="widget-header">
				<h5 class="widget-title"><img src="/img/bed.png" alt="lit"><strong>Lit :</strong></h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<i class="ace-icon fa fa-table"></i>
					<a href="/lit"> <b>&nbsp;Liste des Lits</b></a>
				</div>
			</div>	
			<div class="widget-body">
			<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.store') }}">
				{{ csrf_field() }}
				<div class="space-12"></div>	
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numlit"><strong> Numéro Lit : </strong>
					</label>
					<div class="col-sm-9">
					<input type="number" id="numlit" name="numlit" placeholder="numéro du  lit" class="col-xs-10 col-sm-5"  min="1" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> nom   Lit : </strong>
					</label>
					<div class="col-sm-9">
					<input type="text" id="nom" name="nom" placeholder="nom complet du lit" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="service"><strong>Service :</strong></label>
					<div class="col-sm-9">
					@if(!isset($id_salle)  && empty($id_salle)) 
					<select class="col-xs-10 col-sm-5" id="service" name="service" required>
						<option value="">Choisir un Service...</option>
						@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
					</select>
					@else
					<select class="col-xs-10 col-sm-5" id="service" name="service" required>
						<option value="{{ App\modeles\service::FindOrFail(  App\modeles\Salle::FindOrFail($id_salle)->service_id)->id }}">
							{{ App\modeles\service::FindOrFail(  App\modeles\Salle::FindOrFail($id_salle)->service_id)->nom }}
						</option>	
					</select>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="chambre"><strong>Chambre :</strong></label>
					<div class="col-sm-9">
					@if(!isset($id_salle)  && empty($id_salle)) 
						<select class="col-xs-10 col-sm-5" id="chambre" name="chambre" required>
						<option value="" selected disabled>Choisir un Chambre...</option>
						</select>
					@else
						<select class="col-xs-10 col-sm-5" id="chambre" name="chambre" required>
						<option value=" {{ $id_salle }}" >
							{{ App\modeles\Salle::FindOrFail($id_salle)->nom }}
							</option>
						</select>
					@endif	
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Bloquer le Lit : </strong></label>
				<div class="col-sm-9">
				<div class="checkbox">
				            <label>
					               <input type="checkbox" name="etat" value ="1">
				            </label>
				</div>
				</div>
				</div>
				<div>
					<div class="center">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-save bigger-110"></i>
						Enregistrer
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Annuler
					</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	{{-- 	</div> --}}
		</div>
	</div>
@endsection