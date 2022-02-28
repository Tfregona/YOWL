<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="icon" type="image/x-icon" href="{{ url('favicon.png') }}">

<div class="error" id="error">
<div class="text-center">
    <h1 class="h1">Champ not fund</h1>
    <a href="{{route('home.categories')}}"><img src="{{ url('favicon.png') }}" alt="Logo Yowl" width="600"></a>
    <p class="h1"> GO BACK TO HOME BY CLICKING THE LOGO </p>
</div>
</div>

<style>
    .error {
        margin-top: 75px;
        margin-left: auto;
        margin-right: auto;
        width: 50em
    }
</style>