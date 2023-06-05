<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Antécédents personnels</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th  class="center" width="8%">Type </th>
							<th class="center" width="10%">Date</th>
							 <th class="center" width="8%">Code CIM10</th>
							<th class="detail-col">Description</th>
							<th class="center" width="8%"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<?php $j = 0; ?>
						@foreach($patient->antecedants as $i=>$atcd)
							@if($atcd->Antecedant == "Personnels")
						  <tr id="{{ 'atcd'.$atcd->id }}">
								<td class="">{{( $atcd->typeAntecedant == '0') ? 'Pathologiques':'Physiologiques'}}</td>
								<td>{{ $atcd->date }}</td><td>{{ $atcd->cim_code }}</td>
								<td ><p>{{ $atcd->description}}</p></td>
							 	 <td class="center">
							  	@if($atcd->Antecedant == "Personnels")
							  	<a href="#" class="green bigger-140 show-details-btn" title="Afficher Details" data-toggle="collapse" data-target=".{{$i}}collapsed"><i class="ace-icon fa fa-eye-slash"></i><span class="sr-only">Details</span></a>
								@endif
								<div class="action-buttons hidden-sm hidden-xs btn-group">
								<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{ $atcd->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
								</div>
								</td>
							</tr>
						<?php $j++ ?>
			    			<tr class="collapse out budgets {{$i}}collapsed">
			      			<td colspan="12">
				    			<div class="table-detail">
				     				<div class="row">
				     				@if($atcd->typeAntecedant == '0')
				     				<div class="col-xs-6 col-sm-6"><div class="space visible-xs"></div>
									<div class="profile-user-info profile-user-info-striped">
										<div class="profile-info-row"><div class="profile-info-name center">Type </div>
										<div class="profile-info-value"><span class="label label-lg label-inverse arrowed-in">{{ $atcd->stypeatcd }}</span>
									       </div>
										</div>
									</div>
								</div>
					     			@else
					     			<div class="col-xs-12 col-sm-12"><div class="space visible-xs"></div>
									<div class="profile-user-info profile-user-info-striped">
										<div class="profile-info-row">
											<div class="profile-info-value col-xs-1 col-sm-1"> <label>
		        								<input type="checkbox" class="ace"  {{ ($atcd->tabac) ? "checked" :"" }} disabled />
			            								<span class="lbl" > tabac</span>
			            							</label>
											</div>
											<div class="profile-info-value  col-xs-2 col-sm-2">
											  <label>
								            			<input type="checkbox" class="ace"  {{ ($atcd->ethylisme)? "checked" :"" }} disabled/><span class="lbl"> ethylisme</span></label>
								            		</div>
											<div class="profile-info-name center col-xs-2 col-sm-2">Habitudes Alimentaires</div>
											<div class="profile-info-value col-xs-6 col-sm-6"><p>{{ $atcd->habitudeAlim }}</p> </div>
					         	 			</div>
									</div>
								</div>
								@endif
											</div>
								</div>
							</td>
						</tr>
						<?php $j++ ?>
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-green">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Antécédents Familiaux</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
					<tr>
						<th class ="hidden"></th>
						<th class="center" width="10%"><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>Date</th>
						<th class="center" width="8%">Code CIM</th>
						<th class="center">Description</th>
						<th class="center" width="8%"><em class="fa fa-cog"></em></th>
					</tr>
					</thead>
					<tbody>
						<?php $j = 0; ?>
						@foreach($patient->antecedants as $antcd)
							@if($antcd->Antecedant == "Familiaux")
							  <tr id="{{ 'atcd'.$antcd->id }}">
								<td>{{ $atcd->date }}</td><td>{{ $atcd->cim_code }}</td>
								<td><p>{{$atcd->description}}</p></td>
							 	  <td class="center">
							  		<div class="action-buttons hidden-sm hidden-xs btn-group">
										<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{ $atcd->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
									  </div>
								</td>
							</tr>	
							@endif
			  		@endforeach 
					</tbody>
				</table>
			</div>
		</div><!-- widget-body -->
	</div>
</div>