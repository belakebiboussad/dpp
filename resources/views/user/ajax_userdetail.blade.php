<div class="widget-box transparent">
  <div class="widget-header widget-header-flat widget-header-small">
    <h5 class="widget-title">Résumé</h5> 
  </div>
  <div class="widget-body">
    <table class="table table-bordered table-condensed col-sm-12 w-auto">
      <thead class="thead-light">
        <tr>
          <th class="text-center" colspan ="4"><b>Informations utilisateur</b></th>
         </tr>
      </thead>
      <tbody>
      <tr>
        <td  class ="noborders"><b>Nom :</b></td><td colspan="1">{{ $employe->nom }}</td>
        <td class ="noborders"><b>Prenom:</b></td> <td>{{ $employe->prenom }}</td>
      </tr>
      <tr>
        <td class ="noborders"><b>Genre:</b></td><td>{{($employe->sexe == 'F')? 'Féminin':'Masculin'}}
        </td>
         <td class ="noborders"><b>Adress:</b></td><td>{{ $employe->Adresse }}</td>
      </tr>
      <tr>
        <td class ="noborders"><b><b>Email :</b></b></td><td> {{ $user->email }}</td>
        <td class ="noborders"><b>Rôle :</b></td> <td> {{ $user->role->nom }}</td>
      </tr>
      <tr>
        <td class ="noborders"><b>Tél Fixe :</b></td>   <td>{{ $employe->Tele_fixe }}</td>
        <td class ="noborders"><b>Mob:</b></td> <td>{{ $employe->tele_mobile }}</td>
      </tr>
      <tr>
        <td class ="noborders"><b>Service :</b></td><td>{{ $employe->Service->nom ?? ''}}</td>
        <td  class ="noborders"><b>Compte :</b></td><td>@if( $user->active == '1' )<span class="label label-md label-primary"> Active @else <span class="label label-md label-warning">Désactiver @endif </span></td>
        </tr>            
        </tbody>
              </table>
        </div>
</div>
    