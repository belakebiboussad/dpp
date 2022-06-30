@isset($specialite->antecTypes)
  @foreach( json_decode($specialite->antecTypes ,true) as $antype)
    @include('antecedents.' . App\modeles\antecType::FindOrFail($antype)->nom)
  @endforeach
@endisset