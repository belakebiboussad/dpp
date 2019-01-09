@extends('app_recep')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;">
		<strong>Reporter rendez-vous Pour :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}
	</h1>
</div>
<div class="col-xs-12">
	<form class="form-horizontal" role="form" action="/rdv/storereporte/{{$rdv->id}}" method="POST">
		{{ csrf_field() }}
		<div class="col-xs-12 widget-container-col" id="widget-container-col-1">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">Informations du patient</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<fieldset>
									<label><b>Nom : </b><span class="blue">{{ $patient->Nom }}</span></label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<label><b>Prénom : </b><span class="blue">{{ $patient->Prenom }}</span></label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<label><b>Date naissance : </b>
										<span class="blue">{{ $patient->Dat_Naissance }}</span>
									</label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<label><b>Lieu naissance : </b>
										<span class="blue">{{ $patient->Lieu_Naissance }}</span>
									</label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<label><b>Sexe : </b>
										<span class="blue">{{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
									</label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<label><b>Age : </b>
										<span class="blue">
											{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans
										</span>
									</label>
								</fieldset>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
			<div class="col-xs-12 widget-container-col" id="widget-container-col-1">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-inline">
									<label class="inline">
										<span class="lbl"><b>Reporter le rendez-vous vers :</b></span>
										<input class="date-picker" id="daterdv" type="text" name="daterdv" value="{{$rdv->Date_RDV }}" data-date-format="yyyy-mm-dd" required/>
									</label>
									<button type="submit" class="btn btn-info btn-sm">
										<i class="ace-icon fa fa-calendar bigger-110"></i>Reporter
									</button>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</form>	
</div>
@endsection