@extends('app')
@section('main-content')
<div class="row">
	<div class="space-6"></div>
	<div class="col-sm-6 infobox-container">
		<div class="infobox infobox-green">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-users"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",4)->get()->count() }}</span>
				<div class="infobox-content"><b>Administrateurs</b></div>
			</div>
		</div>
		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-user-md"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",1)->get()->count() }}</span>
				<div class="infobox-content"><b>Médecine</b></div>
			</div>
		</div>
		<div class="infobox infobox-pink">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-medkit"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",3)->get()->count() }}</span>
				<div class="infobox-content"><b>Infermier</b></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-calendar"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",2)->get()->count() }}</span>
				<div class="infobox-content"><b>Agent de reception</b></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-flask"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",5)->get()->count() }}</span>
				<div class="infobox-content"><b>Surveillant médical</b></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-flask"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",6)->get()->count() }}</span>
				<div class="infobox-content"><b>Colloques</b></div>
			</div>
		</div>
		<div class="space-6"></div>
		<label>
			<b>Total des utilisateurs :</b> <strong class="blue">{{ App\User::all()->count() }}</strong>
		</label>
	</div>
	<div class="vspace-12-sm"></div>
	<div class="col-sm-6 infobox-container">
		<div class="infobox infobox-green">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-users"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\service::all()->count() }}</span>
				<div class="infobox-content"><b>Services</b></div>
			</div>
		</div>
		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-user-md"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\salle::all()->count() }}</span>
				<div class="infobox-content"><b>Salles</b></div>
			</div>
		</div>
		<div class="infobox infobox-pink">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-medkit"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\Lit::all()->count() }}</span>
				<div class="infobox-content"><b>Lits</b></div>
			</div>
		</div>
		<div class="space-6"></div>
	</div>
</div><!-- /.row -->
<hr>
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="widget-box transparent">
			<div class="widget-body">
					<div>
						<table id="users" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="center">#</th>
									<th>Username</th>
									<th>E-mail</th>
									<th>Role</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $index => $user)
									<tr>
										<td class="center">{{ $index+1 }}</td>
										<td class="center">{{ $user->name }}</td>
										<td class="center">{{ $user->email }}</td>
										<td class="center">
											{{ App\modeles\rol::where("id",$user->role_id)->get()->first()->role }}
										</td>
										<td class="center">
											<a href="{{ route('users.show', $user->id) }}" class="btn btn-white btn-inverse btn-sm">
												Détails
											</a>
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
@endsection
