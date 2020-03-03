@extends('app_sur')
@section('main-content')
    <div class="col-xs-12 widget-container-col" id="widget-container-col-1">		
		<div class="col-xs-5 widget-container-col" id="widget-container-col-11">
			<div class="widget-box widget-color-blue" id="widget-box-2">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">
						<i class="ace-icon fa fa-table"></i>
						Liste Des Demandes En attente
					</h5>
				</div>
			</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
							<table id="dynamic-table1" class="table table-striped table-bordered table-hover dataTable no-footer col-xs-12" role="grid" aria-describedby="dynamic-table1_info" >
								<thead>
									<tr role="row">
										<th class="center sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width:10%">
											<label class="pos-rel">
												<input class="ace" type="checkbox">
												<span class="lbl"></span>
											</label>
										</th>
										<th class="sorting" tabindex="0" aria-controls="dynamic-table1" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending" style="width:30%">Patient
													</th>
													<th class="sorting" tabindex="0" aria-controls="dynamic-table1" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width:30%">Motif De La Demande
													</th>
													<th class="hidden-480 sorting" tabindex="0" aria-controls="dynamic-table1" rowspan="1" colspan="1" aria-label="Clicks: activate to sort column ascending" style="width:10%">Degré D'urgence
													</th>
													<th class="sorting" tabindex="0" aria-controls="dynamic-table1" rowspan="1" colspan="1" aria-label="Update: activate to sort column ascending" style="width:20%">
														<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
													Date Demande
												</th>
											</tr>
									</thead>
									<tbody>
										@foreach($demandes as $demande)
										@if($demande->etat == "En attente")
										<tr role="row" class="odd">
											<td class="center">
												<label class="pos-rel">
													<input class="ace" type="checkbox">
													<span class="lbl"></span>
												</label>
											</td>
											<td>
												{{ $demande->Nom }} {{$demande->Prenom }}
											</td>
											<td>{{ $demande->motif }}</td>
											<td class="hidden-480">
												@if($demande->degree_urgence == 'Haut') 
												<span class="label label-sm label-danger"style="color: black;">
													<strong>H</strong>
												</span>
												@elseif($demande->degree_urgence == 'Moyen')
												<span class="label label-sm label-warning"style="color: black;">
													<strong>M</strong>
												</span>
												@else
												<span class="label label-sm label-success"style="color: black;">
													<strong>F</strong>
												</span>
												@endif
											</td>
											<td>{{ $demande->Date_demande }}</td>
										</tr>
									    	@endif
									    	@endforeach
									    </tbody>
									</table>
									<!--<div class="row">
										
											<div class="dataTables_info" id="dynamic-table1_info" role="status" aria-live="polite">Showing 1 to 10 of  13 entries
											</div>
										
										
											<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table1_paginate">
												<ul class="pagination">
													<li class="paginate_button previous disabled" aria-controls="dynamic-table1" tabindex="0" id="dynamic-table1_previous">
														<a href="#">Previous</a>
													</li>
													<li class="paginate_button active" aria-controls="dynamic-table1" tabindex="0">
														<a href="#">1</a>
													</li>
													<li class="paginate_button " aria-controls="dynamic-table1" tabindex="0">
														<a href="#">2</a>
													</li>
													<li class="paginate_button " aria-controls="dynamic-table1" tabindex="0">
														<a href="#">3</a>
													</li>
													<li class="paginate_button next" aria-controls="dynamic-table1" tabindex="0" id="dynamic-table1_next">
														<a href="#">Next</a>
													</li>
												</ul>
											</div>
										
									</div>-->
								</div>
							</div>
						</div>

			<!-- /.span -->
		</div>
		<div class="col-xs-2 widget-container-col" id="widget-container-col-2" >

			
				<div class="hidden-sm hidden-xs action-buttons">
					<a class="blue" href="#" onclick="selctlinge();">
						<i class="ace-icon fa fa-arrow-left bigger-300"></i>
					</a>
				<a class="blue" href="#" onclick="ajouterligne();" >
						<i class="ace-icon fa fa-arrow-right bigger-300"></i>
					</a>
				</div>
			
		</div>
		<div class="col-xs-5 widget-container-col" id="widget-container-col-3">
			<div class="widget-box widget-color-blue" id="widget-box-3">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">
						<i class="ace-icon fa fa-table"></i>
						Selection colloque
					</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
							<table id="dynamic-table2" class="table table-striped table-bordered table-hover dataTable no-footer col-xs-12" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr role="row">
										<th class="center sorting_disabled" rowspan="1" colspan="1" aria-label="">
											<label class="pos-rel">
												<input class="ace" type="checkbox">
												<span class="lbl"></span>
											</label>
										</th>
										<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">Patient
													</th>
													<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">Motif De La Demande
													</th>
													<th class="hidden-480 sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Clicks: activate to sort column ascending">Degré D'urgence
													</th>
													<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Update: activate to sort column ascending">
														<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
													Date Demande
												</th>
												
										</tr>
									</thead>
									<tbody>
										<!--@foreach($demandes as $demande)
										@if($demande->etat == "En attente")
										<tr role="row" class="odd">
											<td class="center">
												<label class="pos-rel">
													<input class="ace" type="checkbox">
													<span class="lbl"></span>
												</label>
											</td>
											<td>
												{{ $demande->Nom }} {{$demande->Prenom }}
											</td>
											<td>{{ $demande->motif }}</td>
											<td class="hidden-480">
												@if($demande->degree_urgence == 'Haut') 
												<span class="label label-sm label-danger"style="color: black;">
													<strong>H</strong>
												</span>
												@elseif($demande->degree_urgence == 'Moyen')
												<span class="label label-sm label-warning"style="color: black;">
													<strong>M</strong>
												</span>
												@else
												<span class="label label-sm label-success"style="color: black;">
													<strong>F</strong>
												</span>
												@endif
											</td>
											<td>{{ $demande->Date_demande }}</td>
										</tr>
									    	@endif
									    	@endforeach-->
									    </tbody>
									</table>
								</div>
							</div>
						</div>

			</div>
		</div>
	</div>
		<!--script-->
<!-- page specific plugin scripts -->
		<script src="{{asset('/js/jquery-2.2.4.js')}}"></script>
		<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('/js/jquery.dataTables.bootstrap.min.js') }}"></script>
		<script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('/js/buttons.flash.min.js') "></script>
		<script src="{{ asset('/js/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('/js/buttons.print.min.js') }}"></script>
		<script src="{{ asset('/js/buttons.colVis.min.js') }}"></script>
		<script src="{{ asset('/js/dataTables.select.min.js') }}"></script>

		<!-- ace scripts -->
		<script src=" {{asset/js/ace-elements.min.js }}"></script>
		<script src="{{ asset/js/ace.min.js }}"></script>
<!-- <script type="text/javascript" src="{{ asset('jquery/jquery.js') }}"></script>	 -->	
<script type="text/javascript">
			
				
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = $('#dynamic-table1')
				myTable.dataTable( {
                paging: true,
                    searching: true
                 } );
				myTable.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				myTable.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					"sScrollY": "100px",
					//"bPaginate": false,
			
					"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection').wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />').find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table1 > thead > tr > th input[type=checkbox], #dynamic-table1_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table1').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table1').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table1 .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
</script> 
<script type="text/javascript">

			//ajouter ligne dans la table colloque
    
     function nouvelleligne(){

		return ('<tr>' +
				'<td></td>' +
				'<td><input type="text" /></td>' +
				'<td><input type="text" /></td>' +
				'<td><input type="text" /></td>' +
				'<td><input type="text" /></td>' +
			'</tr>');
	

	}
	// on creé la première ligne

	/*	var nouvelle_ligne = nouvelleligne(nbligne);
		$(nouvelle_ligne).prependTo("#dynamic-table2");

	// On affiche le nombre de ligne
	$("#result").html("nb ligne = " + nbligne);*/



//var nouvelle_ligne = nouvelleligne();
			//$(nouvelle_ligne).insertAfter(ligne);
//			$(nouvelle_ligne).appendTo("#dynamic-table2");
var table="#dynamic-table2";
	function ajouterligne(){

		// Si c'est la derière ligne	
		//if(ligne.attr('name') == nbligne){
		
			// On insert la nouvelle ligne
			
			var nouvelle_ligne = nouvelleligne();
			//$(nouvelle_ligne).insertAfter(ligne);
			$(nouvelle_ligne).appendTo(table);
		
			// on change la variable nbligne et on l'affiche 
			//$("#result").html("nb ligne = " + nbligne);
		}

	//function selctlinge(){
		write(document.getElementsByTagName('#dynamic-table1')[0].getElementsByTagName('tr')[1].cells[2].innerHTML;);
    //return document.getElementsByTagName('#dynamic-table1')[0].getElementsByTagName('tr')[1].cells[2].innerHTML;

	}
		</script>
	


@endsection
