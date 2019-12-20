<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('icofont/icofont.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('dataTable/dataTable.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/style.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/deblaa.png') }}" type="image/x-icon">
    @yield('css')
    <title>Deblaa</title>
</head>
<body>

    @yield('sideBar')
    @yield('inboxs')
    @yield('connexion')
    @yield('home')

    <!-- Start of LiveChat (www.livechatinc.com) code -->
    <script type="text/javascript">
	window.__lc = window.__lc || {};
	window.__lc.license = 11608088;
	(function() {
	    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
	    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
	})();
    </script>
<noscript>
<a href="https://www.livechatinc.com/chat-with/11608088/" rel="nofollow">Chat with us</a>,
powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>
<!-- End of LiveChat code -->

    <script src="{{ URL::asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/mdb.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('dataTable/jquery.dataTable.min.js') }}"></script>
    <script src="{{ URL::asset('dataTable/dataTable.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    @yield('script')
    
</body>
</html>
