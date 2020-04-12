{{ $rdv->employe->Nom_Employe}} {{ $rdv->employe->Prenom_Employe}}

{{ $rdv->getEmploye()->Nom_Employe}} {{ $rdv->getEmploye()->Prenom_Employe}}

@foreach($rdvs as $rdv)
                       {
                          title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                          start : '{{ $rdv->Date_RDV }}',
                          end:   '{{ $rdv->Fin_RDV }}',
                          id :'{{ $rdv->id }}',
                          idPatient:'{{$rdv->patient->id}}',
                          tel:'{{$rdv->patient->tele_mobile1}}',
                          age:{{ $rdv->patient->getAge() }},
                          specialite: {{ $rdv->specialite}},
                          medecin : (isEmpty({{ $rdv->Employe_ID_Employe }}))? "a": 's',
                          fixe:  {{ $rdv->fixe }},
                       },
                        @endforeach 	