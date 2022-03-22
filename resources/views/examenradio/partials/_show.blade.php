<div class="widget-box">
        <div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4></div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
            <div class="col-xs-12">
              <div class="user-profile row">
                <div class="col-xs-12 col-sm-12 center">
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name col-sm-3">Date : </div>
                      <div class="profile-info-value col-sm-9">
                        <span>{{  (\Carbon\Carbon::parse($obj->date))->format('d/m/Y') }}</span>
                      </div>
                    </div>
                  </div><!-- striped -->
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name col-sm-3">Etat :</div>
                      <div class="profile-info-value col-sm-9">
                      <span class="badge badge-{{ ( $demande->getEtatID($demande->etat) == "0" ) ? 'warning':'primary' }}">{{ $demande->etat }}</span>
                      </div>
                    </div>
                  </div><!-- striped   -->
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name col-sm-3">Médecin demandeur : </div>
                      <div class="profile-info-value col-sm-9">
                        <span>{{ $obj->medecin->full_name }}</span>
                      </div>
                    </div>
                  </div><!-- striped   -->
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name col-sm-3">Informations cliniques pertinentes : </div>
                      <div class="profile-info-value col-sm-9">
                        <span>{{ $demande->InfosCliniques }}</span>
                      </div>
                    </div>
                  </div><!-- striped   -->
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name col-sm-3">Explication de la demande de diagnostic : </div>
                      <div class="profile-info-value col-sm-9">
                        <span>{{ $demande->Explecations }}</span>
                      </div>
                    </div>
                  </div><!-- striped   -->
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name col-sm-3">Informations supplémentaires pertinentes :</div>
                      <div class="profile-info-value col-sm-9">
                        <label class="blue">
                          <ul class="list-inline"> 
                          @foreach($demande->infossuppdemande as $index => $info)
                            <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                          @endforeach
                          </ul>    
                         </label>
                      </div>
                    </div>
                  </div><!-- striped   -->
                </div>
              </div>
            </div>
            </div>
          </div><!-- widget-main -->
        </div><!-- widget-body -->
     </div><!-- box -->