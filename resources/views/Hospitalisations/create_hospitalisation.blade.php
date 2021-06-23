@extends('app_sur')
@section('main-content')
	<div class="row"><h3> <strong>{{dd($demande)}}
			Ajouter un rendez-vous d'hospitalisation :{{ $demande->id }}</strong>
		</h3>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">		
			<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
				{{ csrf_field() }}
				<input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="date">
					 	<strong> 
					 		Date entrée : 
						</strong>
					</label>
					<div class="col-sm-9">
						<input class="col-xs-10 col-sm-5 date-picker" id="date" name="date" type="text" placeholder="Date Hospitalisation" data-date-format="yyyy-mm-dd" />
					</div>				
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="date">
					 	<strong> 
					 		Date de sortie prévue : 
						</strong>
					</label>
					<div class="col-sm-9">
						<input class="col-xs-10 col-sm-5 date-picker" id="dateprevu" name="dateprevu" type="text" placeholder="Date Prévue Pour Sortir" data-date-format="yyyy-mm-dd" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong> 
							Motif d'hospitalisation :
						</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{ $demande->motif }}" class="col-xs-10 col-sm-5" disabled/>
					</div>
				</div>

					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Enregistrer
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Annuler
						</button>
					</div>
			</form>
		</div>
	</div>
@endsection