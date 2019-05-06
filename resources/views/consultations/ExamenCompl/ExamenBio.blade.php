<div class="col-sm-18 widget-container-col ui-sortable" id="widget-container-col-13">
<div class="widget-box transparent ui-sortable-handle" id="widget-box-13">
<div class="widget-header">
<h4 class="widget-title lighter"></h4>
<div class="widget-toolbar no-border">
	<ul class="nav nav-tabs" id="myTab2">
	@foreach($specialitesExamBiolo as $specialite)
	<li class="">
		<a data-toggle="tab" href="#{{ $specialite->specialite }}"><strong>{{ $specialite->specialite }}</strong></a>
	</li>
	@endforeach
		{{-- <li class="active">
			<a data-toggle="tab" href="#home2">Home</a>
		</li>
		<li>
			<a data-toggle="tab" href="#profile2">Profile</a>
		</li>
		<li>
			<a data-toggle="tab" href="#info2">Info</a>
		</li> --}}
	</ul>
	</div>
	</div>
		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
			<div class="tab-content padding-4">
			<div id="home2" class="tab-pane in active">
			<div class="scrollable-horizontal ace-scroll" data-size="800" style="position: relative; padding-top: 12px;">
			<div class="scroll-track scroll-hz scroll-top scroll-active" style="display: block; width: 482px;">
			<div class="scroll-bar" style="width: 290px; left: 0px;">
				
			</div>
			</div>
			<div class="scroll-content" style="max-width: 800px;"><div style="width: 800px;">
			<b>Horizontal Scroll</b>
			blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
			</div></div></div>
			</div>
			<div id="profile2" class="tab-pane">
			<div class="scrollable ace-scroll" data-size="100" data-position="left" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div>
			<div class="scroll-content" style="max-height: 100px;">
			<b>Scroll on Left</b>
			ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed 											</div>
			</div>
			</div>

			<div id="info2" class="tab-pane">
			<div class="scrollable ace-scroll" data-size="100" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div><div class="scroll-content" style="max-height: 100px;">
				<b>Scroll # 3</b>
			nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
			</div></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>