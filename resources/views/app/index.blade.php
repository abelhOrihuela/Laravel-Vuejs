@extends('layout.default')

@section('content')
  <div id="app">
    <a-loading v-if="loading()"></a-loading>

    <div class="container">

      <div class="" v-if="loggedUser()">

          <router-link :to="'dashboard'" class="navbar-brand">
            <img alt="" width="160" src="../img/keytalentwtc.png">
          </router-link>
      </div>
      <br><br>
      <br>

      <a-menu v-if="loggedUser()">
      </a-menu>
      <router-view></router-view>

    </div>
  </div>


  <script src="js/app.js"></script>

@stop
