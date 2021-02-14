<style>
/*.nav-tabs{background-color:#C8D3DB;}*/
 .nav-tabs > li > a{
    border-radius: 5px;
}
.nav-tabs > li > a:hover{
    background-color: #3D515F !important;
    border-radius: 5px;
    color:#fff;
    border:1px solid black;
} 
.nav-tabs > li.active > a,
.nav-tabs > li.active > a:focus,
.nav-tabs > li.active > a:hover{
    background-color: #68889E !important;
    color:#fff;
      border:2px solid #3F515F;
}
</style>
<div data-role="page" class="ui-responsive-panel">
<div class="panel panel-default panel-table">
  <div data-role="panel" class="panel-body tabbable" data-display="push" id="nav-panel">
    <div class="panel with-nav-tabs panel-info">
      <div class="panel-heading">
        <ul class="nav nav-pills justify-content-center" role="tablist">
          <li class="nav-item active"><a href="#patient" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<strong>Patient</strong></a></li>
          @if(isset($assure))
          <li class="nav-item"><a href="#assure" data-toggle="tab"><img src = "img/policeman.png" class ="img1" style="width:20%;height:20%">&nbsp;<strong>Assure</strong></a></li>
          @endif
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content" style="border:none">
          <div class="tab-pane noborders  in active" id="patient">
            <table class="table table-bordered table-condensed col-sm-12 w-auto">
              <tbody>
                <tr>
                    <td class ="noborders"><strong>nom:</strong></td><td align="left">{{ $patient->Nom }}</td>
                    <td class ="noborders"><strong>prenom :</strong></td><td align="left">{{ $patient->Prenom }}</td>
                </tr>
                <tr>
                      <td class ="noborders"><strong><strong>Âge :</strong></strong></td>
                     <td align="left"><span class="badge badge-{{ $patient->getAge() < 18 ? 'danger':'success' }}">{{ $patient->getAge()  }}</span>Ans</td>
                     <td class ="noborders"><strong>Né(e) a:</strong></td > <td align="left">{{ $patient->lieuNaissance->nom_commune }}</td>
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
                     <td class ="noborders"><strong>Adress :</strong></td><td align="left">{{ $patient->Adresse }}</td>
                     <td class ="noborders"><i class="fa fa-phone"></i><strong>Mob1:</strong></td><td align="left">{{ $patient->tele_mobile1 }}</td>
                </tr> 
                <tr>
                    <td class ="noborders"><i class="fa fa-phone"></i><strong>Mob2 :</strong></td><td align="left">{{ $patient->tele_mobile2 }}</td>
                    <td class ="noborders"><strong>N°Sec Soc:</strong></td><td align="left">{{ $patient->NSS }}</td>
                </tr> 
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
                      @if(isset($assure))
                        <div class="tab-pane" id="assure">
                           <table class="table table-bordered table-condensed col-sm-12 w-auto">
                           <tbody>
                                <tr>
                                     <td class ="noborders"><strong>Nom:</strong></td><td colspan="1">{{ $assure->Nom }}</td>
                                    <td class ="noborders"><strong>Prenom :</strong></td><td >{{ $assure->Prenom }}</td>
                                </tr>
                                <tr>
                                      <td class ="noborders"><strong>Né(e) le :</strong></td> <td> {{ $assure->Date_Naissance }}</td>
                                     <td class ="noborders"><strong>Né(e) a:</strong></td> <td>{{ $assure->lieuNaissance->nom_commune }}</td>
                                </tr>  
                                <tr>
                                       <td class ="noborders"><strong>Genre :</strong></td><td>@if ( $assure->Sexe == 'F' ) Féminin @else  Masculin @endif </td>
                                       <td class ="noborders"><strong>Matricule:</strong></td><td>{{ $assure->Matricule }}</td> 
                                </tr>
                                <tr>
                                       <td class ="noborders"><strong>N°Sec Soc :</strong></td><td>{{ $assure->NSS }}</td>
                                      <td class ="noborders"><strong>NMGSN:</strong></td><td>{{ $assure->NMGSN }}</td>
                                </tr>
                                 <tr>
                                       <td colspan="1" class ="noborders"><strong>Grade :</strong></td>
                                       @if(isset($assure->Grade))
                                        <td>{{ $assure->grade->nom }}</td>
                                        @endif
                                       <td class ="noborders blue"><strong>Etat:</strong></td><td>{{ $assure->Etat }}</td>
                                </tr>
                            </tbody>
                           </table>
                        </div> {{-- tabpane --}}
                        @endif
                </div>          
            </div>
            </div>
            <div class="center">
                   @if( in_array(Auth::user()->role_id,[1,13,14]))
                   <a  href="/consultations/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Consultation</a>
                  @endif
                  &nbsp;&nbsp;&nbsp;&nbsp;<a href="rendezVous/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Rendez-Vous</a>
            </div>
     </div><!-- /panel -->
    </div>
</div>