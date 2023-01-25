<div class="user-profile row">
  <div class="col-xs-12 col-sm-12 center">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name col-sm-3">Date</div>
        <div class="profile-info-value col-sm-9"><span class="editable">{{ $demande->date->format('Y-m-d') }}</span></div>
      </div>
      </div>
      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <div class="profile-info-name col-sm-3">Etat</div>
          <div class="profile-info-value col-sm-9">{!! format_stat($demande) !!}</div>
        </div>
      </div> 
      @if($demande->motif)
      <div class="profile-user-info profile-user-info-striped">
          <div class="profile-info-row">
            <div class="profile-info-name col-sm-3">Motif </div>
            <div class="profile-info-value col-sm-9"><span class="editable" id="username">{{ $demande->motif }}</span></div>
          </div>
      </div>
      @endif
      <div class="profile-user-info profile-user-info-striped">  
      <div class="profile-info-row">
        <div class="profile-info-name col-sm-3"> Service demandeur</div>
        <div class="profile-info-value col-sm-9">
          <span class="editable" id="username">{{ $demande->demandeur->Service->nom }}</span>
        </div>
      </div>
      </div>
      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <div class="profile-info-name col-sm-3">Demandeur</div>
          <div class="profile-info-value col-sm-9">
            <span class="editable" id="username">{{ $demande->demandeur->full_name }}</span>
          </div>
        </div>
      </div>
  </div>
</div>