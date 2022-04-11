<table class="table table-bordered table-condensed col-sm-12">
  <thead>
    <tr>
      <th class="center">Date</th>
      <th class="center">Traitement</th>
    </tr>
  </thead>
  <tbody>
   @for ($i = 1; $i <= $trait->nbrPJ; $i++)
    <tr id="admin-{{ $i }}">
      @if($i == 1)
      <td rowspan="{{ $trait->nbrPJ }}" class="align-middle">{{ $date }}</td>
      @endif
      <td class="center">
        <button type="button" data-toggle="modal" data-target="#traitExecute" class="btn btn-primary btn-sm" data-trait-id="{{ $trait->id }}" data-dismiss="modal">
          <em class="fa fa-cog"></em>
        </button>
      </td>
    </tr>
    @endfor
  </tbody>

</table>