@extends('layouts.home')

@section('content')
<div class="container">
  <div id="form" class="row justify-content-md-center">

    <div class="col-lg-10">

      @if(session('success'))
      <div id="alert-form" class="alert alert-success">{{session('success')}}</div>
      @endif

      @if(session('error'))
      <div id="alert-form" class="alert alert-danger">{{session('error')}}</div>
      @endif
      <!-- /.form -->
      <a href="{{ url()->previous() }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z" />
        </svg>
        Back
      </a>
      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          Connexion
        </div>
        <div class="card-body">

          <form action="{{ route('post.login') }}" method="post">

            @csrf

            <div class="col-12">
              <label for="email" class="form-label"><br>Email</label>
              <input type="email" class="form-control" name="email" placeholder="Your email" value="{{old('email')}}">
              @error('email')
              <div class="error">{{$message}}</div>
              @enderror
            </div>
            <div class="col-12">
              <label for="password" class="form-label"><br>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Your password">
              @error('password')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12">
              <br><button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
          </form>
          <div class="col-12">
            <p><a href="{{ route('register') }}">S'inscrire</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.form -->

@stop