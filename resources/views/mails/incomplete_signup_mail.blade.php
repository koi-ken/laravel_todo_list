
{{ $order->username }}様、今回は、ご利用ありがとうございます。

ただ、この登録は、まだ未完了です。
以下のURLに24時間以内にアクセスし、登録を完了してください。

<a href={{ getenv('TEMP_URL_HOST') }}/{{ $order->temp_url }}>{{ getenv('TEMP_URL_HOST') }}/{{ $order->temp_url }}</a>

ToDoリストより
