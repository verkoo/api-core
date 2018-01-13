<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
    <div id="app">
        <tpv></tpv>
    </div>
</body>

<script>
  window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

@if(config('verkoo.hot_reload'))
    <script src="http://localhost:8080/main.js"></script>
@else
    <script src="{{ asset('js/main.js') }}"></script>
@endif

</html>
