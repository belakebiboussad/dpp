@extends('app')
@section('page-script')
<script type="text/javascript">
function getActions(data){
  var actions = '<button type="button" class="btn btn-xs btn-success rolShow" value="' + data.id + '"><i class="fa fa-hand-o-up fa-xs"></i></button>';
  actions += '<button type="button" class="btn btn-xs btn-info rolEdit" value="' + data.id + '"><i class="ace-icon fa fa-pencil fa-xs"></i></button>';
  actions += '<button type="button" class="btn btn-xs btn-danger rolDelete" data-id="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>';
  return actions;
}
$(function(){
  $('body').on('click', '#rolAdd', function (e) {
      e.preventDefault();
      var formData = {
        _token: CSRF_TOKEN,
      };
      var url = "{{ route('role.create') }}"; 
      $.ajax({
          type: "GET",
          url: url,
          data: formData,
          success: function (data) {
            $('#ajaxPart').html(data);
          } 
      });
  });
  $('body').on('click', '#rolSave', function (e) {//e.preventDefault();
    formSubmit($('#roleFrm')[0], this, function(status, data) {
      var rol = '<tr id="' + data.id + '"><td width="40%">'+ data.nom + '</td><td width="30%">' + data.type +'</td><td width="30%" class = "center">' +  getActions(data) + '</td></tr>';
      if (jQuery('#rolSave').val() == "add")
        $('#rolesTable' +' tbody').append(rol);
      else
        $("#" + data.id).replaceWith(rol);
      $('#ajaxPart').html("");
    });
  });
  $('body').on('click', '#rolUpdate', function (e) {
    e.preventDefault();
    formSubmit($('#rolUpdFrm')[0], this, function(status, data) {
      var rol = '<tr id="' + data.id + '"><td width="40%">'+ data.nom + '</td><td width="30%">' + data.type +'</td><td width="30%" class = "center">' +  getActions(data) + '</td></tr>';
      $("#" + data.id).replaceWith(rol);
      $('#ajaxPart').html("");
    });
  });
  $('body').on('click', '.rolShow', function (e) {
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,
    };
    var url = "{{ route('role.show',':slug') }}"; 
    url = url.replace(':slug',$(this).data('id'));
    $.ajax({
          type: "GET",
          url: url,
          data: formData,
          success: function (data) {
            $('#ajaxPart').html(data);
          }
      }); 
  });
  $('body').on('click', '.rolEdit', function (e) {
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,
    };
    var url = "{{ route('role.edit',':slug') }}"; 
    url = url.replace(':slug',$(this).val());
    $.ajax({
          type: "GET",
          url: url,
          data: formData,
          success: function (data) {
            $('#ajaxPart').html(data);
          }
      }); 
  });
  $('body').on('click', '.rolDelete', function (e) {
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,
    };
    var id = $(this).data('id');
    var url = "{{ route('role.destroy',':slug') }}"; 
    url = url.replace(':slug', id);
    alert(url);
   
    $.ajax({
        type: "DELETE",
        url: url,
        data: formData,
        success: function (data) {
          $("#" + data).remove();
        }
    }); 
  });
})  
</script>
@stop
@section('main-content')
<div class="page-header"><h1>Liste des rôles</h1></div>
 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif 
<div class="row">
<div class="col-xs-7 col-sm-7 widget-container-col">
<div class="widget-box widget-color-blue">
	<div class="widget-header">
		<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Liste des rôles</h5>
    <div class="widget-toolbar widget-toolbar-light no-border">
      <a href="#" id ="rolAdd" class="align-middle"><i class="fa fa-plus-circle bigger-180"></i>
    </a>
  </div>
	</div>
  <div class="widget-body">
		<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover" id="rolesTable">
			<thead class="thin-border-bottom">
				<tr><th>Nom</th><th>Type</th><th class="center"><em class="fa fa-cog"></em></th></tr>
			</thead>
			<tbody>
			@foreach( $roles as $role)
			<tr id='{{ $role->id}}'>
				<td width="40%">{{ $role->nom }}</td><td width="30%">{{ $role->type }}</td>
				<td width="30%" class="center">
					<div class="hidden-sm hidden-xs btn-group">
            <button type="button" class="btn btn-xs btn-success rolShow" data-id="{{$role->id}}"><i class="fa fa-hand-o-up fa-xs"></i></button>
            <button type="button" class="btn btn-xs btn-info rolEdit" value="{{$role->id}}">
            <i class="ace-icon fa fa-pencil fa-xs"></i></button>
              <a href="#" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger rolDelete" data-id="{{ $role->id }}"><i class="ace-icon fa fa-trash-o"></i></a>
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
 <div class ="col-sm-5 col-xs-5" id="ajaxPart"></div>   
</div>
@stop