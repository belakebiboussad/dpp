
@extends('app')
@section('page-script')
 <script type="text/javascript" src="{{ asset('js/app-med.js') }}"></script>
 <script type="text/javascript">
           //ajax pour chercher les patients
            $( document ).ready(function() {
                $('#nomPatient').on('keyup',function(){
                         $value=$(this).val();
                         $.ajax({
                                type : 'get',
                                url : '{{URL::to('searchPatient')}}',
                                data:{'search':$value},
                                success:function(data,status, xhr){
                                    $('tbody').html(data);
                                    var count = xhr.getResponseHeader("count");
                                    $(".numberResult").html(count);
                                }
                           });
                }); 
        });
</script>
@endsection
@section('main-content')
<div class="page-content">
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-12">
		<div class="center">
			<h1 class="blue">
				<strong>Bienvenue Docteur:</strong>
				<q> {{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe }}
				{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}} </q>
			</h1>
		</div>
	</div>		
</div>	{{-- row --}}
<div class="space-12"></div>
<div class="space-12"></div>
<div class="space-12"></div>

<div class="row">
<div class="col-sm-12">
	<div class="col-sm-6">
	<div class="center">{{-- <h4 class="blue">Rechercher d'un Dossier Patient:</h4> --}}
	</div>
	<div class="space-12"></div>
		{{-- <div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="nom">
				 	<strong> 
				 		Nom :
					</strong>
				</label>
				<div class="input-group col-sm-9 " style="width: 350px">
				<input type="text" class="form-controller" id="search" name="search"></input>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="prenom">
				 	<strong> 
				 		Prenom :
					</strong>
				</label>
				<div class="input-group col-sm-9" style="width: 350px">
					<input type="text" id="prenom" name="prenom" placeholder="Prénom..." class="col-xs-12 col-sm-12" autocomplete="on"/>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="datenaissance">
				 	<strong> 
				 		Date Naissance :
					</strong>
				</label>
				<div class="input-group col-sm-9 " style="width: 350px">
					<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
				</div>
			</div>
		</div> --}}
		<div class="row">
			<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Rechercher un  Patient</h3>
			</div>
			<div class="panel-body">
				<div class="form-group   has-feedback">
					<label class="control-label" for="nomPatient" >Nom du Patient :</label>
				           <input type="text" class="form-control" id="nomPatient" name="nomPatient"  placeholder="Rechercher..."/>
					 <span class="glyphicon glyphicon-search form-control-feedback"></span>
				</div>
				
			</div>
		</div>
	</div>
	
</div>
<div class="col-sm-6 offset-sm-1"> 
	<div class="space-12"></div>
	<div class="infobox infobox-green">
		<div class="infobox-icon">
		<i class="ace-icon fa fa-users"></i>
		</div>
		<div class="infobox-data">
			<span class="infobox-data-number">{{ App\modeles\patient::all()->count() }}</span>
			<div class="infobox-content"><b>Patients</b></div>
		</div>
	</div>
	<div class="infobox infobox-blue">
		<div class="infobox-icon">
			<i class="ace-icon fa fa-user-md"></i>
		</div>
		<div class="infobox-data">
			<span class="infobox-data-number">{{ App\modeles\consultation::all()->count() }}</span>
			<div class="infobox-content"><b>Consultations</b></div>
		</div>
	</div>
	<div class="infobox infobox-pink">
		<div class="infobox-icon">
			<i class="ace-icon fa fa-table"></i>
		</div>
		<div class="infobox-data">
			<span class="infobox-data-number">{{ App\modeles\rdv::all()->count() }}</span>
			<div class="infobox-content"><b>Rendez-vous</b></div>
		</div>
	</div>
	<div class="infobox infobox-red">
		<div class="infobox-icon">
			<i class="ace-icon fa fa-hospital-o"></i>
		</div>
		<div class="infobox-data">
			<span class="infobox-data-number">{{ App\modeles\hospitalisation::all()->count() }}</span>
			<div class="infobox-content"><b>Hospitalisations</b></div>
		</div>
	</div>
</div>	
</div>
</div>
{{-- <div class="space-12"></div> --}}
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12 col-sm-offset-0">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-flat widget-header-small">
						<h5 class="widget-title">
						<i class="ace-icon fa fa-user"></i>
						Resultats: </h5> 
						<label for=""><span class="badge badge-info numberResult"> </span>
						</label>
					</div>
					<div>
					<table id="liste_patients" class="table table-striped table-bordered">
							<thead>
							<tr class="info">
							<th colspan="12">Selectionner le patient dans la liste</th>
							</tr>
							<tr>
								<th hidden>id</th>
								<th hidden>code</th>
								<th></th>
								<th>Nom</th>
								<th>Prénom</th>
								<th>Date Naissance</th>
								<th>Sexe</th>
								<th>Age</th>
								<th>Civilité</th>
								<th>Type</th>
								<th></th>
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
</div>
</div>
@endsection