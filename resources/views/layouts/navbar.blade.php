<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.btn {
  background-color: #218838; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 16px; /* Some padding */
  font-size: 16px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: #155724;
  color: #a29d9d;
}
</style>

<nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
 <div class="container">
     <a class="navbar-brand" href="{{ url('/') }}" style="color:white"> <button class="btn"><i class="fa fa-home"></i> Home</button> </a>
 <a class="navbar-brand" href="{{ route('comments') }}" style="color:white"><button class="btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Dodaj notkę</button> </a>
 <a class="navbar-brand" href="{{ route('debtor') }}" style="color:white"><button class="btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Dodaj dłużnika</button> </a>
 <button class="navbar-toggler" type="button" data-toggle="collapse"
 data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
 aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
 <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <!-- Left Side Of Navbar -->
 <ul class="navbar-nav mr-auto"> </ul>
 <!-- Right Side Of Navbar -->
 <ul class="navbar-nav ml-auto">
 <!-- Authentication Links -->
 @guest
 <li class="nav-item">
 <a class="nav-link" href="{{ route('login') }}" style="color:white">{{ __('Login') }}</a>
 </li>
 @if (Route::has('register'))
 <li class="nav-item">
 <a class="nav-link" href="{{ route('register') }}" style="color:white">{{ __('Register') }}</a>
 </li>
 @endif
 @else
 <li class="nav-item dropdown">
 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
 role="button" data-toggle="dropdown" aria-haspopup="true"
 aria-expanded="false" v-pre>
 {{ Auth::user()->name }} <span class="caret"></span>
 </a>
 <div class="dropdown-menu dropdown-menu-right"
 aria-labelledby="navbarDropdown">
 <a class="dropdown-item" href="{{ route('logout') }}"
 onclick="event.preventDefault();
 document.getElementById('logout-form').submit();">
 {{ __('Logout') }} </a>
<form id="logout-form" action="{{ route('logout') }}"
 method="POST" style="display: none;">
 @csrf
 </form>
 </div>
 </li>
 @endguest
 </ul>
 </div>
 </div>
</nav>