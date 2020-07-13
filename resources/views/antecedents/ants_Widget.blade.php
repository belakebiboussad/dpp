<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Antecedants</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<div class="fa fa-plus-circle"></div>
				<a href=""><b>Antecedant </b></a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="detail-col">Description</th>
							<th class="center">Type</th>
							<th class="center">Date</th>
							<th class="hidden-480">Sous Type </th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($patient->antecedants as $atcd)
					<tr>
						<td class="center">
							<div class="action-buttons">
								<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
									<i class="ace-icon fa fa-angle-double-down"></i>
									<span class="sr-only">Details</span>
								</a>
							</div>
						</td>
						<td>
							<a href="#">{{ $atcd->Antecedant }}</a>
						</td>
						<td>{{ $atcd->date }}</td>
						<td class="hidden-480">{{ $atcd->typeAntecedant  }}</td>
						<td class="center">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="{{route('atcd.show',$atcd->id)}}" class="btn btn-xs btn-success">
									<i class="ace-icon fa fa-sign-in bigger-120"></i>
								</a>
								<a href="{{route('atcd.edit',$atcd->id)}}" class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
									
								</a>
								<a href="{{route('atcd.destroy',$atcd->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
									
								</a>
							</div>
							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
									</button>
									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
												<span class="blue">
													<i class="ace-icon fa fa-search-plus bigger-120"></i>
												</span>
											</a>
										</li>
										<li>
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>
										<li>
											<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<tr class="detail-row">
						<td colspan="8">
							<div class="table-detail">
								<div class="row">
									<div class="col-xs-12 col-sm-2">
										<div class="text-center">
											<img height="150" width="160" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="{{asset('/avatars/atcds.jpg')}}" />
											<br/>
										</div>
									</div>
									<div class="col-xs-12 col-sm-7">
										<div class="space visible-xs"></div>
										<h4><strong>Description de l'antécédant</strong></h4>
										<p class="lead">
											{{$atcd->descrioption}}
										</p>
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