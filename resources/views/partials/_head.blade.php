<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Blog | @yield('title') </title>
<link rel="stylesheet" href="/css/bootstrap.css">
<!--<link rel="stylesheet" href="/css/fontawesome.css">-->
<link rel="stylesheet" href="/css/admin_style.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="/js/jQuery.js"></script>

<style>
   html,body {position: relative;min-height:1000px;}
</style>
@yield('style')