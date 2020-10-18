@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h4 class="widget-title grey lighter">
			<i class="ace-icon fa fa-calendar blue"></i> &nbsp;Détails RDV
		</h4> 	
		<div class="pull-right">
			<a href="{{ route('rdv.index') }}" class="btn btn-white">
				<i class="fa fa-list-ul"></i>Liste Rendez-Vous
			</a>
			@if (Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->Date_RDV->format('Y-m-d H:i:s'))))
			<a href="{{route('order.pdf',$rdv->id)}}" class="btn btn-white">
				<i class="ace-icon fa fa-print"></i>Imprimer recu
			</a>
			@endif
	  </div>
	</div>
	<div class="row">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-large">
				<div class="widget-toolbar no-border invoice-info">
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main padding-24">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-11 label label-lg label-info arrowed-in arrowed-right">
							<span class="invoice-info-label"><strong>Information du patient</strong></span>
							</div>
						</div>
					</div>
					<div  class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Nom :</strong>
								<b class="blue">{{ $rdv->patient->Nom }}</b>
							</li>
						</ul>
					</div>
					<div  class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Prenom :</strong>
								<b class="blue">{{ $rdv->patient->Prenom }}</b>
							</li>
						</ul>
					</div>
					<div  class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Genre :</strong>
								<b class="blue">{{ $rdv->patient->sexe =="M" ? "Masculin" : "Féminin" }}</b>
							</li>
						</ul>
					</div>
					<div class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Date Naissance :</strong>
								<b class="blue">{{ $rdv->patient->Dat_Naissance }}</b>
							</li>
						</ul>
					</div>
					<div class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Télephone:</strong>
								<b class="blue">{{ $rdv->patient->tele_mobile1 }}</b>
							</li>
						</ul>
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-11 label label-lg label-success arrowed-in arrowed-right">
						<span class="invoice-info-label">	<strong>Rendez-vous</strong></span>
						</div>
					</div>
					<div class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Date RDV :</strong>
								<b class="red">{{ $rdv->Date_RDV->format('Y-m-d') }}</b>
							</li>
						</ul>
					</div>
					<div class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Etat RDV :</strong>
								{{--
							@if (Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->Date_RDV->format('Y-m-d H:i:s'))))	
						 	@endif
							--}}
									@if(isset($rdv->Etat_RDV))
											@switch($rdv->Etat_RDV)
												@case(0)
       										<span class="label label-sm label-danger"><b>Annuler</b></span>
        								 	@break
        								@case(1)
        									<span class="label label-sm label-success"><b>Valider</b></span>
        									@break
        								@default
        									<span class="label label-sm label-success"><b>{{ $rdv->Etat_RDV }}</b></span>
        									@break
											@endswitch
										@else
											<span class="label label-sm label-warning">En Cours</span>
										@endif
							</li>
						</ul>
					</div>
				</div>	
			</div>{{-- widget-body --}}
			<hr>
			<div class="widget-footer widget-footer-large right">
				<div class="col-sm-12">
{{--@if (Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->Date_RDV->format('Y-m-d H:i:s'))))@endif
					--}}
					@if(!(isset($rdv->Etat_RDV)))
					  <a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-success btn-bold">
						<i class="fa fa-edit bigger-120 blue"></i>&nbsp;Modifier
					 	</a>
				  	<a href="{{route('rdv.destroy',$rdv->id)}}" class="btn btn-danger btn-bold" data-method="DELETE" data-confirm="Etes Vous Sur pour Annuler le RDV ?">
						<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>&nbsp;Annuler
						</a>		
					 @endif <!-- 'rdv.index' -->
					 	<a href="{{ route('patient.show',$rdv->patient->id) }}" class="btn btn-info btn-bold">
							<i class="ace-icon fa fa-close bigger-110"></i>&nbsp;Fermer
						</a>
					</div>	
			</div>
		</div>	
	</div>
@endsection