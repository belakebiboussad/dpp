@extends('app')
@section('page-script')
<script type="text/javascript">
</script>
@endsection
@section('main-content')
<div class="container">
 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif 
  <br>
  <div id="showTableEmployees">
    @if(!empty($plannings))
    <table class="table table-dark">
      <col width="10%">
      <col width="15%">
      <col width="15%">
      <col width="40%">
      <col width="5%">
      <col width="15%">
      <thead>
        <tr>
          <th scope="col">Type</th>
          <th scope="col">Date debut</th>
          <th scope="col">Date Fin</th>
          <th scope="col">Description</th>
          <th scope="col">État</th>
          <th class="center"><em class="fa fa-cog"></em></th>
      </tr>
      </thead>
      <tbody>
       @foreach( $plannings as $demande)
        <tr>
          <td>{{ $demande->type }}</td>
          <td>{{  $demande->date->format('Y-m-d') }} {{  $demande->heure }}</td>
          <td>{{ $demande->date_end->format('Y-m-d') }} {{  $demande->heure_end }}</td>
          <td>{{ $demande->desc }}</td>
          <td>
            <span class="badge badge-{{( $demande->getStateID($demande->state)) === 0 ? 'warning':'primary' }}">
            {{$demande->state}}
            </span>
          </td>
          <td class="center">
            <div class="hidden-sm hidden-xs btn-group">
              <a href="{{ route('planning.edit', $demande->id) }}" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil "></i></a>
              <a href="{{route('planning.destroy',$demande->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
                <i class="ace-icon fa fa-trash-o"></i></a>
            </div>
          </td>


        </tr>
        @endforeach 
      </tbody>
    </table>
    @endif
  </div>
</div>
@endsection