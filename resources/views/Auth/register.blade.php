@extends('layouts.home')

@section('content')
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-10">

      @if(session('success'))
      <div id="alert-form" class="alert alert-success">{{session('success')}}<i class="fas fa-user-check"></i></div>
      @endif

      <!-- /.form -->
      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          Inscription
        </div>
        <div class="card-body">

          <form action="{{ route('post.register') }}" method="post">

            @csrf

            <div class="col-12">
              <label for="nickname" class="form-label"><br>Nickname</label>
              <input type="text" class="form-control" name="nickname" placeholder="Your nickname"
                value="{{old('nickname')}}">
              @error('nickname')
              <div class="error">{{$message}}</div>
              @enderror
            </div>
            <div class="col-12">
              <label for="email" class="form-label"><br>Email</label>
              <input type="email" class="form-control" name="email" placeholder="Your email" value="{{old('email')}}">
              @error('email')
              <div class="error">{{$message}}</div>
              @enderror
            </div>
            <div class="col-12">
              <label for="birthdate" class="form-label"><br>Birthdate</label>
              <input type="date" class="form-control" name="birthdate" placeholder="Your birthdate"
                value="{{old('birthdate')}}">
              @error('birthdate')
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
            <!-- <div class="col-12 mt-4" >
              <label for="avatar" class="form-label">Avatar</label>
              <input type="file" class="form-control" name="avatar">
              @error('avatar')
              <div class="error">{{$message}}</div>
              @enderror
            </div> -->

            <div class="col-12">
              <br><button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
          </form>
          <div class="col-12">
            <p><a href="{{ route('login') }}"><br>J'ai déjà un compte</a></p>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>


@stop