<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gogorel</title>
</head>
<body>
    <p>{{ $user_to->name }}さん</p>
    <br>
    <p>ゴゴレル運営局です。</p>
    <br>
    <p>{{ $user_from->name }}さん宛てにメッセージを受信しました。</p>
    <p>差出人:{{ $user_from->name }}さん</p>
    <br>
    <p>下記URLからご確認いただけますようお願いいたします。</p>
    <p><a href="{{ $link }}">{{ $link }}</a></p>
    <br>
    <hr>
    <p>◇このメールが不要の方◇</p>
    <p>ゴゴレルからのお知らせが不要な方は、下記ページから設定変更をお願いいたします。</p>
    <p>チャット画面左下の「メール通知設定について」をクリック→「受け取らない」を選択→「変更する」ボタンをクリック</p>
    <p><a href="{{ route('chat.setting') }}">{{ route('chat.setting') }}</a></p>
    <br>
    <p>◇このメールにお心当たりのない方◇</p>
    <p>お手数をおかけしますが、このまま削除をお願いいたします。</p>
    <hr>
    <br>
    <hr>
    <p>Scope株式会社</p>
    <p>〒104-0061 東京都中央区銀座一丁目22番11号 銀座大竹ビジデンス2階</p>
    <p>TEL: 03-6680-8680</p>
    <p>Email: <a href="mailto: info@scopecorp.co.jp">info@scopecorp.co.jp</a></p>
    <p>URL: <a href="https://scopecorp.co.jp/">https://scopecorp.co.jp/</a></p>
    <hr>
</body>
</html>