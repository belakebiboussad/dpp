 <div class="widget-box"><div class="widget-header"></div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
            <div class="col-xs-12">
              <div class="user-profile row">
              <div class="col-xs-12 col-sm-12 center">
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                    <div class="profile-info-name col-sm-3">Date </div>
                    <div class="profile-info-value col-sm-9">
                      <span>{{ $visite->date->format('d/m/Y') }}</span>
                    </div>
                  </div>
                </div>
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                    <div class="profile-info-name col-sm-3">Medecin :</div>
                      <div class="profile-info-value col-sm-9">{{ $visite->medecin->full_name }}</div>
                    </div>
                </div><!-- striped   -->
              </div>
            </div>
            </div><!-- col-xs-12 -->
          </div>
        </div>
      </div>  <!-- body -->
    </div>