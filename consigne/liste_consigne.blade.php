@extends('app_infirm')
@section('main-content')
<div class="page-header">
		<h1 style="display: inline;"><strong>Liste Des Consignes:</strong> </h1>
		<div class="pull-right">
			
		</div>
</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-11">
				@if(session()->has('message'))
           <div class="alert alert-success">
              {{ session()->get('message') }}
           </div>
        @endif
	      @foreach($cons as $cle=>$con)
	    <div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$cle}}">
							<i class="ace-icon fa fa-edit" data-icon-hide="ace-icon fa fa-edit" data-icon-show="ace-icon fa fa-edit"></i>
							&nbsp;{{$con->consigne}} 
								<i></i>
							<div align="right"> 
                @if($con->app=='Oui') 
                 	<i class="glyphicon glyphicon-ok" data-icon-hide="glyphicon glyphicon-ok" data-icon-show="glyphicon glyphicon-ok"></i>
							<a>	&nbsp;{{$con->app}} </a> 

              @elseif ($con->app=='Non')
              <i class="glyphicon glyphicon-remove" data-icon-hide="glyphicon glyphicon-remove" data-icon-show="glyphicon glyphicon-remove"></i>
              	<a >	&nbsp;{{$con->app}} </a>
              	@endif
							</div>	
						
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse" id="collapse{{$cle}}">
					<div class="panel-body">
				     
					@if(($con->app==='Non'))
						<form method="POST" action="/surveillances/store/{{$con->id}}" enctype="multipart/form-data">
							{{ csrf_field() }}
						
							<input type="text" value="{{$con->id}}" hidden="true" name="idcons">
							<input type="text" value="{{$con->id_visite}}" hidden="true" name="idvis">

						<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="motifcons">
									<strong>Date :</strong>
								</label>
								<div class="col-sm-9">
									<input type="text" name="datesur" class="form-control date-picker" id="id-date-picker-1"  data-date-format="yyyy-mm-dd" />
								</div>
							</div>
							<br> <br>
                <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="motifcons">
									<strong>Heure :</strong>
								</label>
								<div class="col-sm-9">
									<div class="input-group bootstrap-timepicker">
															<input id="timepicker1" name="heuresur" type="text" class="form-control" />
															<span class="input-group-addon">
																<i class="fa fa-clock-o bigger-110"></i>
															</span>
														</div>
								</div>
							</div>
							<br><br>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="motifcons">
									<strong>Appliquée :</strong>
								</label>
								<div class="col-sm-9">
									<input type="radio" id="Oui"
                  name="ap" value="Oui">
                 <label for="oui">Oui</label>

                  <input type="radio" id="Non"
                   name="ap" value="Non">
                  <label for="non">Non</label>
								</div>
							</div>
							<br/><br/>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="description">
									<strong>Description:</strong>
								</label>
								<div class="col-sm-9">
									<textarea class="col-xs-12" id="description" name="desc" placeholder="Description"></textarea>
								</div>
							</div>	
	             <br/><br/>
	             <br>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="description">
									<strong>Observation:</strong>
								</label>
								<div class="col-sm-9">
									<textarea class="col-xs-12" id="obs" name="obs" placeholder="Observation"></textarea>
								</div>
							</div>	

							<br><br><br><br>
						
							<br><br>
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Submit
								</button>
								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									Reset
								</button>
							</div>
						</form>
						 @endif
					
					</div>
				</div>
			</div>
	      	@endforeach



		
	 
					
							

		

<br>
<br>
@endsection