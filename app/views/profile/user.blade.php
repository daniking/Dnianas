<title>{{ $user->first_name }} {{$user->last_name}} </title>
<ul>
    <li>First name: <strong>{{ $user->first_name }}</strong>   </li>
    <li>Last name:  <strong>{{ $user->last_name }}</strong> </li>
    <li>Birthday: <strong>{{ $user->birthday }}</strong> </li>
    @if($user->about)
        <li>Address: <strong>{{ $user->about->address}}</strong> </li>
        <li>Job Title: <strong>{{ $user->about->job_title }}</strong> </li>
        <li>About: <strong>{{ $user->about->about }}</strong></li>
    @endif
</ul>

<br />
<br />

<h2>User posts</h2>
<hr>
@foreach($user->posts as $p) 
    <div>{{ $p->post_content }}</div>
@endforeach