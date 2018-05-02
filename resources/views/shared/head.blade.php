<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>
 @if (trim($__env->yieldContent('template_title')))
   @yield('template_title') | 
 @endif 
 {{ config('app.name', Lang::get('titles.app')) }}
</title>
<meta name="description" content="Online Learning Marketplace">
<meta name="author" content="EduTube">
<link rel="shortcut icon" href="/favicon.ico">
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">

<!-- Bootstrap CDN -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Fontawesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<!-- Jquery CDN JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap CDN JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

<script type="text/javascript">
	window.Laravel = {!! json_encode([
	    'csrfToken' => csrf_token(),
	]) !!};
</script>