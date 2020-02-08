@extends('app_med')
@section('main-content')
<div class="page-header">
	<h1>Liste Des Consultation Pour : {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Les Informations Du Patient :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<label class="inline">
						<span class="blue"><strong>Nom Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Nom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Prénom Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Prenom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Sexe Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Homme" : "Femme" }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Date Naissance Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Dat_Naissance }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Age Du Patient :</strong></span>
						<span class="lbl"> {{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">La Liste Des Consultations :</h4>
			</div>
			<br/>
			<table id="simple-table" class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th class="detail-col">Résumé</th>
						<th>Motif de consultation</th>
						<th>Date de consultation</th>
						<th class="hidden-480">Médecin traitant</th>
						<th><em class="fa fa-cog"></em></th>
					</tr>
				</thead>
				<tbody>
					@foreach($consultations as $consultation)
						<tr>
							<td class="center">
								<div class="action-buttons">
									<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
										<i class="ace-icon fa fa-angle-double-down"></i>
										<span class="sr-only">Details</span>
									</a>
								</div>
							</td>
							<td>
								<span>{{ $consultation->Motif_Consultation }}</span>
							</td>
							<td>{{ $consultation->Date_Consultation }}</td>
							<td class="hidden-480">
								{{ App\modeles\employ::where("id", $consultation->Employe_ID_Employe)->get()->first()->Nom_Employe }}
								{{ App\modeles\employ::where("id", $consultation->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
							</td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<a href="{{route('consultations.show',$consultation->id)}}" class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-sign-in bigger-120"></i>
										Afficher
									</a>
									<a href="#" class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
										Modifier
									</a>
								</div>
					<div class="hidden-md hidden-lg">
						<div class="inline pos-rel">
							<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
								<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
							</button>
							<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
								<li>
									<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
										<span class="blue">
											<i class="ace-icon fa fa-search-plus bigger-120"></i>
										</span>
									</a>
								</li>
								<li>
									<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
										<span class="green">
											<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
										</span>
									</a>
								</li>
								<li>
									<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
										<span class="red">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
			<tr class="detail-row">
				<td colspan="8">
					<div class="table-detail">
						<div class="row">
							<div class="col-xs-12 col-sm-2">
								<div class="text-center">
									<img height="150" width="160" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="{{asset('/avatars/atcds.jpg')}}" />
									<br/>
								</div>
							</div>
							<div class="col-xs-12 col-sm-7">
								<div class="space visible-xs"></div>
								<h1><strong>Résumé de consultation :</strong></h1>
								<p class="lead">
									{{ $consultation->Resume_OBS }}
								</p>
							</div>
						</div>
					</div>
				</td>
			</tr>
			@endforeach
			</tbody>	
	</table>
</div></div>
</div>
@endsection