
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


        </div>
      </div>
    </div>
    <br><br>


    <div class="container">

      <div class="area"></div>
      <nav class="main-menu">
        <br><br>
        <br><br>
              <ul>
                  <li>
                      <a href="#">
                          <i class="fa fa-home fa-2x glyphicon glyphicon-tasks"></i>
                          <span class="nav-text">
                              Dashboard
                          </span>
                      </a>

                  </li>
                  <li class="has-subnav">
                      <a href="#">
                          <i class="fa fa-laptop fa-2x glyphicon glyphicon-user"></i>
                          <span class="nav-text">
                              UI Components
                          </span>
                      </a>

                  </li>
                  <li class="has-subnav">
                      <a href="#">
                         <i class="fa fa-list fa-2x"></i>
                          <span class="nav-text">
                              Forms
                          </span>
                      </a>

                  </li>
                  <li class="has-subnav">
                      <a href="#">
                         <i class="fa fa-folder-open fa-2x"></i>
                          <span class="nav-text">
                              Pages
                          </span>
                      </a>

                  </li>


              </ul>

              <ul class="logout">
                  <li>
                     <router-link :to="'admins'">
                       <i class="fa fa-power-off fa-2x glyphicon glyphicon-off"></i>
                      <span class="nav-text">
                          Logout
                      </span>
                     </router-link>


                  </li>
              </ul>
          </nav>


      <br><br>


       <router-view></router-view>

    </div>


   </div>
   <script src="{{ elixir('js/app.js') }}"></script>

   @stop
