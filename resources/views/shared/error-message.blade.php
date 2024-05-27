@foreach ($errors->all() as $error)
    <div class="message message__error">
        {{$error}}
    </div>
@endforeach
