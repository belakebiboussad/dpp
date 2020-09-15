@extends('app')
@section('title','Gestion des Utilisateures')
@section('page-script')
<script>
function XHRgetUser()
{
	value=$('#name').val();
	if(value == "") 
	 	value="*";			
	$('#Controls').removeClass('hidden');
	$.ajax({
     		type : 'get',
      	url : '{{URL::to('searchUser')}}',
     		data:{'search':value},
     		success:function(data,status, xhr){//$('tbody').html(data);
      	  $(".numberUser").html(Object.keys(data).length);
      		$("#users").DataTable ({
      			"processing": true,
	  				"paging":   true,
	  				"destroy": true,
	  				"ordering": true,
	    			"searching":false,
	    			"info" : false,
	    			"language":{"url": '/localisation/fr_FR.json'},
	   	 		  "data" : data,
	   	 		  "columns": [
	   	 		  	{ data:null,title:'#', "orderable": false,searchable: false,
	   	 		  		render: function ( data, type, row ) {
							            if ( type === 'display' )
							            	return '<input type="checkbox" class="editor-active check" name="" value="'+data.id+'" onClick="" /><span class="lbl"></span> ';
							         		return data;
							 	},
							  className: "dt-body-center",
	   	 		  	},
	   	 		  	{ data:'id',title:'ID', "visible": false},
	   	 		  	{ data: 'name', title:'Nom' },
	   	 		  	{ data: 'email', title:'E-Mail' },
	   	 		  	{ data: 'role_id', title:'Rôle' },
	   	 		  	{ data: 'active', title:'Compte' },
	   	 		  	{ data:null,title:'<em class="fa fa-cog"></em>',"orderable": false, searchable: false,
	   	 		  		"render": function(data,type,full,meta){
									    		if ( type === 'display' ) {
									    			return  '<a href = "/users/'+data.id+'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter le dossier"><i class="fa fa-hand-o-up fa-xs"></i></a>'+
															'&nbsp;<a href ="/users/'+data.id+'/edit" class="btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs"></i></a>'+
															 '&nbsp;<a onclick ="getUserdetail('+data.id+')" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du patient"><i class="fa fa-eye fa-xs"></i></a>';
							      	   		}
									    		return data;	
								}
							}
	   	 		  ],
	   	 		  "columnDefs": [
	   	 		    {"targets": 2 ,  className: "dt-head-center" },
			   			{"targets": 3 ,  className: "dt-head-center" ,	"orderable":false },
			   			{"targets": 4 ,  className: "dt-head-center" ,	"orderable":false },
			   			{"targets": 4 ,  className: "dt-head-center" },
			   			{"targets": 4 ,  className: "dt-head-center", className: "dt-head-center dt-body-center"},
	   	 		  ]

      		});
      	}
      });
}
function getUserdetail(id)
{	  
  $.ajax({
          type : 'get',
          url : '{{URL::to('userdetail')}}',
         data:{'search':id},
         success:function(data,status, xhr){
         		$('#userDetail').html(data.html);
         }
  });	
}
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row">
	  <div class="col-sm-12 center">	
			<h2><strong>Bienvenue :</strong>
				<q class="blue"> {{ Auth::User()->employ->Nom_Employe }} &nbsp;{{ Auth::User()->employ->Prenom_Employe }}  </q>
			</h2>
		</div>		
	</div>	{{-- row --}}
	<div class="space-12"></div>
	<div class="row panel panel-default">
		<div class="panel-heading left">
			<strong>Rechercher un Utilisateur</strong><div class="pull-right"></div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
	  	    <div class="form-group">
		  	    <label class="control-label" for="name"><strong>Nom:</strong></label>
		  	    <div class="input-group col-sm-10">
							<input type="text" class="form-control input input-xs col-sm-12 autoUserfield" id="name" name="name"  placeholder="nom du l'utilisateur"/>
						</div>
	  	    </div>
	  	  </div>
	  	  <div class="col-sm-4">
	  	    <div class="form-group">
		  	    <label class="control-label" for="userRole"><strong>Rôle:</strong></label>
		  	    <div class="input-group col-sm-10">
							<input type="text" class="form-control input input-xs" id="userRole" name="userRole"  placeholder="Rôle du l'utilisateur"/>
						</div>
	  	    </div>
	  	  </div>
	  	</div>			   
		</div>
		<div class="panel-footer" style="height: 50px;">
			<button type="submit" class="btn-sm btn-primary" onclick="XHRgetUser();"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
			<div class="pull-right">
				<a class="btn btn-primary btn-sm hidden" href="users/create" role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-7">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5 class="widget-title"><i class="ace-icon fa fa-user"></i>Resultats: </h5> 
				<label for=""><span class="badge badge-info numberUser"></span></label>
			</div>
			<div class="widget-body">
				<div>
				<table id="users" class="table table-striped table-bordered table-responsive" role="grid">
				<tbody>	
				</tbody>
				</table>
				</div>	{{-- div --}}
			</div>
	  </div>
		</div>{{-- col-sm-7 --}}
		<div class="col-sm-5" id="userDetail"></div>
	</div>
  </div>

@endsection