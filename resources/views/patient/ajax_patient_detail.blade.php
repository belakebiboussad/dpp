<style>
.nav-tabs{
 
/*background-color:#C8D3DB;*/
 
}
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
              <thead class="thead-light">
              </thead>
              <tbody>
                <tr>
                  <td colspan="1" class ="noborders"><strong>nom:</strong></td>
                  <td colspan="1" align="left">{{ $patient->Nom }}</td>
                  <td colspan="1" class ="noborders"><strong>prenom :</strong></td>
                  <td colspan="1" align="left">{{ $patient->Prenom }}</td>
                </tr>
                <tr>
                      <td colspan="1" class ="noborders"><strong><strong>Âge :</strong></strong></td>
                     <td align="left"><span class="badge badge-{{ $patient->getAge() < 18 ? 'danger':'success' }}">{{ $patient->getAge()  }}</span>Ans</td>
                     <td  colspan="1" class ="noborders"><strong>Né(e) a:</strong></td >
                     <td align="left">{{ $patient->lieuNaissance->nom_commune }}</td>
              </tr>
               <tr>
                                       <td colspan="1" class ="noborders"><strong>Genre :</strong></td>
                                       <td align="left">@if ( $patient->Sexe == 'F' ) Féminin   @else  Masculin @endif </td>
                                       <td colspan="1" class ="noborders"><strong>Civilité:</strong></td>
                                      <td align="left">{{ $patient->situation_familiale }}</td>
                                </tr>
                                <tr>
                                      <td colspan="1" class ="noborders"><strong>Adress :</strong></td>
                                      <td align="left">{{ $patient->Adresse }}</td>
                                      <td class ="noborders"><i class="fa fa-phone"></i><strong>Mob1:</strong></td>
                                      <td align="left">{{ $patient->tele_mobile1 }}</td>
                                </tr> 
                                <tr>
                                            <td colspan="1" class ="noborders"><i class="fa fa-phone"></i><strong>Mob2 :</strong></td>
                                            <td align="left">{{ $patient->tele_mobile2 }}</td>
                                            <td class ="noborders"><strong>N°Sec Soc:</strong></td>
                                            <td align="left">{{ $patient->NSS }}</td>
                                  </tr> 
                                  <tr>
                                            <td colspan="1" class ="noborders"><strong>Sang :</strong></td>
                                            <td align="left"><span class="badge badge-danger">{{ $patient->group_sang }}{{ $patient->rhesus }}</span></td>
                                            <td class ="noborders"><strong>Type:</strong></td>
                                            <td align="left">
                                              @switch($patient->Type)
                                                @case("Assure")
                                                  <span class="label label-sm label-success">
                                                  @break
                                                @case("Ayant_droit")
                                                  <span class="label label-sm label-primary">
                                                  @break  
                                                @case("Autre")
                                                  <span class="label label-sm label-warning"> 
                                                  @break
                                              
                                              @endswitch  
                                              {{ $patient->Type}}
                                              </span>
                                            </td>
                                  </tr>           
                                  </tbody>
                                </table>
                        </div> {{-- tabpane --}}
                      @if(isset($assure))
                        <div class="tab-pane" id="assure">
                           <table class="table table-bordered table-condensed col-sm-12 w-auto">
                           <thead class="thead-light">
                                <tr></tr>
                           </thead>
                           <tbody>
                                <tr>
                                     <td colspan="1" class ="noborders"><strong>Nom:</strong></td>
                                     <td colspan="1">{{ $assure->Nom }}</td>
                                    <td colspan="1" class ="noborders"><strong>Prenom :</strong></td>
                                    <td colspan="1">{{ $assure->Prenom }}</td>
                                </tr>
                                <tr>
                                      <td colspan="1" class ="noborders"><strong>Né(e) le :</strong></td>
                                      <td> {{ $assure->Date_Naissance }}</td>
                                      <td  colspan="1" class ="noborders"><strong>Né(e) a:</strong></td>
                                      <td>{{ $assure->lieuNaissance->nom_commune }}</td>
                                </tr>  
                                <tr>
                                       <td colspan="1" class ="noborders"><strong>Genre :</strong></td>
                                       <td>@if ( $assure->Sexe == 'F' ) Féminin @else  Masculin @endif </td>
                                       <td colspan="1" class ="noborders"><strong>Matricule:</strong></td>
                                      <td>{{ $assure->Matricule }}</td>
                                </tr>
                                <tr>
                                       <td colspan="1" class ="noborders"><strong>N°Sec Soc :</strong></td>
                                       <td>{{ $assure->NSS }}</td>
                                       <td colspan="1" class ="noborders"><strong>NMGSN:</strong></td>
                                      <td>{{ $assure->NMGSN }}</td>
                                </tr>
                                 <tr>
                                       <td colspan="1" class ="noborders"><strong>Grade :</strong></td>
                                       @if(isset($assure->Grade))
                                        <td>{{ $assure->grade->nom }}</td>
                                        @endif
                                       <td colspan="1" class ="noborders blue"><strong>Etat:</strong></td>
                                      <td>{{ $assure->Etat }}</td>
                                </tr>
                            </tbody>
                           </table>
                        </div> {{-- tabpane --}}
                        @endif
                </div>          
            </div>
            </div>
            <div class="center">
                  @if(Auth::user()->role->id == 1)
                  <a  href="/consultations/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Consultation</a>
                  @endif{{-- rdv/create/{{ $patient->id }} --}}
                  &nbsp;&nbsp;&nbsp;&nbsp;<a href="rendezVous/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Rendez-Vous</a>
            </div>
     </div><!-- /panel -->
    </div>
</div>