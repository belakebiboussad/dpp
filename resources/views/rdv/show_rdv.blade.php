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
							<a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-white btn-info btn-bold">
								<i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>
									Modifier le RDV
							</a>
							<br/>
							<a href="{{route('rdv.destroy',$rdv->id)}}" class="btn btn-white btn-warning btn-bold" data-method="DELETE" data-confirm="Etes Vous Sur pour Annuler le RDV ?">
								<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
									Annuler le RDV
							</a>	
						</div>
						<div class="widget-toolbar hidden-480">
							<a href="{{route('order.pdf',$rdv->id)}}">
								<i class="ace-icon fa fa-print"></i>
								Imprimer récu RDV
							</a>
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
									<div>
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
												<i class="ace-icon fa fa-caret-right blue"></i><strong>Sexe :</strong>
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
											<li class="divider"></li>
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i>
													<strong>Date RDV :</strong>
													<b class="red">{{$rdv->Date_RDV }}</b>
											</li>
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i>
													<strong>Etat RDV :</strong>
													<b class="red">{{$rdv->Etat_RDV  }}</b>
											</li>
										</ul>
									</div>
								</div><!-- /.col -->		
							</div><!-- /.row -->
							<div class="space"></div>
							<hr>
							{{-- @include('flash::message') --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection