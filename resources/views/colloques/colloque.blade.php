@extends('app_dele')
@section('main-content')

<div class="col-xs-12 page-header">
	<div class="col-xs-12">
		<h1>
			Colloque de la semaine
		</h1>
	</div>

</div><!-- /.page-header -->	
<form id="creat_col" class="form-horizontal" role="form" method="POST" action="{{route('colloque.store')}}">{{ csrf_field() }} 
<div class="col-xs-12">
	<select id="elt" multiple="multiple" name="elt[]" hidden="">
	</select>
	
		<div class="col-xs-6">
			<label for="liste_membre">Membres du colloque:</label>&nbsp;
			<select id="liste_membre" data-placeholder="sélectionner les membres..."  style="width: 300px ">
				<option value="" selected disabled>sélectionner les membres...</option>
				@foreach( $membre as $membres)
				<option id="id_membre" value="{{$membres->id}}" >{{$membres->Nom_Employe}} {{$membres->Prenom_Employe}}
				</option>
				@endforeach
			</select> 
			
			<div>
				<br/>
				<label for="date_colloque">Date du colloque:</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<input class="date-picker" id="date_colloque" name="date_colloque" placeholder="Veuillez selectionner la date prévue du colloque" type="text" data-date-format="yyyy-mm-dd" required style="width: 300px"/>
			</div>
			<div>
				<br/>
				<label for="type_colloque">Type du colloque:</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<select id="type_colloque" name="type_colloque" data-placeholder="sélectionner le type..."  style="width: 300px " required>
				<option value="" selected disabled>sélectionner le type...</option>
				@foreach( $type_c as $type)
				<option id="id_type" value="{{$type->id}}" >{{$type->type}}
				</option>
				@endforeach
			</select>
			</div>	
		</div>
		<div class="col-xs-6">
			<textarea id="choix_membre" style="width: 500px" resize="none" readonly required></textarea>

			<div class="col-md-offset-6 col-md-7"><br/>
				<button class="btn btn-success" type="submit" >
					<i class="ace-icon fa fa-check bigger-110"></i>
				    Créer
				</button>
					&nbsp; &nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Réinitialiser
				</button>
			</div>
		</div>
</div><hr>
</form>		
@endsection