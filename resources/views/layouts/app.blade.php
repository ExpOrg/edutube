<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  @include('shared.head')
</head>
<body>
 @include('shared.header')
 @include('auth.register')
 @include('auth.login')
 @include('auth.passwords.email')
 <div id="page-content">
 <div class="fluid-container" style="margin-bottom: 60px">
	@yield('content')
 </div>
 </div>
 @include('shared.footer')
</body>
</html>