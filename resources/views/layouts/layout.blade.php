<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="csrf" value="{{ csrf_token() }">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<title>推廣優惠後台</title>
		<!-- Google-Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>
	<!-- Bootstrap Core CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/prettify.css" />
	<!-- Custom CSS -->
	<link href="/css/styles.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	@yield('style')
</head>
<body style="height: 100%;">
	
	<div id="wrapper"  style="min-height: 90%;position: relative;">
		<nav class="navbar navbar-default navbar-fixed-top" style="height: 40px;box-sizing: border-box;">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand" href="#">推廣優惠app後台</a>
				</div>
			</div>
		</nav>
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li>
					<a href="/class/list">類別管理</a>
				</li>
				<li>
					<a href="/shop/list">商家管理</a>
				</li>
				<li>
					<a href="/member/list">密碼更改</a>
				</li>
				<li>
					<a href="/logout">登出</a>
				</li>
			</ul>
		</div>
		<div id="page-content-wrapper">
			<div class="container-fluid" style="padding-bottom: 40px;">
			@yield('main_content')
			</div>
		</div>
		<footer class="text-center" style="height: 40px;box-sizing: border-box;position: absolute;width: 100%; bottom: 0;">
			<p class="copy">Copyright © 2017 stevia-network</p>
		</footer>
	</div>

	<script src="/js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/js/prettify.js"></script>
	<!-- Menu Toggle Script -->
	<script>
		//jQuery for page scrolling feature - requires jQuery Easing plugin
		$(function() {
		    $('.sidebar-nav a').bind('click', function(event) {
		        var $anchor = $(this);
		        $('html, body').stop().animate({
		            scrollTop: $($anchor.attr('href')).offset().top - 100
		        }, 1500, 'easeInOutExpo');
		        event.preventDefault();
		    });
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
				});
		});
	</script>
	@yield('script')
</body>
</html>