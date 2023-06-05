@extends('app')
@section('main-content')
<form action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group input-group input-group-xs">
        <span class="input-group-addon fa fa-at" id="email-addon"></span>
        <input class="form-control" type="email" name="email" required="required" placeholder="Email" value="{{ old('email') }}" aria-describedby="email-addon">
      </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" id="exampleInputPassword1" placeholder="Password" class="form-control">
    
  </div>
  <div class="form-check">
    <input type="checkbox" id="exampleCheck1" class="form-check-input">
    <label for="exampleCheck1" class="form-check-label">Check me out</label>
  </div>
  <hr>
      <button class="btn btn-block btn-lg btn-primary" type="submit">Login</button>
</form>
@stop