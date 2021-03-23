<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Antecedants Personnels</h5>
			<div class="widget-toolbar widget-toolbar-light no-border"><!-- <div class="fa fa-plus-circle"></div><a href=""><b>Antecedant </b></a> -->
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th  width="8%">Type </th>
							<th class="center" width="6%">Date</th>
							 <th class="center">Code CIM</th>
							<th class="detail-col"class="">Description</th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<?php $j = 0; ?>
						@foreach($patient->antecedants as $i=>$atcd)
							@if($atcd->Antecedant == "Personnels")
						  <tr id= "{{ $j }}">
								<td class="">{{( $atcd->typeAntecedant == '0') ? 'Pathologiques':'Physiologiques'}}</td>
								<td>{{ $atcd->date }}</td>
								<td>{{ $atcd->cim_code }}</td>
								<td class="center">
									 <textarea class="width-100" resize="none"disabled="">{{$atcd->descrioption}} </textarea>
							  	</td>
							 	 <td class="center">
							  	@if($atcd->Antecedant == "Personnels")
							  	<a href="#" class="green bigger-140 show-details-btn" title="Afficher Details" data-toggle="collapse" id="{{$i}}" data-target=".{{$i}}collapsed">
										<i class="ace-icon fa fa-eye-slash"></i><span class="sr-only">Details</span>&nbsp;
									</a>
									@endif
									<div class="action-buttons hidden-sm hidden-xs btn-group">
										{{--<a href="{{route('atcd.show',$atcd->id)}}" class="btn btn-xs btn-success"><i class="ace-icon fa fa-hand-o-up bigger-120"></i>&nbsp;
										</a>&nbsp;&nbsp; <a href="{{route('atcd.edit',$atcd->id)}}" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>--}}
										<a href="{{route('atcd.destroy',$atcd->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</a>
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
														<div class="profile-info-row">
															<div class="profile-info-name text-center"><strong>Type:</strong></div>
															<div class="profile-info-value"><span class="label label-lg label-inverse arrowed-in">{{ $atcd->stypeatcd }}</span>
															</div>
														</div>
													</div>
												</div>
					     					@else
					     					<div class="col-xs-12 col-sm-12"><div class="space visible-xs"></div>
													<div class="profile-user-info profile-user-info-striped">
														<div class="profile-info-row">
															<div class="profile-info-name text-center col-xs-1 col-sm-1"><strong>Tabac:</strong></div>
															<div class="profile-info-value col-xs-1 col-sm-1">
															  <label>
			            								<input type="checkbox" class="ace"  id="tabac" name="tabac" {{ ($atcd->tabac) ? "checked" :"" }} disabled />
			            								<span class="lbl" >&nbsp; &nbsp;tabac</span>
			            							</label>&nbsp; &nbsp; &nbsp;
															</div>
															<div class="profile-info-name text-center col-xs-1 col-sm-1"><strong>ethylisme:</strong></div>
															<div class="profile-info-value  col-xs-1 col-sm-1">
														 		<label>
								            			<input type="checkbox" class="ace" id="ethylisme" name="ethylisme" {{ ($atcd->ethylisme)? "checked" :"" }} disabled/>
								            			<span class="lbl"> &nbsp; &nbsp;ethylisme</span>
							        					</label>
															</div>
															<div class="profile-info-name text-center col-xs-2 col-sm-2"><strong>Habitudes Alimentaires:</strong></div>
															<div class="profile-info-value col-xs-6 col-sm-6">
					         	 						<textearea>{{ $atcd->habitudeAlim }}</textearea>
												 			</div>
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
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-green" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Antecedants Familliaux</h5>
			<div class="widget-toolbar widget-toolbar-light no-border"><!--<div class="fa fa-plus-circle"></div><a href=""><b>Antecedant </b></a> -->
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class ="hidden"></th>
							<th class="center" width="6%"><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i><strong>&nbsp;<span style="font-size:14px;">Date</span></strong></th>
							<th class="center">Code CIM</th>
							<th class="detail-col"class="">Description</th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<?php $j = 0; ?>
						@foreach($patient->antecedants as $antcd)
							@if($antcd->Antecedant == "Familiaux")
							  <tr id="{{ 'atcd'.$antcd->id }}">
									<td>{{ $atcd->date }}</td>
									<td>{{ $atcd->cim_code }}</td>
									<td class="center"><textarea class="width-100" resize="none"disabled="">{{$atcd->descrioption}}</textarea></td>
							 	  <td class="center">
							  		<div class="action-buttons hidden-sm hidden-xs btn-group">
											{{-- <a href="{{route('atcd.show',$atcd->id)}}" class="btn btn-xs btn-success"><i class="ace-icon fa fa-hand-o-up bigger-120"></i>&nbsp;
											</a>&nbsp;&nbsp;<a href="{{route('atcd.edit',$atcd->id)}}" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>--}}
											<a href="{{route('atcd.destroy',$atcd->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
												<i class="ace-icon fa fa-trash-o bigger-120"></i>
											</a>
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