@extends('layout.default')

@section('content')
<div id="app">

  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">

        </button>



          <router-link :to="'dashboard'" class="navbar-brand">
            <img alt="" width="160" src="../img/keytalentwtc.png">
          </router-link>

        <ul class="nav navbar-nav navbar-right">

        </div>
      </div>
    </div>

    <br><br>

    <div class="container">
      <br><br>
      <a-menu v-if="loggedUser()">
      </a-menu>
       <router-view></router-view>

    </div>
   </div>

   <script src="{{ elixir('js/app.js') }}"></script>

   @stop
