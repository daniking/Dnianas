<title>{{ $user->first_name }} {{$user->last_name}} </title>
<ul>
    <li>First name: <strong>{{ $user->first_name }}</strong>   </li>
    <li>Last name:  <strong>{{ $user->last_name }}</strong> </li>
    <li>Birthday: <strong>{{ $user->birthday }}</strong> </li>
    <li>Address: <strong>{{ $user->about->address }}</strong> </li>
    <li>Job Title: <strong>{{ $user->about->job_title }}</strong> </li>
    <li>{{ $user->about->about }}</li>
</ul>