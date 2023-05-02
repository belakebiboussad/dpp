<ul class="nav nav-pills justify-content-center" role="tablist">
  <li class="nav-item active"><a href="#patient" data-toggle="tab"><b>Patient</b></a></li>
 @if($patient->type_id !=6) 
  <li class="nav-item"><a href="#assure" data-toggle="tab"><b>Assure</b></a></li>
  @endif
</ul>
<div class="tab-content no-border">
  <div class="tab-pane in active" id="patient">
    <table class="table table-condensed col-sm-12" width="100%">
      <tbody>
        <tr>
          <td class ="noborders">nom:</td><td align="left">{{ $patient->Nom }}</td>
          <td class ="noborders">prenom :</td><td align="left">{{ $patient->Prenom }}</td>
        </tr>
        <tr>
          <td class ="noborders">Âge :</td>
          <td align="left"><span class="badge badge-{{ $patient->age< 18 ? 'danger':'success' }}">{{ $patient->age }}</span>Ans</td>
          <td class ="noborders">Né(e) a:</td>
          <td align="left">{{ isset($patient->Lieu_Naissance) ? $patient->lieuNaissance->nom_commune :''}}</td>
       </tr>
        <tr>
          <td class ="noborders">Genre :</td><td align="left">@if ( $patient->Sexe == 'F' ) Féminin   @else  Masculin @endif </td>
          <td  class ="noborders">Civilité:</td>
          <td align="left">
             @switch($patient->sf)
                     @case("C")
                          <span class="label label-sm label-success">Célibataire(e)
                          @break
                     @case("M")
                          <span class="label label-sm label-primary">Marié(e)
                          @break  
                      @case("D")
                           <span class="label label-sm label-warning"> Divorcé(e)
                           @break
                      @case("V")
                          <span class="label label-sm label-warning">Veuf(ve)
                           @break
                @endswitch
          </td>
        </tr>
        <tr>
          <td class ="noborders">Adress :</td><td align="left"><small style="text-overflow: ellipsis; ">{{ $patient->Adresse }}</small></td>
          <td class ="noborders"><i class="fa fa-phone"></i>Mob1:</td><td align="left">{{ $patient->tele_mobile1 }}</td>
        </tr> 
        @if(isset( $patient->NSS ) || isset($patient->tele_mobile2))
        <tr>
          <td class ="noborders text-no-wrap"><i class="fa fa-phone"></i>Mob2 :</td><td align="left">{{ $patient->tele_mobile2 }}</td>
          <td class ="noborders">NSS:</td><td align="left">{{ $patient->NSS }}</td>
        </tr> 
        @endif
        <tr>
          <td class ="noborders">Sang :</td><td align="left"><span class="badge badge-danger">{{ $patient->group_sang }}{{ $patient->rhesus }}</span></td>
          <td class ="noborders">Type:</td>
          <td align="left"><span class="label label-sm label-success"> {{ $patient->Type->nom }}</span></td>
          </tr>           
      </tbody>
    </table>
  </div> {{-- tabpane --}}
  @if($patient->type_id != 6)
  <div class="tab-pane" id="assure">
    <table class="table table-condensed col-sm-12 w-auto">
      <tbody>
        <tr>
          <td class ="noborders">Nom:</td><td colspan="1">{{ $patient->assure->Nom }}</td>
          <td class ="noborders">Prenom :</td><td >{{ $patient->assure->Prenom }}</td>
        </tr>
        <tr>
          <td class ="noborders text-nowrap">Né(e) le :</td> <td> {{ $patient->assure->Date_Naissance }}</td>
          <td class ="noborders">Né(e) a:</td>
          <td>{{ isset($patient->assure->lieunaissance) ? $patient->assure->lieuNaissance->nom_commune :'' }}
        </td>
       </tr>
        <tr>
          <td class ="noborders nowrap">Genre :</td><td>@if ( $patient->assure->Sexe == 'F' ) Féminin @else  Masculin @endif </td>
          <td class ="noborders"></td><td></td> 
        </tr>
       <tr>
          <td class ="noborders">NSS :</td><td>{{ $patient->assure->NSS }}</td>
       </tr>
        <tr>
          <td></td><td></td>
        </tr>
      </tbody>
     </table>
  </div> {{-- tabpane --}}
  @endif
</div> <!-- tab-content -->
<div class= "center">
  @if(Auth::user()->isIn([1,13,14]))
    <a  href="/consultations/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg"></i>Consultation</a>  
  @endif
  <a href="{{ route('rdv.create', ["patient_id"=>$patient->id]) }}" class="btn btn-sm btn-primary btn-create" @if(!isset($patient->Dat_Naissance))  disabled @endif>
    <i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Rendez-Vous
  </a>
</div>