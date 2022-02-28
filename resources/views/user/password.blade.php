@extends('layouts.home')

@section('content')

<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-10">

      @if(session('success'))
      <div id="alert-form" class="alert alert-success">{{session('success')}}</div>
      @endif
      <!-- /.card -->
      <a href="{{ route('user.profile') }}" class="link-info"><svg xmlns="http://www.w3.org/2000/svg" width="16"
          height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z" />
        </svg>Return to your profile page</a>
      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          Modifier mon mot de passe
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('update.password') }}">
            @csrf
            @method('POST')
            <div class="col-12 mt-4">
              <label for="current" class="form-label">Mot de passe actuel</label>
              <input type="password" class="form-control" name="current">
              @error('current')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12 mt-4">
              <label for="password" class="form-label">Nouveau mot de passe</label>
              <input type="password" class="form-control" name="password">
              @error('password')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12 mt-4">
              <label for="password_confirm" class="form-label">Confirmation de mot de passe</label>
              <input type="password" class="form-control" name="password_confirm">
            </div>

            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
          </form>
          <div class="col-12 mt-4">
            <p><a href="{{ route('user.edit', $user->id) }}"><br>Revenir à mon profil</a></p>
            <div class="text-right">
              <form action="{{ route('user.destroy', $user->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="alert alert-danger">Supprimer le compte</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <style>
  .img_profile {
    /* margin-left: auto;
    margin-right: auto; */
    width: 600;
    justify-content: center;
  }
</style> -->