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
        </svg>Retourner sur votre profil</a>

      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          Modifier le profil {{ $user->nickname }}
        </div>

        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="col-12 mt-4">
              <label for="nickname" class="form-label">Nickname</label>
              <input type="text" class="form-control" name="nickname" value="{{($user->nickname)}}">
              @error('nickname')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12 mt-4">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" value="{{($user->email)}}">
              @error('email')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12 mt-4">
              <label for="avatar" class="form-label">Avatar</label>
              <input type="file" class="form-control" name="avatar">
              <!-- value="{{($user->email)}}" -->
              @error('avatar')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12 mt-4">
              <p>Your actual avatar :</p>
              @if(!empty($user->avatar->filename))
              <img src="{{asset($user->avatar->url)}}" width="400" class="rounded mx-auto d-block"
                alt="Photo de profil">
              @else
              <p>You have no avatar image</p>
              @endif
            </div>

            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
          </form>
            <div class="col-12 mt-4" >
            <p><a href="{{ route('forgotpw') }}"><br>Changer mon mot de passe</a></p>
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
</div>
@endsection