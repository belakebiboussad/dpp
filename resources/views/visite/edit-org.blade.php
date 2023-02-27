@extends('app_inf')
@section('main-content')
<div class="page-header"><h1>Liste Des Consignes :</h1></div>
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-11">
				@if(session()->has('message'))
           <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
			</div>
			@foreach($hosp->visites as $visite)
				@foreach($visite->actes as $cle=>$acte)
					@if($acte->type =="paramedicale")
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $acte->id }}">
										<i class="ace-icon fa fa-edit" data-icon-hide="ace-icon fa fa-edit" data-icon-show="ace-icon fa fa-edit"></i>&nbsp;{{$acte->nom}}
										<div align="right">
											@if($acte->fait) 	
										  	<i class="glyphicon glyphicon-ok" data-icon-hide="glyphicon glyphicon-ok" data-icon-show="glyphicon glyphicon-ok"></i>
										  	<a>	&nbsp;{{$acte->fait}} </a>                 
										  @else
										    <i class="glyphicon glyphicon-remove" data-icon-hide="glyphicon glyphicon-remove" data-icon-show="glyphicon glyphicon-remove"></i>
	              				<span class="blue"> Non</span>
	              			@endif

										</div> 
									</a>
							</h4>
					</div>
					<div class="panel-collapse collapse" id="collapse{{ $acte->id }}">
						<div class="panel-body">
							@if(!($acte->fait))
							<form method="POST" action="/surveillances/store/{{ $acte->id}}" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="text" value="{{$acte->id}}" hidden="true" name="idActe">
								<input type="text" value="{{$acte->id_visite}}" hidden="true" name="idvis">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="motifcons">
											<strong>Date :</strong>
										</label>
										<div class="col-sm-9">
											<input type="text" name="datesur" class="form-control date-picker" id="id-date-picker-1"  data-date-format="yyyy-mm-dd" />
										</div>
									</div>	
								</div>
								<div class="space-12"></div>
								<div class="row">
									<div class="form-group">
									  <label class="col-sm-3 control-label no-padding-right" for="motifcons">
												<strong>Heure :</strong>
										</label>
										<div class="col-sm-9">
											<div class="input-group bootstrap-timepicker">
											<input id="timepicker1" name="heuresur" type="text" class="form-control" />
												<span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span>
											</div>
										</div>
								  </div>
								</div><div class="space-12"></div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="motifcons">
											<strong>Appliquée :</strong>
										</label>
										<div class="col-sm-9">
											<input type="radio" id="Oui" name="ap" value="Oui">
	                 		<label for="oui">Oui</label>
		                  <input type="radio" id="Non" name="ap" value="Non">
	                    <label for="non">Non</label>
									  </div>
								  </div>
								</div><div class="space-12"></div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="description">
											<strong>Description:</strong>
										</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="description" name="desc" placeholder="Description"></textarea>
										</div>
									</div>
								</div><div class="space-12"></div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="description">
											<strong>Observation:</strong>
										</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="obs" name="obs" placeholder="Observation"></textarea>
										</div>
									</div>	
								</div>
							</form>
							@endif
						</div>
					</div>
				</div>
				@endif
			@endforeach
			@endforeach
		</div>
	</div>
</div>
@endsection