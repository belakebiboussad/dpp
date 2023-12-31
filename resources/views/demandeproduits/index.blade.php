@extends('app')
@section('title','demandes de produits')
@section('page-script')
 <script>
 	$field ="etat";
 	function getAction(data, type, dataToSet) {
 		var actions = '<a href = "/demandeproduit/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
 	  if(data.etat == "En cours")
    {
      if('{{ Auth::user()->is(14) }}')
 		  {
        actions +=' <a href="/demandeproduit/'+data.id+'/edit" class="btn btn-info btn-xs" title="Modifier Demande"><i class="fa fa-edit fa-xs"></i></a>';
   	   	actions += '<button class="btn btn-xs btn-danger deletedemande" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>';   
   	  }else
        actions +=' <a href="/demandeproduit/run/'+data.id+'" class="btn btn-info btn-xs" title="Traiter Demande"><i class="ace-icon fa fa-cog"></i>';
    }
    return actions;		
 	}
 	function getProdsRequests(field,value)
	{
		$.ajax({
				url : '{{ route("demandeproduit.index") }}',
		 		data: {    
		      	"field":field,
		      	"value":value,
				},
	    	success: function(data) {
	       	$(".numberResult").html(data.length);
	    		$("#demandes_liste").DataTable ({  
	      		 "processing": true,
            	"paging":   true,
            	"destroy": true,
            	"ordering": true,
            	"searching":false,
            	"info" : false,
            	"responsive": true,
            	"language":{"url": '/localisation/fr_FR.json'},
            	"data" : data,
            	"fnCreatedRow": function( nRow, aData, iDataIndex ) {
             		$(nRow).attr('id',"demande-"+aData.id);
            	},
          	  "columns": [
           			{ data: 'date',
                  render: function ( data, type, row ) {
                      return moment(row.date).format('YYYY-MM-DD');
                  }, title:'Date'
                },
           			{ data: 'demandeur.service.nom', title:'Service',"orderable":true,},
          			{ data: "demandeur.nom",
                	render: function ( data, type, row ) {
                  	return row.demandeur.nom + ' ' + row.demandeur.prenom;
                }, title:'Demandeur',"orderable": false
      					},
                { data: 'etat', title:'Etat',"orderable":false,
                  render: function ( data, type, row ) {
                    classe = (row.etat == 'Validée') ? 'success' : 'primary';
                    return '<span class="badge badge-'+ classe +'">' + row.etat +'</span>';
                  }
                },
      					{ data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false
                } 
           		],
	           		"columnDefs": [
                {"targets": 3 ,  className: "dt-body-center" },
         	 			{"targets": 4 ,  className: "dt-body-center" },
         			]
		    	})
		      }
  		})
	}
	$(function(){
  		$(".demandeSearch").click(function(e){
  	 		 getProdsRequests(field,$('#'+field).val().trim());
  		})
  	})
 	$(function(){
		 jQuery('body').on('click', '.deletedemande', function (e) {
		 		event.preventDefault();
      	var demande_id = $(this).val();
        $.ajax({
        		type: "DELETE",
        		url: '/demandeproduit/' + demande_id,
            data: { _token: CSRF_TOKEN } ,
        		success: function (data) {
            			$("#demande-" + demande_id).remove();
        		},
        		error: function (data) {
          			console.log('Error:', data);
        		}
      	});
		})
 	});
</script>
@stop
@section('main-content')
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">Rechercher</div>
		<div class="panel-body">
  	  <div class="row">
    		<div class="col-sm-4">
    			<div class="form-group"><label>Etat</label>
    				<select  id="etat" class="selectpicker show-menu-arrow  form-control filter">
         			<option selected disabled>Selectionner...</option>
         			<option value="">En cours</option>
         			<option value="1">Validée</option><option value="0">Rejetée</option>
         		</select>
       		</div>
       	</div>
       	@if(Auth::user()->is(10))
       	<div class="col-sm-4">
    			<div class="form-group"><label>Service</label>
    			<select  id="service" class="selectpicker show-menu-arrow form-control filter">
    				<option value="">Selectionner...</option>	
    				@foreach ($services as $service)
    					<option value="{{ $service->id }}">{{ $service->nom}}</option>
    				@endforeach
    			</select>
    			</div>
       	</div>
       	@endif
      </div>
    </div>
   	<div class="panel-footer">
		<button type="submit" class="btn btn-sm btn-primary demandeSearch"><i class="fa fa-search"></i>Rechercher</button>
	</div>
  </div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header">
				<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i> Demandes</h5><label><span class="badge badge-info numberResult"></span></label></div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<table id="demandes_liste" class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th class="center">Date</th><th class="center">Service</th>
                    <th class="center">Demandeur</th><th class="center">Etat</th>
                    <th class="center"><em class="fa fa-cog"></em></th>
									</tr>
								</thead>
								<tbody>	
								@if($demandes->count() >0 )
						 		  @foreach($demandes as $demande)
									<tr>
										<td>{{ $demande->date->format('Y-m-d') }}</td>
										<td>{{is_null($demande->id_employe)? '' :$demande->demandeur->Service->nom }}</td>
                    <td>{{ $demande->demandeur->full_name }}</td> 
                    <td class="center">{!! $formatStat
($demande->etat)!!}</td>
                    <td class="center">
										<a href="{{ route('demandeproduit.show', $demande->id) }}" class="btn btn-xs btn-success" title="voir détails"><i class="ace-icon fa fa-hand-o-up"></i></a>
										@if(Auth::user()->is(14))
										<a href="{{ route('demandeproduit.edit',$demande->id) }}" class="btn btn-primary btn-xs{!! $isInprog($demande)!!}" title="Modifier Demande"><i class="fa fa-edit fa-xs"></i></a>
										<a href="{{ route('demandeproduit.destroy',$demande->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger{!! $isInprog($demande)!!}"><i class="fa fa-trash-o"></i></a>
										@endif
										@if(Auth::user()->is(10))
										<a href="{{ route ("runDemande",$demande->id) }}" class="btn btn-xs btn-info" title="Traiter Demande"><i class="ace-icon fa fa-cog"></i></a>
										@endif
										</td>
									</tr>
								@endforeach
								@endif
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
@stop