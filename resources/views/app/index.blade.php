
@extends('layout.default')

@section('content')
<div id="app">


  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <div class="navbar-collapse collapse">
    </div>
  </div>

  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

  </div>

  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <img alt="" width="160" src="../img/keytalentwtc.png">
        </a>
        <ul class="nav navbar-nav navbar-right">

          <router-link to="/candidates">candidates</router-link>
          <router-link to="/admins">admins</router-link>

        </div>
      </div>
    </div>
    <br><br>


    <div class="container">
      <br><br>


       <router-view></router-view>

    </div>


   </div>
   <script src="{{ elixir('js/app.js') }}"></script>

   @stop
