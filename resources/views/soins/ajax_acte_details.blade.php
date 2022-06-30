<table class="table table-bordered table-condensed col-sm-12">
  <thead>
    <tr>
      <th class="center">Date</th>
      <th class="center">Acte</th>
      <th class="center"><em class="fa fa-cog"></em></th>
    </tr>
  </thead>
  <tbody>
     @if(count($acte->execs) < $acte->nbrFJ)
    @for ($i = 1; $i <= $acte->nbrFJ; $i++)
    <tr>
      @if($i == 1)
      <td rowspan="{{ $acte->nbrFJ }}" class="align-middle">{{ $date }}</td>
      @endif
      <td>{{ $acte->nom }}</td>
      <td class="center">
        <button type="button" data-toggle="modal" data-target="#acteExecute" class="btn btn-primary btn-sm" data-acte-id="{{ $acte->id }}" data-acte-ordre="{{ $i }}" data-dismiss="modal" {{ (in_array($i,$acte->execs) || ($i >( count($acte->execs)+1) )) ? 'disabled' : '' }}>
          <em class="fa fa-cog"></em>
        </button>
      </td>
    </tr>
    @endfor
    @endif
  </tbody>
</table>