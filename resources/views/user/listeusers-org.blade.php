@extends('app')
@section('page-script')
	 $('#users').dataTable();
@endsection
@section('title','Gestion des Utilisateures')
@section('main-content')
<div class="page-header">
	<h1>Liste Des Utilisateurs :</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div>
						<table id="users" class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Rôle</th>
							<th>Ajouter Un Utlisateur</th>
						</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								<span class="label label-important arrowed-in">
									{{ App\modeles\rol::where("id", $user->role_id)->get()->first()->role }}
								</span>
							</td>
							<td class="center">
							<div class="hidden-sm hidden-xs action-buttons">
                   						<a class="blue" href={{ route('users.show', $user->id) }}">
                        					<i class="ace-icon fa fa-search-plus bigger-130"></i>
                    						</a>
                    						@if( App\modeles\rol::where("id", $user->role_id)->get()->first()->role != "administrateur")
                    						<a class="green" href="{{ route('users.edit',$user->id) }}">
                        					<i class="ace-icon fa fa-pencil bigger-130"></i>
                    						</a>
                    						<a class="red" href="#">
                       					<i class="ace-icon fa fa-trash-o bigger-130"></i>
                    						</a>
                    						@endif
                						</div>
							</td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection