@extends('app')
@section('main-content')
<div class="page-header"><h1>Liste des rôles :</h1></div>
 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif 
<div class="row">
<div class="col-xs-12 col-sm-12 widget-container-col">
<div class="widget-box widget-color-blue">
	<div class="widget-header">
		<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Liste des rôles</h5>
		<div class="widget-toolbar widget-toolbar-light no-border"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="/role/create"><b>Rôle</b></a></div>
	</div>
  <div class="widget-body">
		<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
			<thead class="thin-border-bottom">
				<tr><th>N°</th ><th>Nom</th><th>Type</th><th class="center"><em class="fa fa-cog"></em></th></tr>
			</thead>
			<tbody>
			@foreach( $roles as $i=>$role)
			<tr>
				<td  width="10%">{{ ++ $i }}</td>
				<td width="40%">{{ $role->nom }}</td><td width="40%">{{ $role->type }}</td>
				<td width="10%" class="center">
					<div class="hidden-sm hidden-xs btn-group">
            <a width="50%" class="btn btn-xs btn-success" href="{{ route('role.show', $role->id) }}">
              <i class="ace-icon fa fa-hand-o-up"></i></a>
						<a href="{{ route('role.edit', $role->id) }}" class="btn btn-xs btn-info">
            <i class="ace-icon fa fa-pencil"></i></a>
            <a href="{{route('role.destroy',$role->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o"></i></a>
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
@stop