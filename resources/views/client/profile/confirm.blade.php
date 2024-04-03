   <!DOCTYPE html>
<html lang="en">
<head>
   <title>Bootstrap Example</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="jumbotron">		
      <div class="card">
         <div class="card-header text-center">
            <h1 class ="text-center">New Invitaion Mail</h1>
         </div>
         <div class="card-body">
            <p>Hello {{ $user->email }}</p>
            <p>I am pleased to invite you to the {{ $user->invitedBy->company->name}} enterprise security management platform with the role {{$user->userRole->name}}.</p>
            <p>You can access the platform through this link <a href="{{ route('client.accept.role.request',$user->id) }}"> http://chessmafia.com/php/SEAT/login </a> To access, you must enter the following data</p>
            <ul>
               <li>Username: {{$user->email}}</li>
               <li>Password: {{$user->password}}</li>
            </ul>
            <p>Remember to change the password at your first login. You have 15 days to complete access to the platform, after this time the invitation will expire.</p>
            <p>Sincerely,</p>
            <p>{{$user->invitedBy->full_name}}, {{$user->invitedBy->job_title}} of {{$user->invitedBy->company->name}} Team. </p>
            
         </div>
      </div>
	</div>
</div>
</body>
</html>		


{{-- Client error: `POST https://api.mailgun.net/v3/sandboxdaf61bbb1c75414fa782bbb8cd582ee7.mailgun.org/messages.mime` resulted in a `401 UNAUTHORIZED` response:\nForbidden\n --}}