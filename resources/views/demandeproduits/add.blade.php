@extends('app')
@section('title','Créer une demande')
@section('page-script')
<script>
function enableDestry()
{
	if($("input:checked").length >= 1)
	{
		if($('#deletepod').is('[disabled=disabled]'))
		  	$('#deletepod').attr("disabled",false);
	}else
	{
		if(!$('#deletepod').is('[disabled=disabled]'))
			 $('#deletepod').attr("disabled", true);	
	}
}
$('document').ready(function(){
 	$("#ajoutercmd").click(function(){
 		if($('#gamme').val() == "1")
			$('#cmd').append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace' id='chk[]' onClick='enableDestry()'/><span class='lbl'></span></label></td><td hidden>"+$("#produit").val()+"</td><td>"+$("#produit option:selected").text()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+$('#specialite option:selected').text()+"</td><td class='center'>"+$("#quantite").val()+"</td>"+"</td><td class='center'>"+$("#unite").val()+"</tr>");
		else
		  $('#cmd').append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace' id='chk[]' onClick='enableDestry()'/><span class='lbl'></span></label></td><td hidden>"+$("#produit").val()+"</td><td>"+$("#produit option:selected").text()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+$('#specialite option:selected').text()+"</td><td class='center'>"+$("#quantite").val()+"</td>"+"</td><td class='center'>"+$("#unite").val()+"</tr>");
    $('#produit').val('');$("#quantite").val(1);$('#gamme').val('');$('#specialite').val('');
		$("#ajoutercmd").prop('disabled', true);
  });	
	$("#savedmd").click(function(){
		var arrayLignes = document.getElementById("cmd").rows;
		var longueur = arrayLignes.length;   
		var produits = [];
		for(var i=1; i<longueur; i++)
		{
			produits[i] = { produit: arrayLignes[i].cells[1].innerHTML, gamme: arrayLignes[i].cells[3].innerHTML, qte: arrayLignes[i].cells[5].innerHTML, unite: arrayLignes[i].cells[6].innerHTML}
		}
		var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(produits)+"' hidden>");
		champ.appendTo('#demandform');
		$('#demandform').submit();
	});
});
</script>
@endsection
@section('main-content')
<div class="row">
<div class="col-xs-12">
	<div class="col-xs-12 col-sm-5">
		<div class="widget-box">
			<div class="widget-header"><h4 class="widget-title">Sélectionner un produit</h4></div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
						<form id="dmdprod" method="POST" action="{{ route('demandeproduit.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
						</form>
					<div>
					<label for="gamme" class="control-label">Gamme :</label>
					<select class="form-control" id="gamme">
						<option value="" disabled>Sélectionner...</option>
						@foreach($gammes as $gamme)
							<option value="{{ $gamme->id }}" {{($gamme->id == 1) ? 'slected' :'' }}>{{ $gamme->nom }}</option>
						@endforeach	
					</select>
					<hr/>
				</div>
				<div id = "specialiteDiv">
					<label for="specPrd" class="control-label">Spécialité :</label>
					<select class="form-control" id="specPrd">
						<option value="" slected disabled>Sélectionner...</option>
						@foreach($specialites as $spec)
							<option value="{{ $spec->id }}">{{ $spec->nom }}</option>
						@endforeach	
					</select>
					<hr/>	
				</div>
				<div>
					<label for="produit" class="control-label">Produit :</label>
					<select class="form-control" id="produit">
						<option value="" selected disabled>Sélectionner...</option>
					</select>
				</div><hr/>
				<div>
					<label for="quantite" class="control-label">Quantité :</label>
					<input type="number" class="form-control" id="quantite" name="quantite" min="1">
				</div>
				<hr/>
				<div>
					<label for="unite" class="control-label">Unité :</label>
					<input type="text" class="form-control" id="unite" name="unite" palceholder="Unité">
				</div>
				<hr/>
				<div class="pull right">
					<button id="ajoutercmd" class="btn btn-sm btn-success" disabled>
						<i class="ace-icon fa fa-plus-circle fa-lg bigger-120"></i>Ajouter</button>
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
				<div class="widget-toolbar"><a id="deletepod" class="btn btn-xs btn-danger" disabled><i class="ace-icon fa fa-trash-o"></i></a></div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
						<div>
							<form id="demandform" method="POST" action="{{ route('demandeproduit.store') }}">
								{{ csrf_field() }}
								<table id="cmd" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th></th>
											<th>Produits</th>
											<th>Gamme</th>
											<th>Spécialité</th>
											<th>Quantité</th>
											<th>Unité</th>
										</tr>
									</thead>
									<tbody >
									</tbody>
								</table>
							  </div><div class="hr hr8 hr-double hr-dotted"></div>
								<div class="pull right">
									<button id="savedmd" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110" style="font-size:18px;"></i>Enregistrer
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