@extends('app')
@section('main-content')
<div class="page-header">
	<h1><strong>Liste des Roles :</strong></h1>
</div>
<div class="row">
	
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
<div class="widget-box widget-color-blue" id="widget-box-2">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Roles :</h5>
		<div class="widget-toolbar widget-toolbar-light no-border"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			<a href="/role/create"><b>Rôle</b></a>
		</div>
  </div>
<div class="widget-body">
		<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
			<thead class="thin-border-bottom">
				<tr>
					<th>n°</th >
	   				<th><strong style="font-size:14px;"> Nom</strong></th>
					
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach( $roles as $i=>$role)
			<tr>
				<td  width="10%">{{ ++ $i }}</td>
				<td width="80%">{{ $role->role }}</td>
				<td width="10%">
					<div   class="hidden-sm hidden-xs btn-group">
                            				<a width="50%" class="btn btn-xs btn-success" href="/role/show/{{$role->id}}">
                                			<i  width="50%" class="ace-icon fa fa-hand-o-up bigger-120"></i>
                           			              </a>
						<a href="{{ route('role.edit', $role->id) }}" class="btn btn-xs btn-info">
						<i class="ace-icon fa fa-pencil bigger-120"></i>

						</a>	

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





</div>
@endsection