<div class="tabpanel">
	<ul class = "nav nav-pills nav-justified navbar-custom list-group" role="tablist" id ="intero">
			 <li role= "presentation" name="motif" class="active">
			    <a href="#Motif" aria-controls="Motif" role="tab" data-toggle="tab" class="jumbotron">
			       <i class="fa fa-comment fa-2x pull-left"></i><span class="bigger-130"> Motif de consultation</span>
				  </a>
			</li>
			<li role= "presentation">
				<a href="#ATCD" aria-controls="ATCD"  data-toggle="tab" class="jumbotron">
					<i class="fa fa-history fa-2x pull-left"></i><span class="bigger-130">Antécédents</span>
				</a>
			</li>
	</ul>
	<div class="row">
		<div class= "col-sm-9">
			<div class ="tab-content"  style = "border-style: none;">
				<div role="tabpanel" class = "tab-pane in active" id="Motif">@include('consultations.motif')</div>
				<div role="tabpanel" class = "tab-pane" id="ATCD">@include('consultations.Antecedant')</div>
			</div>
		</div><!-- col-sm-9	 -->
		<div class= "col-sm-3"><div>@include('consultations.actions')</div></div>
	</div><!-- row -->
</div>