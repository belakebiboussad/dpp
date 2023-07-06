@extends('app')
@section('main-content')
<div class="page-header"><h1>Liste des chambres</h1></div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue" >
		<div class="widget-header">
			<h5 class="widget-title lighter">
				<i class="ace-icon fa fa-table"></i><span>Chambres</span>
			</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
      <a href="#" id ="salleAdd" data-href="{{ route('salle.create') }}" class="align-middle"><i class="fa fa-plus-circle bigger-180"></i></a>
			</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class ="center">Dénomination</th>
							<th class ="center">ِCapacité</th>
							<th class ="center">Lits(nb)</th>
							<th class ="center">Unité</th>
							<th class ="center">Bloquée ?</th>
							<th class ="center">Service</th>
							<th class ="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>             
					@foreach($salles as $salle)
					<tr id="{{ $salle->id }}">
           	<td><a href="#" data-id="{{ $salle->id }}" class="salleShow">{{ $salle->nom }}</a></td>
						<td >{{ $salle->max_lit }}</td>
						<td >{{ $salle->lits->count() }}</td>
						<td>
              @switch($salle->genre)
                @case(0)
                  Homme
                  @break
                @case(1)
                  Femme
                  @break
                @case(2)
                  Enfant
                  @break
                @Default
                  @break
              @endswitch
            </td>
						<td>
							@if(isset( $salle->etat ))
								<span class="label label-sm label-warning">Oui
							@else
							<span class="label label-sm label-success">Non 
								
							@endif
							</span>
						</td>
						<td>{{ $salle->service->nom }}</td>
					  <td class ="center">
						  <button type="button" class="btn btn-xs  btn-success salleShow" data-id="{{$salle->id}}"><i class="fa fa-hand-o-up fa-xs"></i></button>  
              <button type="button" class="btn btn-xs btn-info sallEdit" value="{{$salle->id}}">
                <i class="ace-icon fa fa-pencil fa-xs"></i></button>
							<a href="#" data-href="{{ route('lit.create', array('id' => $salle->id) ) }}" class="btn btn-xs btn-grey" title="Ajouter un lit" id="litAdd"><i class="ace-icon fa fa-plus fa-xs"></i>	
							</a>
              <button type="button" class="btn btn-xs btn-danger salleDelete" value="{{ $salle->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
						</td>
					</tr>
					</tr>
					@endforeach
					</tbody>
				</table>
				</div>
			</div>{{-- widget-body --}}
		</div>
	</div>{{-- col-xs-12 --}}
	<div class ="col-xs-5" id="ajaxPart"> 
	</div>	
</div>

@stop
@section('page-script')
@include('Salles.scripts')
@include('lits.scripts')
<script type="text/javascript">
$(function(){
  $('body').on('click', '.salleShow', function (e) {
    e.preventDefault();
    var url = "{{ route('salle.show',':slug') }}"; 
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
  $('body').on('click', '.sallEdit', function (e) {
    e.preventDefault();
    var url = "{{ route('salle.edit',':slug') }}"; 
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
  $('body').on('click', '.salleDelete', function (e) {
    e.preventDefault();
    var url = "{{ route('salle.destroy',':slug') }}"; 
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
}) 
</script>
@stop