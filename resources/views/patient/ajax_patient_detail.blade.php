<div data-role="page" class="ui-responsive-panel">
<div class="panel panel-default panel-table">
    <div data-role="header " class="panel-heading">
           <h3 class="panel-title"><strong>Resumé du&nbsp;</strong>&laquo;{{ $patient->Nom}} {{ $patient->Prenom }}&raquo;
           </h3>
     </div><!-- /header -->
    <div data-role="panel" class="panel-body" data-display="push" id="nav-panel">
        

              <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#patient" data-toggle="tab">Patient</a></li>
                            @if(isset($assure))
                            <li><a href="#assure" data-toggle="tab"><strong>Assure</strong></a></li>
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
                                      <td colspan="1" class ="noborders"><strong><strong>Né(e) le :</strong></strong></td>
                                      <td align="left"> {{ $patient->Dat_Naissance }}</td>
                                      <td  colspan="1" class ="noborders"><strong>Né(e) a:</strong></td >
                                      <td align="left">{{ $patient->lieuNaissance->nom_commune }}</td>
                                </tr>
                                <tr>
                                       <td colspan="1" class ="noborders"><strong>Sexe :</strong></td>
                                       <td align="left">@if ( $patient->Sexe == 'F' ) Femme   @else  Homme @endif </td>
                                       <td colspan="1" class ="noborders"><strong>Civilité:</strong></td>
                                      <td align="left">{{ $patient->situation_familiale }}</td>
                                </tr>
                                <tr>
                                      <td colspan="1" class ="noborders"><strong>Adress :</strong></td>
                                      <td align="left">{{ $patient->Adresse }}</td>
                                      <td class ="noborders"><strong>Mob1:</strong></td>
                                      <td align="left">{{ $patient->tele_mobile1 }}</td>
                                </tr> 
                                <tr>
                                            <td colspan="1" class ="noborders"><strong>Mob2 :</strong></td>
                                            <td align="left">{{ $patient->tele_mobile2 }}</td>
                                            <td class ="noborders"><strong>NSS:</strong></td>
                                            <td align="left">{{ $patient->NSS }}</td>
                                  </tr> 
                                  <tr>
                                            <td colspan="1" class ="noborders"><strong>Sang :</strong></td>
                                            <td align="left">{{ $patient->group_sang }}{{ $patient->rhesus }}</td>
                                            <td class ="noborders"><strong>Type:</strong></td>
                                            <td align="left">{{ $patient->Type }}</td>
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
                                     <td colspan="1" class ="noborders"><strong>nom:</strong></td>
                                     <td colspan="1">{{ $assure->Nom }}</td>
                                    <td colspan="1" class ="noborders"><strong>prenom :</strong></td>
                                    <td colspan="1">{{ $assure->Prenom }}</td>
                                </tr>
                                <tr>
                                      <td colspan="1" class ="noborders"><strong><strong>Né(e) le :</strong></strong></td>
                                      <td> {{ $assure->Date_Naissance }}</td>
                                      <td  colspan="1" class ="noborders"><strong>Né(e) a:</strong></td>
                                      <td>{{ $assure->lieuNaissance->nom_commune }}</td>
                                </tr>  
                                <tr>
                                       <td colspan="1" class ="noborders"><strong>Sexe :</strong></td>
                                       <td>@if ( $assure->Sexe == 'F' ) Femme   @else  Homme @endif </td>
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
                                       <td>{{ $assure->Grade }}</td>
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
                  @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
                  <a  href="/consultations/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Consultation</a>
                  @endif
                  {{-- rdv/create/{{ $patient->id }} --}}
                 &nbsp;&nbsp;&nbsp;&nbsp;<a href="rendezVous/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Rendez-Vous</a>
            </div>
             
           
     </div><!-- /panel -->
    </div>
</div>