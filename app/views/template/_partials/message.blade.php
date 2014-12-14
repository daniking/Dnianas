@if(Session::has('message'))
    <div class="message">{{ Session::get('message') }}</div>
@endif