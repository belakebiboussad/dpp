@extends('app')
@section('title','Gestion des Utilisateures')
@section('page-script')
<script>
$( document ).ready(function() {
 $('#userName').on('keyup',function(){
    value=$(this).val();
    $.ajax({
    type : 'get',
    url : '{{URL::to('searchUser')}}',
    data:{'search':value},
    success:function(data,status, xhr){
        $('tbody').html(data);
        var count = xhr.getResponseHeader("count");
        $(".numberUser").html(count);
    }
});
  });
});
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-sm-6">
		<div class="space-12"></div>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading"><h3><strong>Rechercher un utilisateur:</strong></h3></div>
				<div class="panel-body">
					<div class="form-group   has-feedback">
						<label class="control-label" for="userName" >Nom de l'utilisateur:</label>
						    <input type="text" class="form-control" id="userName" name="userName"  placeholder="Rechercher..."/>
						    <span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="col-sm-6 ">
	<div class="space-12"></div>
	<div class="col-sm-12 infobox-container">
		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-user-md"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",1)->get()->count() }}</span>
				<div class="infobox-content"><b>Médecins</b></div>
			</div>
		</div>
		<div class="infobox infobox-pink">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-medkit"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",3)->get()->count() }}</span>
				<div class="infobox-content"><b>Infirmiers</b></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-calendar"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",2)->get()->count() }}</span>
				<div class="infobox-content"><b>Agents de réception</b></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-flask"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\User::where("role_id",5)->get()->count() }}</span>
				<div class="infobox-content"><b>Surveillants médicaux</b></div>
			</div>
		</div>
		<div class="space-12"></div>
	</div>
	<div class="space-12-sm"></div>
	</div>
</div>{{-- row --}}
<hr>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5 class="widget-title"><i class="ace-icon fa fa-user"></i><strong> Résultats</strong>: </h5> 
				<label for=""><span class="badge badge-info numberUser"></span></label>
			</div>
			<div class="widget-body">
					<div>
						<table id="user" class="table table-striped table-bordered" role="grid">
							<thead>
								<tr class="success"><th colspan="12">Selectionner l'utilisateur dans la liste</th></tr>
								<tr>
									<th class="center">#</th>
									<th hidden>id</th>
									<th class="center"><strong style="font-size:16px;">Nom d'utilisateur</strong></th>
									<th class="center"><strong style="font-size:16px;">E-mail</strong></th>
									<th class="center"><strong style="font-size:16px;">Rôle</strong></th>
									<th class="center"><strong style="font-size:16px;">Acive</strong></th>
									<th class="center"><em class="fa fa-cog"></em></th>
								</tr>
							</thead>
							<tbody>	
							</tbody>
						</table>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection
