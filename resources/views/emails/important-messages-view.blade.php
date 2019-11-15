@component("mail::message")
    @if($msg->message)
        <p>
            سلام عليكم رسالة من احد المتظاهرين :
            "{{$msg->message}}"
        </p>
    @endif
    <p><b> ارسلت الى قاعدة البيانات: {{$msg->created_at}}
            <br>
        </b>
        ارسلت بالبريد الالكتروني :{{$msg->important_message_sent_at}}</p>
@endcomponent
