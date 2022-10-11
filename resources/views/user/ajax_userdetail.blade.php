<div class="widget-box transparent">
      <div class="widget-header widget-header-flat widget-header-small">
               <h5 class="widget-title"><b> Résumé:</b> </h5> 
       </div>
      <div class="widget-body">
              <table class="table table-bordered table-condensed col-sm-12 w-auto">
                <thead class="thead-light">
                  <tr>
                    <th colspan ="2" style="height:40px"><p class="text-center"><b>Identification</b></p></th>	
                    <th colspan ="2" style="height:40px"><p  class="text-center"><b>Informations</b></p></th>
                  </tr>
                </thead>
                <tbody>
                          <tr>
                                <td  class ="noborders"><b>Nom :</b></td><td colspan="1">{{ $employe->nom }}</td>
                                <td class ="noborders"><b>Prenom:</b></td> <td>{{ $employe->prenom }}</td>
                          </tr>
                          <tr>
                                  <td class ="noborders"><b>Genre:</b></td><td>@if( $employe->sexe == 'F' ) Féminin @else Masculin @endif </td>
                                   <td class ="noborders"><b>Adress:</b></td><td>{{ $employe->Adresse }}</td>
                          </tr>
                          <tr>
                                 <td class ="noborders"><b><b>Email :</b></b></td><td> {{ $user->email }}</td>
                                  <td class ="noborders"><b>Rôle :</b></td> <td> {{ $user->role->role }}</td>
                          </tr>
                          <tr>
                                  <td class ="noborders"><b>Tél Fixe :</b></td>   <td>{{ $employe->Tele_fixe }}</td>
                                  <td class ="noborders"><b>Mob:</b></td> <td>{{ $employe->tele_mobile }}</td>
                          </tr>
                          <tr>
                                  <td  class ="noborders"><b>Service :</b></td>
                                     <td>
                                            @isset($employe->Service)
                                               {{ $employe->Service->nom }}
                                               @endisset
                                      </td>
                                   <td  class ="noborders"><b>Compte :</b></td><td>@if( $user->active == '1' )<span class="label label-md label-primary"> Active @else <span class="label label-md label-warning">Désactiver @endif </span></td>
                            </tr>            
                </tbody>
              </table>
        </div>
</div>
    