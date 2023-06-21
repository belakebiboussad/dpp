<div class="widget-box">
  <div class="widget-header"><h4 class="widget-title">Détails de la demande</h4></div>
  <div class="widget-body">
    <div class="widget-main">
      <div class="user-profile row">
        <div class="col-xs-12 col-sm-8 center">
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name">Date </div>
              <div class="profile-info-value"><span>{{ $demande->imageable->date->format('d/m/Y') }}</span></div>
            </div>
          </div>
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row"><div class="profile-info-name">Etat </div>
            <div class="profile-info-value">{!!$formatStat($demande->etat) !!}</div>
            </div>
          </div>
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row"><div class="profile-info-name"> Demandeur </div>
              <div class="profile-info-value"><span class="editable" id="username">{{ $demande->imageable->medecin->full_name }}</span></div>
            </div>
          </div>
        </div>
      </div>
    </div> {{-- "widget-main --}}
  </div>  {{-- body --}}
</div>