@extends('app')
@section('style')
<style>
	body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
       	 background: #fff;
    		 /*   padding: 20px 25px;
      		  margin: 30px 0;*/
		border-radius: 3px;
       	 box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {        
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		/*margin: -20px -25px 10px;*/
		border-radius: 3px 3px 0 0;
    }
      .table-title h3 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	 table.table tr th, table.table tr td {
        	border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
</style>
@endsection
@section('main-content')
{{-- 	<div class="row"><h3>Etablissement:</h3></div><div class="space-12 hidden-xs"></div> --}}
	<div class="row">
		<div class="table-wrapper">
            		<div class="table-title">
            		       <div class="row">
                   			 <div class="col-sm-6"><h3> <b>Etablissement</b></h3></div>
				</div>
			</div>
			<table class="table table-striped table-hover">
                		<thead>
                    		<tr>
						<th>Nom</th>
		                         <th>Adresse</th>
						<th>Téléphone</th>
						<th width="30%">Logo</th>
		                        <th width="5%">Actions</th>
                   			 </tr>
				</thead>
				<tbody>
                  			 <tr>
		         			<td>{{ $etablissement->nom }}</td>
                       			 <td>{{ $etablissement->adresse }}</td>
						<td>{{ $etablissement->tel }} </td>
                      			<td><img src="/download/{{ $etablissement->logo }}" alt ="pas de logo" height="1%" width="70%" id ="logoimg"/></td>
                        			<td>
		                            <a href="{{ route('etablissement.edit', $etablissement->id) }}" class="edit" ><i class="fa fa-edit fa-xs bigger-130"></i></a>
		                            <a href="{{ route('etablissement.destroy', $etablissement->id) }}" class="delete" ><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
		                        </td>
                    </tr>
                    </tbody>
			</table>				
		</div>{{-- table-wrapper --}}
	</div>	
@endsection