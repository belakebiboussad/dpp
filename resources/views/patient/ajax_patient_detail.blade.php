<style>
/*.panel-heading{
  height:45px;
}
.tab{
    margin-top: 10px;
}
.tab .nav-tabs{
    border:none;
    border-bottom: 1px solid #e4e4e4;
}
.nav-tabs li a{
    padding: 15px 30px;
    border:1px solid #ededed;
    border-top: 2px solid #ededed;
    border-right: 0px none;
    background: #7a81f4;
    color:#fff;
    border-radius: 0px;
    margin-right: 0px;
    font-weight: bold;
    transition: all 0.3s ease-in 0s;
}
.nav-tabs li a:hover{
    border-bottom-color: #ededed;
    border-right: 0px none;
    background: #00b0ad;
    color: #fff;
}
.nav-tabs li a i{
    display: inline-block;
    text-align: center;
    margin-right:10px;
}
.nav-tabs li:last-child{
    border-right:1px solid #ededed;
}
.nav-tabs li.active a,
.nav-tabs li.active a:focus,
.nav-tabs li.active a:hover{
    border-top: 2px solid #00b0ad;
    border-right: 1px solid #d3d3d3;
    margin-top: -13px;
    color: #444;
    padding: 20px 40px;
}
.tab .tab-content{
    padding: 18px;
    line-height: 15px;
    box-shadow:0px 1px 0px #808080;
}
.tab .tab-content h3{
    margin-top: 0;
}
@media only screen and (max-width: 767px){
    .nav-tabs li{
        width:100%;
        margin-bottom: 5px;
    }
    .nav-tabs li a{
        padding: 10px;
    }
    .nav-tabs li.active a,
    .nav-tabs li.active a:focus,
    .nav-tabs li.active a:hover{
        padding: 10px;
        margin-top: 0;
    }
}*/

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
                                      <td align="left">{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</td>
                                      <td  colspan="1" class ="noborders"><strong>Né(e) a:</strong></td >
                                      <td align="left">{{ $patient->lieuNaissance->nom_commune }}</td>
                                </tr>
                                <tr>
                                       <td colspan="1" class ="noborders"><strong>Sexe :</strong></td>
                                       <td align="left">@if ( $patient->Sexe == 'F' ) Femme   @else  Homme @endif </td>
                                       <td colspan="1" class ="noborders"><strong>Situation Familliale:</strong></td>
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
                  @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
                  <a  href="/consultations/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Consultation</a>
                  @endif
                  {{-- rdv/create/{{ $patient->id }} --}}
                 &nbsp;&nbsp;&nbsp;&nbsp;<a href="rendezVous/create/{{ $patient->id }}" class="btn btn-sm btn-primary btn-create"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Rendez-Vous</a>
            </div>
             
           
     </div><!-- /panel -->
    </div>
</div>