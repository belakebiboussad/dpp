@extends('app')
@section('page-script')
<script>
$('document').ready(function(){
	$("#ajoutercmd").click(function(){
    if($('#gamme').val() == "1")
    {
      $('#cmd').append("<tr><td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td hidden>"+$("#produit").val()+"</td><td>"+$("#produit option:selected" ).text()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+$('#specPrd option:selected').text()+"</td><td><input type='number' class='form-control' name='qte' value ='"+$("#quantite").val()+"'></td><td><input type='text' class='form-control' name='unite' value ='"+$("#unite").val()+"'></td></tr>");
      
    }else
    {
      $('#cmd').append("<tr><td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td hidden>"+$("#produit").val()+"</td><td>"+$( "#produit option:selected" ).text()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+"/"+"</td><td><input type='number' class='form-control' name='qte' value ='"+$("#quantite").val()+"'></td><td><input type='number' class='form-control' name='qte' value ='"+$("#unite").val()+"'></td></tr>");
    }
    $('#produit').val('');$("#quantite").val(1);$('#gamme').val('');$('#specPrd').val('');
    $("#ajoutercmd").prop('disabled', true);
  }); 
	$("#updatedmd").click(function(){
    		var tb = $('#cmd tbody');
  		  var produits = [];
  		  tb.find("tr").each(function(index, element) {
  	  		var jsonData = {};
  		  	$(element).find('td').each(function(index1, element) {
  		  		switch(index1){
						case 1:
							jsonData ["produit"]= $(element).text();
		    			break;
			    	case 3:
		    			jsonData["gamme"] = $(element).text();
		    			break;
			    	case 5:
			    		jsonData["qte"] = $(element).find('input').val() ;
		    			break;
				case 6:
              jsonData["unite"] = $(element).find('input').val() ;
              break;
        default:				
		    			break;	
		    			}
      		  	});
 			 		produits.push(jsonData);
  		  });
  			var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(produits)+"' hidden>");
				champ.appendTo('#demandform');
     		$('#demandform').submit();
	});
});
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1>Modification de la demande du &quot;{{ $demande->date->format('Y-m-d')}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-white btn-info">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>Demandes</a>
	</div>
</div><div class="space-12"></div>
<div class="row">
<div class="col-xs-12">
	<div class="col-xs-12 col-sm-5">@include("demandeproduits.partials._widgetAdd")</div>
	<div class="col-xs-12 col-sm-7">
		<div class="widget-box">
			<div class="widget-header">
			   <h4 class="widget-title">Produits demandés</h4>
				<div class="widget-toolbar">						
					<a id="deletepod" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o"></i></a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
					<div>
  				<form id="demandform" method="POST" action="{{ route('demandeproduit.update',$demande->id)}}">
  					{{ csrf_field() }}
  					{{ method_field('PUT') }}
  					<table id="cmd" class="table table-striped table-bordered">
  						<thead>
								<tr>
									<th></th><th>Produits</th><th>Gamme</th><th>Spécialités</th><th>Quantité</th><th>Unité</th>       
                </tr>
							</thead>
							<tbody >
							@foreach($demande->medicaments as $key=>$medicament)
							<tr>
								<td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td>
								<td hidden>{{ $medicament->id }}</td><td>{{ $medicament->nom }}</td>
								<td> MEDICAMENTS</td><td>{{ $medicament->specialite->nom }}</td>
								<td><input type="number" id="quantite" class="form-control" value="{{ $medicament->pivot->qte }}" min=1></td>
                <td><input type="text" id="unite" class="form-control" value="{{ $medicament->pivot->unite }}" ></td>
  						</tr>
  						@endforeach
							@foreach($demande->dispositifs as $dispositif)
							<tr>
								<td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td hidden>{{ $dispositif->id }}</td><td>{{ $dispositif->nom }}</td>
								<td>DISPOSITIFS MEDICAUX</td><td>/</td>
								<td><input type="number" id="quantite" class="form-control" value="{{ $dispositif->pivot->qte }}"></td>
                <td><input type="text" id="unite" class="form-control" value="{{ $dispositif->pivot->unite }}" ></td>
							</tr>
							@endforeach
							@foreach($demande->reactifs as $reactif)
							<tr>
								<td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td hidden>{{ $reactif->id }}</td><td>{{ $reactif->nom }}</td>
								<td>Réactifs chimiques et dentaires</td><td>/</td>
								<td><input type="number" id="quantite"class="form-control" value="{{ $reactif->pivot->qte }}"></td>
                <td><input type="text" id="unite" class="form-control" value="{{ $reactif->pivot->unite }}" ></td>
							</tr>
							@endforeach
              @foreach($demande->consomables as $consom)
                <tr>
                  <td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td hidden>{{ $consom->id }}</td><td>{{ $consom->nom }}</td>
                  <td>Produits consommables de Labo</td><td>/</td>
                  <td><input type="number" id="quantite"class="form-control" value="{{ $consom->pivot->qte }}"></td>
                    <td><input type="text" id="unite" class="form-control" value="{{ $consom->pivot->unite }}" ></td>
                </tr>
              @endforeach
							</tbody>
						</table>
							</div>
							<div class="hr hr8 hr-double hr-dotted"></div>
							<div class="pull right">
								<button id="updatedmd" class="btn btn-primary">
									 <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
								</button>
							</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.span -->
	</div>
</div>
@endsection