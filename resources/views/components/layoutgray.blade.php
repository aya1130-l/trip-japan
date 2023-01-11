<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no"> 
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"> <!--bladeファイルでは、自分がpublicディレクトリに存在しているかのように記述-->
    <script src="{{ mix('/js/app.js') }}" async defer></script> <!--mix()でキャッシュパスティング-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>{{ $title }}</title>
</head>

<body class="h-100vh bg-[#e6e6e6]">
    {{ $slot }}
</body>
</html>