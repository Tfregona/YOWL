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
          Inscription à la newsletter
        </div>
        <div class="card-body">

          <form action="{{ route('post.newsletter') }}" method="post">

            @csrf

            <div class="col-12">
              <label for="newsletter" class="form-label"><br>Email</label>
              <input type="email" class="form-control" name="newsletter" placeholder="Your email" value="{{old('newsletter')}}">
              @error('email')
              <div class="error">{{$message}}</div>
              @enderror
            </div>

            <div class="col-12">
              <br><button type="M'inscrire" class="btn btn-primary">M'inscrire</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>


@stop