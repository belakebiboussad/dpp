@extends('app')
@section('main-content')
<div class="page-header">
	<h1><strong>Settings :</strong></h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
		<form role="form" method="POST" action="{{ url('/user/updatepro') }}">
			{{ csrf_field() }}
			<div class="center">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nom">
						<strong> Nom </strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="nom" name="nom" placeholder="Nom" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<br/><br/><br/>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="prenom">
						<strong> Prénom </strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="prenom" name="prenom" placeholder="Prénom" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<br/><br/>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="datenaissance">
						<strong> Date Naissance </strong>
					</label>
					<div class="col-sm-9">
						<input class="col-xs-10 col-sm-5 date-picker" id="datenaissance" name="datenaissance" placeholder="Date Naissance" type="text" data-date-format="yyyy-mm-dd"/>
					</div>
				</div>
				<br/><br/>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="lieunaissance">
						<strong> Lieu Naissance </strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu Naissance" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<br/><br/>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="lieunaissance">
						<strong>Genre :</strong>
					</label>
					<div class="col-sm-9">
						<label>
							<input name="sexe" type="radio" class="ace" />
							<span class="lbl"> Masculin</span>
						</label>
						<label>
							<input name="sexe" type="radio" class="ace" />
							<span class="lbl"> Féminin</span>
						</label>
					</div>
				</div>
			</div>
			<div class="center">
              <button class="btn btn-info" type="submit" style="margin-top:10px">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Valider 
              </button>&nbsp; &nbsp; &nbsp;
              <button class="btn" type="reset" style="margin-top:10px">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Réinitialiser
              </button>
            </div>
		</form>
	</div>
</div>
@endsection