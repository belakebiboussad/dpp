@extends('app')
@section('title','Créer une demande')
@section('main-content')
<div class="row">
<div class="col-xs-12">
	<div class="col-xs-12 col-sm-5">@include("demandeproduits.partials._widgetAdd")</div>  
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
											<th class="center">#</th><th class="center">Produits</th><th class="center">Gamme</th><th class="center">Spécialité</th><th class="center">Quantité</th><th class="center">Unité</th>
										</tr>
									</thead>
									<tbody ></tbody>
								</table>
							  </div><div class="hr hr8 hr-double hr-dotted"></div>
								<div class="pull right">
									<button id="savedmd" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
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
@stop
@section('page-script')
@include('demandeproduits.partials.scripts')
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
$(function(){
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
@stop