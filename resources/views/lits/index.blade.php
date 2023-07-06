@extends('app')
@section('main-content')
<div class="page-header"><h1>Liste des lits</h1></div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue">
			<div class="widget-header">
				<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>lits</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
			 <a href="#" data-href="{{ route('lit.create') }}" id="litAdd"><i class="fa fa-plus-circle bigger-180"></i></a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">Numéro</th><th class="center">Nom</th>
								<th class="center">Service</th><th class="center">Chambre</th>
								<th class="center">Bloqué ?</th><th class="center">Affecté</th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($lits as $lit)
							<tr id="{{ $lit->id }}">
								<td>{{ $lit->num }}</td>
								<td>{{ $lit->nom }}</td>
								<td>{{ $lit->salle->service->nom }}</td>
								<td>{{ $lit->salle->nom }}</td>
								<td>{{ $lit->bloq == 1 ? "Oui" : "Non" }}</td>
                  <td>{{ $lit->affectation == 1 ? "Oui" : "Non" }}
                </td>
								<td class="center">
	 								<button type="button" class="btn btn-xs btn-success litShow" data-id="{{ $lit->id }}"><i class="ace-icon fa fa-hand-o-up"></i></button>
	                 <button type="button" class="btn btn-xs btn-info litEdit" value="{{$lit->id}}"><i class="ace-icon fa fa-pencil fa-xs"></i></button>
								  <button type="button" class="btn btn-xs btn-danger litDelete" value="{{ $lit->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-5" id="ajaxPart"></div>
</div>
@stop
@section('page-script')
@include('lits.scripts')
<script type="text/javascript">
$(function(){
  $('body').on('click', '#service', function () {
    $('#salle_id').removeAttr("disabled");
    $.ajax({
        url : '/salles/'+ $('#service').val(),
        type : 'GET',
        success : function(data){
          if(data.length != 0){
              var select = $('#salle_id').empty();
                $.each(data,function(){
                     select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                });
          }else
            $('#salle_id').html('<option value="" disabled selected>Pas de salle</option>');
        },
      });
  });
  $('body').on('click', '.litShow', function (e) {
    e.preventDefault();
    var url = "{{ route('lit.show',':slug') }}"; 
    url = url.replace(':slug',$(this).data('id'));
    $.ajax({
        type: "GET",
        url: url,
        data:{ _token: CSRF_TOKEN },
        success: function (data) {
          $('#ajaxPart').html(data);
        }
    }); 
  });
  $('body').on('click', '.litEdit', function (e) {
      e.preventDefault();
      var url = "{{ route('lit.edit',':slug') }}"; 
      url = url.replace(':slug',$(this).val());
      $.ajax({
            type: "GET",
            url: url,
            data: { _token: CSRF_TOKEN },
            success: function (data) {
              $('#ajaxPart').html(data);
            }
      }); 
    });
    $('body').on('click', '.litDelete', function (e) {
        e.preventDefault();
        var url = "{{ route('lit.destroy',':slug') }}"; 
        url = url.replace(':slug',$(this).val());
        $.ajax({
            type: "DELETE",
            url: url,
            data: {_token: CSRF_TOKEN },
            success: function (data) {
              $("#" + data).remove();
            }
        }); 
    });
});
</script>
@stop