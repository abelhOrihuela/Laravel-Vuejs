@extends('layout.default')

@section('content')
  <div id="app">
    <div class="container">

      <div class="" v-if="loggedUser()">
        <li>
          <router-link :to="'dashboard'" class="navbar-brand">
            <img alt="" width="160" src="../img/keytalentwtc.png">
          </router-link>
        </li>
      </div>
      <br><br>
      <br>

      <a-menu v-if="loggedUser()">
      </a-menu>
      <router-view></router-view>

    </div>
  </div>

  <script src="{{ elixir('js/app.js') }}"></script>

@stop
