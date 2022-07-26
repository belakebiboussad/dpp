<ul class="nav nav-pills justify-content-center" role="tablist">
  <li class="nav-item active"><a href="#patient" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<strong>Patient</strong></a></li>
 
 @if(!(in_array($patient->Type,[5,6])))
  <li class="nav-item"><a href="#assure" data-toggle="tab"><img src = "img/policeman.png" class ="img1" style="width:18%;height:18%">&nbsp;<strong>Assure</strong></a></li>
  @endif
</ul>
<div class="tab-content" style="border:none">
  <div class="tab-pane noborders  in active" id="patient">
    <table class="table table-bordered table-condensed col-sm-12" width="100%"><!-- w-auto -->
      <tbody>
        <tr>
          <td class ="noborders"><strong>nom:</strong></td><td align="left">{{ $patient->Nom }}</td>
          <td class ="noborders"><strong>prenom :</strong></td><td align="left">{{ $patient->Prenom }}</td>
        </tr>
        <tr>
             <td class ="noborders"><strong><strong>Âge :</strong></strong></td>
             <td align="left"><span class="badge badge-{{ $patient->age< 18 ? 'danger':'success' }}">{{ $patient->age }}</span>Ans</td>
             <td class ="noborders"><strong>Né(e) a:</strong></td>
             <td align="left">
                @if(isset($patient->Lieu_Naissance))
                   {{ $patient->lieuNaissance->nom_commune }}
                @endif
             </td>
       </tr>
        <tr>
          <td class ="noborders"><strong>Genre :</strong></td><td align="left">@if ( $patient->Sexe == 'F' ) Féminin   @else  Masculin @endif </td>
          <td  class ="noborders"><strong>Civilité:</strong></td>
          <td align="left">
             @switch($patient->situation_familiale)
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
          <td class ="noborders"><strong>Adress :</strong></td><td align="left"><small style="text-overflow: ellipsis; ">{{ $patient->Adresse }}</small></td>
          <td class ="noborders"><i class="fa fa-phone"></i><strong>Mob1:</strong></td><td align="left">{{ $patient->tele_mobile1 }}</td>
        </tr> 
        @if(isset( $patient->NSS ) || isset($patient->tele_mobile2))
        <tr>
          <td class ="noborders text-no-wrap"><i class="fa fa-phone"></i><strong>Mob2 :</strong></td><td align="left">{{ $patient->tele_mobile2 }}</td>
          <td class ="noborders"><strong>NSS:</strong></td><td align="left">{{ $patient->NSS }}</td>
        </tr> 
        @endif
        <tr>
          <td class ="noborders"><strong>Sang :</strong></td><td align="left"><span class="badge badge-danger">{{ $patient->group_sang }}{{ $patient->rhesus }}</span></td>
          <td class ="noborders"><strong>Type:</strong></td>
          <td align="left">
            @switch($patient->Type)
               @case("0")
                          <span class="label label-sm label-success">Assure
                            @break
               @case("1")
                            <span class="label label-sm label-primary">Conjoint(e)
                            @break  
               @case("2")
                            <span class="label label-sm label-warning"> Père
                            @break
               @case("3")
                            <span class="label label-sm label-warning">Mère 
                            @break
               @case("4")
                            <span class="label label-sm label-warning">Enfant 
                            @break
                @case("5")
                            <span class="label label-sm label-warning">Autre 
                            @break
            @endswitch  
            </span>
          </td>
        </tr>           
      </tbody>
    </table>
  </div> {{-- tabpane --}}
  @if(!(in_array($patient->Type,[5,6])))
  <div class="tab-pane" id="assure">
    <table class="table table-bordered table-condensed col-sm-12 w-auto">
      <tbody>
        <tr>
              <td class ="noborders"><strong>Nom:</strong></td><td colspan="1">{{ $patient->assure->Nom }}</td>
              <td class ="noborders"><strong>Prenom :</strong></td><td >{{ $patient->assure->Prenom }}</td>
        </tr>
       <tr>
          <td class ="noborders text-nowrap"><strong>Né(e) le :</strong></td> <td> {{ $patient->assure->Date_Naissance }}</td>
          <td class ="noborders"><strong>Né(e) a:</strong></td>
          <td>
          @if(isset($patient->assure->lieunaissance))
            {{ $patient->assure->lieuNaissance->nom_commune }}
          @endif
          </td>
       </tr>
        <tr>
              <td class ="noborders nowrap"><strong>Genre :</strong></td><td>@if ( $patient->assure->Sexe == 'F' ) Féminin @else  Masculin @endif </td>
              <td class ="noborders"><strong>Matricule:</strong></td><td>{{ $patient->assure->matricule }}</td> 
        </tr>
       <tr>
                 <td class ="noborders"><strong>NSS :</strong></td><td>{{ $patient->assure->NSS }}</td>
                <td class ="noborders"><strong>NMGSN:</strong></td><td>{{ $patient->assure->NMGSN }}</td>
       </tr>
           <tr>
                 <td colspan="1" class ="noborders nowrap"><strong>Grade :</strong></td>
                <td>
                     @if(isset($patient->assure->Grade))
                    {{ $patient->assure->grade->nom }}
                  @endif
                  </td>
                 <td class ="noborders blue"><strong>Etat:</strong></td><td>{{ $patient->assure->Position }}</td>
          </tr>
      </tbody>
     </table>
  </div> {{-- tabpane --}}
  @endif
</div> <!-- tab-content -->
<div class= "center">
  @if( in_array(Auth::user()->role_id,[1,13,14]))
   <a  href="/consultations/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Consultation</a>&nbsp;&nbsp;&nbsp;&nbsp;
 
  <a href="{{ route('rdv.create', ["patient_id"=>$patient->id]) }}" class="btn btn-sm btn-primary btn-create" @if(!isset($patient->Dat_Naissance))  disabled @endif>
      <i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Rendez-Vous
    </a>
   @endif
</div>