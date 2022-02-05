<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $username }}さんからゴゴレルの招待が届いています</title>
</head>
<body>
    
<p>ゴゴレル からのご連絡です。</p>

<br>

<p>{{ $username }}さん({{ $useremail }})が、あなたを ゴゴレル に招待しています!</p>
<p>ゴゴレル はパラレルワーカーやフリーランサー、企業、エージェントを繋ぐマッチングサービスです。</p>

<div style="text-align: center;">
    <a href="{{ $link }}" style="text-decoration: none; color: black; font-weight: bold; background-color: #ebebeb; padding: 10px 20px; border-radius: 6px;">招待状を承諾する</a>
</div>

</body>
</html>