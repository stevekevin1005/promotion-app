<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<title>推廣優惠後台</title>
		<!-- Google-Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>
	<!-- Bootstrap Core CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/prettify.css" />
	<!-- Custom CSS -->
	<link href="/css/styles.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="#">推廣優惠app後台</a>
			</div>
		</div>
	</nav>
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li>
					<a href="/class/list">類別管理</a>
				</li>
				<li>
					<a href="/shop/list">商家管理</a>
				</li>
				<li>
					<a href="/member/list">成員管理</a>
				</li>
			</ul>
		</div>
		<div id="page-content-wrapper">
			<div class="container-fluid">
			@yield('main_content')
			</div>
		</div>
		<div class="text-center">
			<p class="copy">Copyright © 2017 Stevia.</p>
		</div>
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
		});
	</script>
</body>
</html>