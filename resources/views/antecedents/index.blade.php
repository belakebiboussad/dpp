@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;"><strong>Liste des antécédents du :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
	</div>
	<table id="simple-table" class="table  table-bordered table-hover">
		<thead>
			<tr>
				<th class="detail-col">Description</th>
				<th>Type</th>
				<th>Date</th>
				<th class="hidden-480">Sous type </th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($atcds as $atcd)
			<tr>
				<td class="center">
					<div class="action-buttons">
						<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
							<i class="ace-icon fa fa-angle-double-down"></i>
							<span class="sr-only">Détails</span>
						</a>
					</div>
				</td>
				<td>
					<a href="#">{{ $atcd->Antecedant }}</a>
				</td>
				<td>{{ $atcd->date }}</td>
				<td class="hidden-480">{{ $atcd->typeAntecedant  }}</td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<a href="{{route('atcd.show',$atcd->id)}}" class="btn btn-xs btn-success">
							<i class="ace-icon fa fa-sign-in bigger-120"></i>
							Afficher
						</a>
						<a href="{{route('atcd.edit',$atcd->id)}}" class="btn btn-xs btn-info">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
							Modifier
						</a>
						<a href="{{route('atcd.destroy',$atcd->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
							<i class="ace-icon fa fa-trash-o bigger-120"></i>
							Supprimer
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
								<h1><strong>Description de l'antécédent</strong></h1>
								<p class="lead">
									{{$atcd->description}}
								</p>
							</div>
						</div>
					</div>
				</td>
			</tr>
			@endforeach
	</table>
@endsection