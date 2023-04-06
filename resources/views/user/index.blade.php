@extends('app')
@section('title','Gestion des Utilisateures')
@section('page-script')
<script>
var field = 'name';
$(document).ready(function(){
	$(document).on('click','.findUser',function(event){
		event.preventDefault();
		$('#Controls').removeClass('hidden');
	  $.ajax({
     		type : 'get',
      	url : '{{ route("users.index") }}',
     		data:{'field':field,'value':($('#'+field).val())},
     		success:function(data,status, xhr){
     			$('#btnCreate').removeClass('hidden');
     			$('#'+field).val('');
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
	   	 		  	{ data: 'role.role', title:'Rôle' },
	   	 		   	{data: null, title:'Compte',
	   	 		  		render : function(data, type, row){
	   	 		  			if ( type === 'display' )
	   	 		  			{
	   	 		  				var html = (data.active) ? '<span class="label label-sm label-success">active</span>':'<span class="label label-sm label-danger">desactivé</span>';
	   	 		  				return html;
	   	 		  			}
	   	 		  			return data
	   	 		  		} 
	   	 		  	},
	   	 		  	{ data:null,title:'<em class="fa fa-cog"></em>',"orderable": false, searchable: false,
	   	 		  		"render": function(data,type,full,meta){
					    		if ( type === 'display' ) {
					    			return '<a onclick ="getUserdetail('+data.id+')" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume"><i class="fa fa-eye-slash fa-xs"></i></a>&nbsp;'+
                     '<a href = "/users/'+data.id+'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter"><i class="fa fa-hand-o-up fa-xs"></i></a>&nbsp;'+
                      '<a href ="/users/'+data.id+'/edit" class="btn btn-info btn-xs" data-toggle="tooltip" title="Modifier"><i class="fa fa-edit fa-xs"></i></a>'; 		
                  }
					    		return data;	
								}
							}
	   	 		  ],
	   	 		  "columnDefs": [
	   	 		    {"targets": 2 ,  className: "dt-head-center" },
			   			{"targets": 3 ,  className: "dt-head-center" ,	"orderable":false },
			   			{"targets": 4 ,  className: "dt-head-center" ,	"orderable":false },
			   			{"targets": 5 ,  className: "dt-head-center" ,	"orderable":false },
			   			{"targets": 6 ,  className: "dt-head-center", className: "dt-head-center dt-body-center"},
	   	 		  ]

      		});
      	}
      });			
	});
});
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
@stop
@section('main-content')
<div class="page-content">
	<div class="row">
	  <div class ="pull-left">	
			<h4>Bienvenu(e): <q class="blue">{{ Auth::User()->employ->full_name }}</q></h4>
		</div>		
	</div><div class="space-12"></div>
	<div class="row panel panel-default">
		<div class="panel-heading left">Rechercher un utilisateur</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
	  	    <div class="form-group">
		  	    <label class="control-label">Nom</label>
		  	    <div class="input-group col-sm-10">
							<input type="text" class="form-control input-xs autoUserfield filter" id="name" name="name"  placeholder="Nom de l'utilisateur"/>
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>
	  	    </div>
	  	  </div>
	  	  <div class="col-sm-4">
	  	    <div class="form-group">
		  	    <label class="control-label">Rôle</label>
		  	    <div class="input-group col-sm-10">
							<select class="form-control input-xs filter" name="role_id" id="role_id">
								<option value="" selected>Selectionner...</option>
								@foreach ($roles as $role)
									<option value="{{ $role->id }}">{{ $role->role }}</option>
								@endforeach
							</select>
						</div>
	  	    </div>
	  	  </div>
		  	<div class="col-sm-4">
		      <div class="form-group col-sm-12">
		       	<label class="control-label">Service</label>
						<div class="input-group col-sm-10">
							<select class="form-control input-xs filter" name="service_id" id="service_id">
								<option value="" selected>Selectionner...</option>
								@foreach ($services as $service)
								<option value="{{ $service->id }}">{{ $service->nom }}</option>
								@endforeach
				  		</select>
				  	</div>
				  </div>
				</div>
	  	</div>			   
		</div>
		<div class="panel-footer">
			<button type="submit" class="btn btn-sm btn-primary findUser"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
			<div class="pull-right">
				<a class="btn btn-primary btn-sm hidden" href="users/create" id="btnCreate" role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-7">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5 class="widget-title"><i class="ace-icon fa fa-user"></i> Résultats: </h5> 
				<label for=""><span class="badge badge-info numberUser"></span></label>
			</div>
			<div class="widget-body">
				<table id="users" class="table table-striped table-bordered table-responsive" role="grid">
				<tbody>	
				</tbody>
				</table>
			</div>
	  </div>
		</div>{{-- col-sm-7 --}}
		<div class="col-sm-5" id="userDetail"></div>
	</div>
  </div>

@stop