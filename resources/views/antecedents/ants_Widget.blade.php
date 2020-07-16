<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Antecedants</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<!-- <div class="fa fa-plus-circle"></div>
				<a href=""><b>Antecedant </b></a> -->
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center" width="10%">Type</th>
							<th  width="8%">Type </th>
							<th class="center" width="6%">Date</th>
							<th class="hidden-480 detail-col"class="">Description</th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<?php $j = 0; ?>
						@foreach($patient->antecedants as $i=>$atcd)
						<tr id= "{{ $j }}">
							<td><a href="#">{{ $atcd->Antecedant }}</a></td>
							<td class="">{{ $atcd->typeAntecedant  }}</td>
							<td>{{ $atcd->date }}</td>
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
									<a href="{{route('atcd.show',$atcd->id)}}" class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-sign-in bigger-120"></i>&nbsp;<!-- fa fa-angle-double-down -->
									</a>&nbsp;&nbsp;
		 							<a href="{{route('atcd.edit',$atcd->id)}}" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
									<a href="{{route('atcd.destroy',$atcd->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</a>
								</div>
							</td>
						</tr>
						@if($atcd->Antecedant == "Personnels")
						<?php $j++ ?>
			    	<tr class="collapse out budgets {{$i}}collapsed">
			      	<td colspan="12">
				    		<div class="table-detail">
				     			<div class="row">
					     			<div class="col-xs-6 col-sm-6">
											<div class="space visible-xs"></div>
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name text-center"><strong>Type:</strong></div>
													<div class="profile-info-value">
														  <span class="label label-lg label-inverse arrowed-in">{{ $atcd->stypeatcd }}</span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name text-center"><strong>Tabac:</strong></div>
													<div class="profile-info-value">
														 <!--  <span class="label label-lg label-inverse arrowed-in">{{ $atcd->tabac }}</span> -->
														 <label>
	            								<input type="checkbox" class="ace"  id="tabac" name="tabac" {{ ($atcd->tabac) ? "checked" :"" }} disabled />
	            										<span class="lbl" >&nbsp; &nbsp;tabac</span>
	        									</label>&nbsp; &nbsp; &nbsp;
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-6 col-sm-6">
											<div class="space visible-xs"></div>
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name text-center"><strong>Habitudes Alimentaires:</strong></div>
													<div class="profile-info-value">
			         	 						<textearea>{{ $atcd->habitudeAlim }}</textearea>
										 			</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name text-center"><strong>ethylisme:</strong></div>
													<div class="profile-info-value">
												 		<label>
								            			<input type="checkbox" class="ace" id="ethylisme" name="ethylisme" {{ ($atcd->ethylisme)? "checked" :"" }} disabled/>
								            			<span class="lbl"> &nbsp; &nbsp;ethylisme</span>
								        		</label>
													</div>
												</div>
											</div>
										</div>
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