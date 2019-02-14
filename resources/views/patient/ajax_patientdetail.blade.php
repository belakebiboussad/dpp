<div class="container-fluid">

        <div class="page-header bg-success" style="height:40px;" >
                 <h5 class ="w-25"><strong>Resumé du&nbsp;</strong><q>{{ $patient->Nom}} {{ $patient->Prenom }}</q></h5>
         </div>
         <table class="table table-bordered table-condensed col-sm-12 w-auto">
          <thead class="thead-light">
            <tr>
                    <th colspan ="2" style="height:40px"><p class="text-center"><strong>Patient</strong></p></th>	
                     <th colspan ="2" style="height:40px"><p  class="text-center"><strong>Assuré</strong></p></th>
            </tr>
           </thead>
            <tbody>
                     <tr>
                                <td colspan="1" class ="noborders"><strong>nom:</strong></td>
                                <td colspan="1">{{ $patient->Nom }}</td>
                                <td colspan="1" class ="noborders"><strong>prenom :</strong></td>
                                <td colspan="1">{{ $patient->Prenom }}</td>
                     </tr>
                     <tr>
                           	<td colspan="1" class ="noborders"><strong><strong>Né(e) le :</strong></strong></td>
                           	<td> {{ $patient->Dat_Naissance }}</td>
                           	<td  colspan="1" class ="noborders"><strong>Né(e) a:</strong></td><td>{{ $patient->Lieu_Naissance }}</td>
               	     </tr>
         		     <tr>
                           <td colspan="1" class ="noborders"><strong>Sexe :</strong></td>
                     	     <td>@if ( $patient->Sexe == 'F' ) Femme   @else  Homme @endif </td>
                           <td colspan="1" class ="noborders"><strong>Civilité:</strong></td>
                        	<td>{{ $patient->situation_familiale }}</td>
               	</tr>
               	<tr>
                           <td colspan="1" class ="noborders"><strong>Adr :</strong></td>
                     	      <td>{{ $patient->Adresse }}</td>
                           <td class ="noborders"><strong>Mob1:</strong></td>
                           <td>{{ $patient->tele_mobile1 }}</td>
               	</tr>	
                <tr>
                          <td colspan="1" class ="noborders"><strong>Mob2 :</strong></td>
                          <td>{{ $patient->tele_mobile2 }}</td>
                          <td class ="noborders"><strong>NSS:</strong></td>
                          <td>{{ $patient->NSS }}</td>
                </tr> 
                <tr>
                          <td colspan="1" class ="noborders"><strong>Sang :</strong></td>
                          <td>{{ $patient->group_sang }}{{ $patient->rhesus }}</td>
                          <td class ="noborders"><strong>Type:</strong></td>
                          <td>{{ $patient->Type }}</td>
                </tr>           
            </tbody>
         </table>
 </div>           