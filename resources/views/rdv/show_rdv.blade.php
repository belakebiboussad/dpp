@extends('app_recep')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="space-6"></div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
					<h3 class="widget-title grey lighter">
						<i class="ace-icon fa fa-calendar blue"></i>
							Détails RDV :
					</h3>
						

					<div class="widget-toolbar no-border invoice-info">
						<a href="{{ route('rdv.index') }}" class="btn btn-white">
						<i class="fa fa-list-ul"></i>
							Liste Rendez-Vous
						</a>
						@if (Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->Date_RDV->format('Y-m-d H:i:s'))))
						<a href="{{route('order.pdf',$rdv->id)}}" class="btn btn-white">
							<i class="ace-icon fa fa-print"></i>
							Imprimer recu
						</a>
						@endif
					</div>

					
					</div>
					<div class="widget-body">
					<div class="widget-main padding-24">
					<div class="row">
						<div class="col-sm-12">
						<div class="row">
						<div class="col-sm-11 label label-lg label-info arrowed-in arrowed-right">
							<b>
							<span class="invoice-info-label"><strong>Patient :</strong></span>
							{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Nom}}
							{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Prenom}}
							</b>
						</div>
						</div>
						<div  class="row">
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Nom :</strong>
								<b class="blue">
								{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Nom}}
								</b>
							</li>
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Prénom :</strong>
								<b class="blue">
								{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Prenom}}
								</b>
							</li>
							<li>
							<i class="ace-icon fa fa-caret-right blue">	       </i><strong>Sexe :</strong>
								<b class="blue">
								{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Sexe =="M" ? "Homme" : "Femme"}}
												</b>
							</li>
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><strong>Date Naissance :</strong>
								<b class="blue">
								{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Dat_Naissance}}
								</b>
							</li>
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i>
								<strong>Phone  :</strong>
								<b class="blue">
								{{App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->tele_mobile1}}
								</b>
							</li>
							{{-- <li class="divider"></li> --}}

						</ul>
						</div>
						</div><!-- /.col -->		
					</div><!-- /.row -->
					<div class="space"></div>
					<div class="row">
						<div class="col-sm-11 label label-lg label-success arrowed-in arrowed-right">
							<strong>
							<span class="invoice-info-label">Rendez-vous</span>
							</strong>
						</div>
					</div>	{{-- row --}}
					<div class="row">
						<ul class="list-unstyled spaced">
						<li>
						<i class="ace-icon fa fa-caret-right blue"></i>
						<strong>Date RDV :</strong>
					 	<string class="red">{{ \Carbon\Carbon::parse($rdv->Date_RDV)->format('Y-m-d') }}
					 	</strong>
						</li>
						<li>
							<i class="ace-icon fa fa-caret-right blue"></i>
							<strong>Etat RDV :</strong>
							<b class="red">{{$rdv->Etat_RDV }}</b>
							</li>
						</ul>
					</div>	{{-- row --}}
					<div class="row">
						
					</div>
				</div>	{{-- widget-main --}}
				</div>	{{-- widget-body --}}
				<hr>
				<div class="widget-footer widget-footer-large right">
					@if (Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->Date_RDV->format('Y-m-d H:i:s'))))	
					<a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-success btn-bold">
						<i class="fa fa-edit bigger-120 blue"></i>
								Modifier
					</a>
					<a href="{{route('rdv.destroy',$rdv->id)}}" class="btn btn-danger btn-bold" data-method="DELETE" data-confirm="Etes Vous Sur pour Annuler le RDV ?">
						<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>Supprimer
					</a>	
					@endif
					<a href="{{ route('rdv.index') }}" class="btn btn-info btn-bold">
						<i class="fa fa-undo bigger-120 blue"></i>
								Annuler
					</a>
				</div>
				{{-- @include('flash::message') --}}
			</div>	{{-- transparent --}}
			</div>	{{-- col-sm-offset-1 --}}
		</div>	{{-- col-xs-6 --}}
	</div>	{{-- col-xs-12 --}}
	</div>{{-- row --}}
{{-- 	</div>
</div> --}}
@endsection