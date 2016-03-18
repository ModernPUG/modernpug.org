<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
<link rel="icon" href="/favicon.ico">
<title>@yield('title')</title>
<!-- Bootstrap core CSS -->
<link href="/vendor/ninecells/assets-twbs3/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="/vendor/ninecells/assets-twbs3-jbtrn-narrow/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<link rel="stylesheet" href="/css/fonts.pkgd.css">
<link rel="stylesheet" href="/css/app.pkgd.css">
@yield('head')
</head>
<body>
<main>
	@yield('header')
	<div class="container contents">
		@yield('content')
	</div>
	@yield('footer')
</main>

<script src="/js/vendor.pkgd.js"></script>
<script>
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

// toggle search form
$('.header .search-bar a').on('click', function(){
	var $li = $(this).parent();
	$li.toggleClass('active');
	if ($li.hasClass('active'))
	{
		$li.find('input[type=text]').focus();
	}
});
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/vendor/ninecells/assets-twbs3-jbtrn-narrow/js/ie10-viewport-bug-workaround.js"></script>
@yield('script')
</body>
</html>