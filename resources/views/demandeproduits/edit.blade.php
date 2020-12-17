@extends('app')
@section('page-script')
<script>
function getProducts(id_gamme,id_spec=0)
{
	  var html = '<option value="0">Sélectionner...</option>';
	  $.ajax({
	      url : '/getproduits/'+id_gamme+'/'+id_spec,
	      type : 'GET',
	      dataType : 'json',
	      success : function(data){
	      	  $.each(data, function(){
	            html += "<option value='"+this.nom+"'>"+this.nom+"</option>";
	          });
	          $('#produit').html(html);
	      },
	      error : function(){
	          console.log('error');
	      }
	  });
}
$('document').ready(function(){
		$('#gamme').change(function(){
			switch($(this).val())
			{
				case "0":
					$('#specialite').prop('disabled', 'disabled');
					break
				case "1":
					if($("#specialiteDiv").is(":hidden"))
						$("#specialiteDiv").show();
					$("#specialite").removeAttr("disabled");
					$("#produit").removeAttr("disabled");
					break;
				case "2":
					if(!$("#specialiteDiv").hasClass('invisble'))
						$("#specialiteDiv").hide();
					$("#produit").removeAttr("disabled");
					getProducts(2);
					break;
				case "3":
					if(!$("#specialiteDiv").addClass('invisble'))
						$("#specialiteDiv").hide();
					getProducts(3);
					break;
				default:
					break; 
			}
		})
		$('#specialite').change(function(){
			if($(this).val() != "0" )
			{
				$("#produit").removeAttr("disabled");
				var id_gamme = $('#gamme').val();
		  	var id_spec = $(this).val();
	 			getProducts(id_gamme,id_spec);
			}else
				$("#produit").prop('disabled', 'disabled');
	 	});
	 	$("#ajoutercmd").click(function() {
	 		if($('#gamme').val() == "1")
        	$('#cmd').append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td>"+$('#produit').val()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+$('#specialite option:selected').text()+"</td><td class='center'>"+$("#quantite").val()+"</td></tr>");
        else
        	$('#cmd').append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td>"+$('#produit').val()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+"/"+"</td><td class='center'><input type='number' name='qte'	value ='"+$("#quantite").val()+"'></td></tr>");
        $('#produit').val('<option value="0">Sélectionner...</option>');
        $("#quantite").val(1);
        $('#gamme').val('0');
        $('#specialite').val('0');
    });
    $("#validerdmd").click(function(){
    	var arrayLignes = document.getElementById("cmd").rows;
      var longueur = arrayLignes.length;
       var tab = [];
      for(var i=1; i<longueur; i++)
      {
      	var description = $(this).closest("tr").find('description').text(); //second test
      	alert(description)
      	tab[i]=arrayLignes[i].cells[1].innerHTML +" "+arrayLignes[i].cells[2].innerHTML+" "+arrayLignes[i].cells[4].innerHTML;//nom produit+gamme+quantité
  			alert(tab[i]);     	
      
      }
      var champ = $("<input type='text' name ='liste' value='"+tab.toString()+"' hidden>");
      champ.appendTo('#dmdprod');
      //$('#dmdprod').submit();
    });	
});
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Modification de la demande de produit du </strong> &quot;{{ $demande->Date}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Liste Demandes
		</a>
	</div>
</div>
<div class="space-12"></div>
<div class="row">
<div class="col-xs-12">
	<div class="col-xs-12 col-sm-5">
		<div class="widget-box">
			<div class="widget-header"><h4 class="widget-title">produits pharmaceutique</h4></div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
						<form id="dmdprod" method="POST" action="{{ route('demandeproduit.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
						</form>
					<div>
					<label for="gamme"><b>Gamme</b></label>
					<select class="form-control" id="gamme">
						<option value="0">Sélectionner...</option>
						@foreach($gammes as $gamme)
							<option value="{{ $gamme->id }}">{{ $gamme->nom }}</option>
						@endforeach	
					</select>
					<hr/>
				</div>
				<div id = "specialiteDiv">
					<label for="specialite"><b>Spécialité</b></label>
					<select class="form-control" id="specialite" disabled><option value="0">Sélectionner...</option>
						<option value="0">Sélectionner...</option>
						@foreach($specialites as $specialite)
							<option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
						@endforeach	
					</select>
					<hr/>	
				</div>
				<div>
					<label for="produit"><b>Produit</b></label>
					<select class="form-control" id="produit" disabled>
						<option value="">Sélectionner...</option>
					</select>
				</div><hr/>
				<div>
					<label for="quantite"><b>Quantité</b></label>
					<input type="number" class="form-control" id="quantite" name="quantite" min="1">
				</div>
				<hr/>
				<div class="pull right">
					<button id="ajoutercmd" class="btn btn-sm btn-success">
						<i class="ace-icon  fa fa-plus-circle fa-lg bigger-120" style="font-size:18px;"></i><strong>Ajouter</strong>
					</button>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div><!-- /.span -->
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
							<form id="demandform" method="POST" action=""><!-- route('demandeproduit.update') -->
								{{ csrf_field() }}
									<table id="cmd" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th></th>
												<th>Produits</th>
												<th>Gamme</th>
												<th>Spécialité</th>
												<th>Quantité</th>
											</tr>
										</thead>
										<tbody >
											@foreach($demande->medicaments as $medicament)
												<tr>
													<td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td>
													<td>{{ $medicament->nom }}</td>
													<td> Médicament</td>
													<td>{{ $medicament->specialite->nom }}</td>
												  <td><input type="number" id="quantite" class="form-control description" value="{{ $medicament->pivot->qte }}" min=1></td>
												</tr>
											@endforeach
											@foreach($demande->dispositifs as $dispositif)
												<tr>
													<td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td>
													<td>{{ $dispositif->nom }}</td>
													<td>Dispositif médical</td>
													<td>/</td>
													<td><input type="number" id="quantite" class="form-control description" value="{{ $dispositif->pivot->qte }}"></td>
												</tr>
											@endforeach
											@foreach($demande->reactifs as $reactif)
												<tr>
													<td><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td>
													<td>{{ $reactif->nom }}</td>
													<td>Réactifs </td>
													<td>/</td>
													<td>{{ $reactif->pivot->qte }}</td>
													<td><input type="number" id="quantite"class="form-control description" value="{{ $reactif->pivot->qte }}"></td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="hr hr8 hr-double hr-dotted"></div>
								<div class="pull right">
									<button id="validerdmd" class="btn btn-primary">
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