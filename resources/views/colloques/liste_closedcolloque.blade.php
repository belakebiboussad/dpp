@extends('app_dele')
@section('title','Colloque')
@section('page-script')
@endsection

@section('main-content')
<div id="" class="col-xs-12"></div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-1"><br/>
    <div class="col-xs-12 widget-container-col" id="widget-container-col-12">
    	<div class="widget-box widget-color-blue" id="widget-box-12">
    		<div class="widget-header">
		    	<h3 class="widget-title bigger lighter">
		      	<i class="ace-icon fa fa-table"></i>
						<strong>Liste Des Colloques {{ ($type == 1) ? 'Médicaux ' : 'Chirurgicaux' }}</strong>
	        </h3>
		    </div>
		    <div class="widget-body">
		    	<div class="widget-main no-padding">
						<div class='table_borderWrap'>
							 	<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
								  <thead class="thin-border-bottom">
		                <tr>
		                  <th><h4><strong>colloque de semaine du</strong></h4></th>
											<th><h4><strong>Date du colloque</strong></h4></th>
											<th><h4><strong>Membres</strong></h4></th>
											<th><h4><strong>Les demandes validées</strong></h4></th>
							      </tr>
		              </thead>
		              <tbody id ="colloquesBody" class="bodyClass">
		              @foreach( $colloque as $cle=>$col)
		              <tr>
		              	<td>
											<?= date('d M Y',strtotime($col["dat"].' monday next week')-1);?>
										</td>
										<td>
												{{$col["dat"]}}
										</td>
										<td>
											@foreach($col["membres"] as $i=>$m)
												<p class="text-primary">
													{{ $col["membres"][$i] }}</p>
												</p>
					    				@endforeach
										</td>
									  <td>
									  	@foreach($demandes as $j=>$demande)
									  			@if($demande->id_colloque == $col["id"])
									  				{{ $demande->id_demande }}
									  			@endif
									  	@endforeach
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
  </div>
</div>
@endsection