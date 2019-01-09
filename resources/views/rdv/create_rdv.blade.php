@extends('app_recep')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;">
		<strong>RDV Pour Le Patient :</strong> 
		{{ $patient->Nom }} {{ $patient->Prenom }}
	</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div id="main-widget-container">
			<div class="row">
				<div class="col-xs-8 widget-container-col" id="widget-container-col-1">
					<div class="widget-box" id="rdv">
						<div class="widget-header">
							<h5 class="widget-title"><b>Informations patient :</b></h5>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
									<div class="col-xs-12">
										<label class="inline">
											<span><b>Nom :</b></span>
											<span class="lbl blue">{{ $patient->Nom }}</span>
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="inline">
											<span><b>Prénom :</b></span>
											<span class="lbl blue">{{ $patient->Prenom }}</span>
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="inline">
											<span><b>Date de naissance :</b></span>
											<span class="lbl blue">{{ $patient->Dat_Naissance }}</span>
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="inline">
											<span><b>Séxe :</b></span>
											<span class="lbl blue">
												{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}
											</span>
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="inline">
											<span><b>Age :</b></span>
											<span class="lbl blue">
												{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans
											</span>
										</label>
										<hr>
										<form role="form" method="POST" action="{{route('rdv.store')}}">
										{{ csrf_field() }}
										<label for="date"><b>Date :</b></label>
										<input type="text" name="id_patient" value="{{$patient->id}}" hidden>
										<div class="row">
											<div class="col-xs-3{{ $errors->has('daterdv') ? "has-error" : "" }}">
												<div class="input-group">
													<input class="form-control date-picker" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</div>
											<div>
												<button type="submit" class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-calendar-o"></i>
													Valider rdv
												</button>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection