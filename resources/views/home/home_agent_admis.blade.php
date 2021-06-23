@extends('app')
@section('page-script')
<script type="text/javascript">
 	function getAdmissions(field,value)
	{
		$.ajax({
			url : '{{ URL::to('/getRdvs') }}',
			data: {    
			      	"field":field,
			      	"value":value,
			},
		  dataType: "json",// recommended response type
		 	success: function(data) {
				alert(data);	
		 	}
		 });
	}
 	$(function(){
 		$(".admiSearch").click(function(e){
			getAdmissions(field,$('#'+field).val().trim());
		})
 	});
	
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-sm-12 col-md-12"> <h3><strong>Rechercher une admission</strong></h3>
  	<div class="panel panel-default"><div class="panel-heading">Rechercher</div>
    	<div class="panel-body">
      <div class="row">
      	<div class="col-sm-4">
        	<div class="form-group"><label><strong>Patient :</strong></label>
        		<select id='etat' class="form-control filter  col-xs-12 col-sm-12">
         			<option value="0">En cours</option>
              <option value="1">Validée</option>
            </select>
        	</div>
        </div>
        <div class="col-sm-4">
    			<div class="form-group"><label class="control-label" for="" ><strong>Date :</strong></label>
  			    <div class="input-group">
  			      <input type="text" id ="currentday" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" >
  					  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    				</div>
	        </div>
      	</div>
      		 <div class="col-sm-4">
            <div class="form-group"><label class="control-label"><strong>IPP:</strong></label><input type="text" id="IPP" class="form-control filter"></div>
          </div>	
      	</div>
    	</div>
    	<div class="panel-footer">
    		<button type="submit" class="btn btn-sm btn-primary admiSearch"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
    	</div>
  	</div>
	</div>
</div>
@endsection