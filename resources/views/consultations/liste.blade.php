<div class="row">
	<div class="col-sm-5 col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Consultations</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a href="/consultations/create/{{$patient->id}}" class="align-middle"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
			</div>
		</div><!-- widget-header -->
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="display table-responsive" id="consultList">
					<thead >
						<tr>
							<th class="center">Date</th>	
							<th class ="center sorting_disabled">Médecin Consultant</th>{{-- <th class ="center sorting_disabled">Motif</th> --}}
							<th class ="center sorting_disabled"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($patient->Consultations as $consult)
					<tr id ="{{ $consult->id }}">
					      <td>{{ $consult->date }}</td>
						<td>{{ $consult->medecin->full_name }}</td>{{-- <td><small>{{ $consult->motif }}</small></td> --}}
						<td class="center">
                                                    <button class="btn btn-primary btn-xs" onclick="showConsult({{ $consult->id }});"><i class="fa fa-eye"></i></button>
                                                    <a href = "{{ route('consultations.show',$consult->id)}}" style="cursor:pointer" class="btn btn-success btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>
                                            </td>	
					</tr>
					@endforeach
					</tbody>
			</table>
			</div>
			</div>
		</div>
	</div><div class="col-sm-7 col-xs-12" id="consultDetail"></div>
</div>