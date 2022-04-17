<table class="table table-bordered table-condensed col-sm-12">
  <thead>
    <tr>
      <th class="center">Date</th>
      <th class="center">Traitement</th>
      <th class="center"><em class="fa fa-cog"></em></th>
    </tr>
  </thead>
  <tbody>
    @if(count($trait->execs) < $trait->nbrPJ)
    @for ($i = 1; $i <= $trait->nbrPJ; $i++)
    <tr>
      @if($i == 1)
      <td rowspan="{{ $trait->nbrPJ }}" class="align-middle">{{ $date }}</td>
      @endif
      <td class ="admin-{{ $i }}">{{ $trait->medicament->nom }}</td>
      <td class="center admin-{{ $i }}">
        <button type="button" data-toggle="modal" data-target="#traitExecute" class="btn btn-primary btn-sm" data-trait-id="{{ $trait->id }}" data-trait-ordre="{{ $i }}" data-dismiss="modal" {{ (in_array($i,$trait->execs) || ( $i >( count($trait->execs) + 1) )) ? 'disabled' : '' }} >
          <em class="fa fa-cog"></em>
        </button>
      </td>
    </tr>
    @endfor
    @endif
  </tbody>
</table>