@extends('app')
@section('main-content')
<form action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" id="exampleInputPassword1" placeholder="Password" class="form-control">
  </div>
  <div class="form-check">
    <input type="checkbox" id="exampleCheck1" class="form-check-input">
    <label for="exampleCheck1" class="form-check-label">Check me out</label>
  </div>
</form>
@endsection