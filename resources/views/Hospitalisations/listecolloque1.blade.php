@extends('app_sur')
@section('main-content')
<form id="coll" class="form-horizontal" role="form" method="POST" action="{{route('colloque.store')}}">{{ csrf_field() }} 
<div class="col-xs-12 page-header"><h1>liste Colloque de la semaine</h1></div><!-- /.page-header -->	
<div class="col-xs-12">
	<select id="elt" multiple="multiple" name="elt[]" hidden=""></select>
	<select id="demh" multiple="multiple" name="demh[]" hidden=""></select>
	<div class="col-xs-6">
		<select id="liste_membre" data-placeholder="sélectionner les membres..."  style="width: 400px "></select>
	</div>
	<div class="col-xs-6"><textarea id="choix_membre" style="width: 500px" resize="none" readonly ></textarea></div>
	<div class="col-xs-12 widget-container-col" id="widget-container-col-1">
	<div class="col-xs-5 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste Des demandes d'hoqpitalisation :</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class='table_borderWrap'>
						<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
							<thead class="thin-border-bottom">
								<tr>
									<th style="display: none;"></th>
									<th class="center"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></th>
									<th class="detail-col">Patient</th><!--<th class="detail-col">Details</th>-->
									<th>Motif De La Demande</th>
									<th>Degré/date</th><!--<th>Date Demande</th>-->	
								</tr>
							</thead>
							<tbody>
								@foreach( $demandes as $demande)
								<tr>
									<td style="display: none;">{{$demande->id}}</td>
									<td class="center"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></td>
									<td >
										<div class="action-buttons">
											<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
												<i class="ace-icon fa fa-angle-double-down"></i><span class="sr-only">Details</span>
											</a> {{ $demande->Nom}} {{$demande->Prenom}}
										</div>
									</td>
									<td>{{ $demande->motif }}</td>
									<td>@if($demande->degree_urgence == 'Haut')
										<span class="label label-sm label-danger"style="color: black;"><strong>H</strong></span>
										@elseif($demande->degree_urgence == 'Moyen')
										<span class="label label-sm label-warning"style="color: black;"><strong>M</strong></span>
										@else
										<span class="label label-sm label-success"style="color: black;"><strong>F</strong></span>
										@endif <br/>{{ $demande->Date_demande }}
									</td>
								</tr>
								<tr class="detail-row">
									<td colspan="8">
										<div class="table-detail">
											<div class="row">
												<div class="col-xs-7 col-sm-7">
													<div class="space visible-xs"></div>
													<div class="profile-user-info profile-user-info-striped">
														<div class="profile-info-row">
															<div class="profile-info-name"> Patient </div>
															<div class="profile-info-value">
																<span>{{ $demande->Nom}} {{$demande->Prenom}}</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Age</div>
															<div class="profile-info-value">
																<span>{{Jenssegers\Date\Date::parse($demande->Dat_Naissance)->age }} ans</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">Service </div>
															<div class="profile-info-value"><span>{{$demande->service}}</span></div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">  	Specialité </div>
															<div class="profile-info-value"><span>{{$demande-> specialite}}</span></div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">Motif</div>
															<div class="profile-info-value"><span>{{$demande->motif}}</span></div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Date de demande</div>
															<div class="profile-info-value"><span>{{$demande->Date_demande}}</span></div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">  	Degree d'urgence</div>
															<div class="profile-info-value">
																<span>@if($demande->degree_urgence == 'Haut')
																	<span class="label label-sm label-danger"style="color: black;"><strong>H</strong>
																	</span>
																	@elseif($demande->degree_urgence == 'Moyen')
																	<span class="label label-sm label-warning"style="color: black;"><strong>M</strong>
																	</span>
																	@else
																	<span class="label label-sm label-success"style="color: black;"><strong>F</strong>
																	</span>
																@endif</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xs-5 col-sm-5">
													<div class="space visible-xs"></div>
													<h4 class="header blue lighter less-margin">Description</h4>
													<div class="space-6"></div>
													<form>
														<fieldset><textarea class="width-100" resize="none" readonly>{{$demande->description}}</textarea>
														</fieldset>
													</form>
												</div>
											</div>
										</div>
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
	<div class="col-xs-2 widget-container-col" id="widget-container-col-3" >
		<div class="hidden-sm hidden-xs action-buttons">
			      @for ($i = 0; $i < 10; $i++)
                  <br/>
                  @endfor
			<a class="blue" href="#" onclick="suppligne();"><i class="ace-icon fa fa-arrow-left bigger-300"></i></a>
			<a class="blue" href="#" onclick="ajouterligne();" ><i class="ace-icon fa fa-arrow-right bigger-300"></i></a>
		</div>
		
	</div>
	<div class="col-xs-5 widget-container-col" id="widget-container-col-4">
		<div class="widget-box widget-color-blue" id="widget-box-4">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des hoqpitalisations à programmer cette semaine</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class='table_borderWrap'>
						<table class="table table-striped table-bordered table-hover" id="table2" aria-describedby="table2_info" role="grid">
							<thead class="thin-border-bottom">
								<tr >
									<th style="display: none;"></th>
									<th class="center"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></th>
									<th class="detail-col">Patient</th><!--<th class="detail-col">Details</th>-->
									<th>Motif De La Demande</th>
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
</form>
</div>
<script type="text/javascript">
	//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table1 header checkbox
				var active_class = 'active';
				$('#table1 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row table1 when the checkbox is checked/unchecked
				$('#table1').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
				//add horizontal scrollbars to a simple table
			/*	$('#table1').css({'width':'50px', 'max-width': 'none'}).wrap('<div style="width: 50px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 50,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');*/

				//select/deselect all rows according to table2 header checkbox
				
				$('#table2 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table2 header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#table2').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
				//add horizontal scrollbars to a simple table
				/*$('#table2').css({'width':'50px', 'max-width': 'none'}).wrap('<div style="width: 50px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 50,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');*/
</script>	

<script type="text/javascript">
	var active_class = 'active';
	var id_demh= new Array();
	function ajouterligne(){
		var lignes=	new Array();
		
		lignes=document.getElementById("table1").getElementsByTagName("tr");
		//seling=ling.getElementsByClassName("active");

		for(var i=0;i<lignes.length;i++){
			if (lignes[i].className=='active')
				{
					lignes[i].classList.remove(active_class);
					var col=lignes[i].getElementsByTagName("td");
					console.log(col[0].innerHTML);
					id_demh.push(col[0].innerHTML);
					console.log(id_demh);
					$(lignes[i]).appendTo('#table2');
					
				}
			}
      /////////////
      $('#table2 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table2 header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#table2').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
  
		lignes=null;

	}
	function suppligne(){
		var lignes=	new Array();
		
		lignes=document.getElementById("table2").getElementsByTagName("tr");
		//seling=ling.getElementsByClassName("active");

		for(var i=0;i<lignes.length;i++){
			if (lignes[i].className=='active')
				{   //désactivé la ligne
					lignes[i].classList.remove(active_class);
					//décocher le checkbox
					$(lignes[i].getElementsByTagName("td")).find('input[type=checkbox]').checked=false;
      $(lignes[i]).appendTo('#table1'); 

      
  }
    
			
		}lignes=null;
	}


	var choix= new Array();
	$( "#liste_membre" )
  .change(function () {
    var select = document.getElementById("liste_membre");
    var choice = select.selectedIndex;
    var valeur = select.options[choice].value;
    var texte = select.options[choice].text;
    if (document.getElementById("choix_membre").value.search(texte)==-1 ) {
    //select.options[choice].disabled="true";
   	choix.push(valeur);    
    document.getElementById("choix_membre").value +=texte+"\n";	
    }
    else{texte=texte+"\n"
    	document.getElementById("choix_membre").value=document.getElementById("choix_membre").value.replace(texte,"");
    	choix.pop(valeur);
    	
    }
   // hselect.val(valeur);
    
    
  });
		

	 function recup(){
     return (choix);
      
	}
	function recup1(){
     return (id_demh);
      
	}
	$('#coll').submit(function(ev) {
    ev.preventDefault(); // to stop the form from submitting
    /* Validations go here */
    var sel=document.getElementById("elt");
    for (var i =0; i <choix.length ; i++) {
    	sel.options[sel.options.length] = new Option (choix[i], choix[i],false,true);
    }
    console.log(sel.options.length);
    sel=document.getElementById("demh");
    for (var i =0; i <id_demh.length ; i++) {
    	sel.options[sel.options.length] = new Option (id_demh[i], id_demh[i],false,true);
    	    }console.log(sel.options.length);

    this.submit(); // If all the validations succeeded
});
</script>		
@endsection