@if($errors->count())
    <blockquote class="error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach 
    </blockquote>
@endif