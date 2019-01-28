@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
	var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
 	$(document).ready(function() {
    		$('#Date').datepicker({ startDate: today });
	});
</script>
@endsection
@section('main-content')
<input type="text" id="Date" value="" />
@endsection
