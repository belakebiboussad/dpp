<div class="widget-box transparent">
      <div class="widget-header widget-header-flat widget-header-small">
               <h5 class="widget-title"><strong> Résumé:</strong> </h5> 
       </div>
      <div class="widget-body">
              <table class="table table-bordered table-condensed col-sm-12 w-auto">
                <thead class="thead-light">
                  <tr>
                    <th colspan ="2" style="height:40px"><p class="text-center"><strong>Identification</strong></p></th>	
                    <th colspan ="2" style="height:40px"><p  class="text-center"><strong>Informations</strong></p></th>
                  </tr>
                </thead>
                <tbody>
                          <tr>
                                <td  class ="noborders"><strong>Nom :</strong></td><td colspan="1">{{ $employe->nom }}</td>
                                <td class ="noborders"><strong>Prenom:</strong></td> <td>{{ $employe->prenom }}</td>
                          </tr>
                          <tr>
                                  <td class ="noborders"><strong>Genre:</strong></td><td>@if( $employe->sexe == 'F' ) Féminin @else Masculin @endif </td>
                                   <td class ="noborders"><strong>Adress:</strong></td><td>{{ $employe->Adresse }}</td>
                          </tr>
                          <tr>
                                 <td class ="noborders"><strong><strong>Email :</strong></strong></td><td> {{ $user->email }}</td>
                                  <td class ="noborders"><strong>Rôle :</strong></td> <td> {{ $user->role->role }}</td>
                          </tr>
                          <tr>
                                  <td class ="noborders"><strong>Tél Fixe :</strong></td>   <td>{{ $employe->Tele_fixe }}</td>
                                  <td class ="noborders"><strong>Mob:</strong></td> <td>{{ $employe->tele_mobile }}</td>
                          </tr>
                          <tr>
                                  <td  class ="noborders"><strong>Service :</strong></td>
                                     <td>
                                            @isset($employe->Service)
                                               {{ $employe->Service->nom }}
                                               @endisset
                                      </td>
                                   <td  class ="noborders"><strong>Compte :</strong></td><td>@if( $user->active == '1' )<span class="label label-md label-primary"> Active @else <span class="label label-md label-warning">Désactiver @endif </span></td>
                            </tr>            
                </tbody>
              </table>
        </div>
</div>
    