<!DOCTYPE html>
<html>
<head>
	<title>keytalent</title>
	<script src="/vendor/js/jquery.min.js"></script>
    <script src="/vendor/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/vendor/css/bootstrap.min.css" media="screen" title="no title">
</head>
<body >

<div id="app">
     <h1>Hello App!</h1>
  <p>
    <!-- use router-link component for navigation. -->
    <!-- specify the link by passing the `to` prop. -->
    <!-- <router-link> will be rendered as an `<a>` tag by default -->
    <router-link to="/foo">Go to Foo</router-link>
    <router-link to="/bar">Go to Bar</router-link>
  </p>
</div>
 <script src="{{ elixir('js/app.js') }}"></script>








</body>
</html>