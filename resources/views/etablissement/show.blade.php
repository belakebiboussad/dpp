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
		  border-radius: 3px;
      box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {        
		padding-bottom: 15px;/*background: #435d7d;color: #fff;*/
		padding: 16px 30px;
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
@stop
@section('page-script')
<script>
  function exportTasks(_this) {
    let _url = $(_this).data('href');
    window.location.href = _url;
   }
</script>
@stop
@section('main-content')
	<div class="row">
		<div class="table-wrapper" style="overflow-x:auto;">
      <div class="table-title">
        <div class="row"><div class="col-sm-6"><h3>Etablissement hospitalier</h3></div></div>            			 
			</div>
			<table class="table table-striped table-hover">
        <thead>
        	<tr>
				  <th class="center">Nom</th>
          <th class="center">Acronyme</th>
		      <th class="center priority-4">Adresse</th>
					<th class="center priority-4">Téléphone</th>
					<th class="center priority-4">Téléphone2</th>
          <th class="center priority-4">Contact</th>
          <th class="center priority-4 {{isset($etab->type_id) ? '' :'hidden' }}" >Type</th>
					<th class="center priority-4 {{isset($etab->type_id) ? '' :'hidden' }}">Tutelle</th>
					<th class="center" width="20%">Logo</th>
		      <th width="10%" class="center"><em class="fa fa-cog"></em></th>
          </tr>
				</thead>
				<tbody>
          <tr>
     				<td>{{ $etab->nom }}</td>
            <td>{{ $etab->acronyme }}</td>
            <td class="priority-4">{{ $etab->adresse }}</td>
						<td class="priority-4">{{ $etab->tel }}</td>
						<td class="priority-4">{{ $etab->tel2 }}</td>
            <td>{{ $etab->contact }}</td>
             <td class="{{isset($etab->type_id) ? '' :'hidden' }}">
             {{ isset($etab->type_id) ? $etab->Type->acr :'' }}
             </td>
						<td class="priority-4 {{isset($etab->type_id) ? '' :'hidden' }}">{{ $etab->tutelle }} </td>
            <td class="center"  width="20%">
               <div class="card-image waves-effect waves-block waves-light {{ $etab->logo == "" ? 'hidden' :''}}">
                  <img class="activator" src="{{  url('/img/'.$etab->logo) }}" width="100" height="100">
              </div>
            </td>		
            <td class="center" width="10%">
              <a href="{{ route('etablissement.edit', $etab->id) }}" class="btn btn-succes btn-xs" ><i class="fa fa-edit fa-xs"></i></a>
              <a href="{{ route('etablissement.destroy', $etab) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger" ><i class="ace-icon fa fa-trash-o"></i></a>
              <span data-href="/etabExport" id="export" class="btn btn-success btn-xs" onclick="exportTasks(event.target);">
                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
              </span>
            </td>
          </tr>
        </tbody>
			</table>				
		</div>
	</div>	
@stop