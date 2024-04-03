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
		<h1 class ="text-center">New Invitaion Mail</h1>
    Hello ({{$invitation->supplier_name}})
  From ({{$invitation->invitedBy->company->name}}) we are pleased to invite you to the management platform for business security, with the aim of improving our coordination in work
processes.
You can access the platform through this link: <a href ="{{route('client.invitation.accept',$invitation->id)}}">http://chessmafia.com/php/SEAT/supplier/login </a> To access, you must enter the following data:
• Username: {{ $invitation->email}}
• Password: {{$invitation->password}}
Remember to change the password at your first login.You have 15 days to complete access to the platform, after this time the invitation will expire.
Sincerely,
{{$invitation->invitedBy->getFullName()}},
{{$invitation->invitedBy->job_title}} of {{$invitation->invitedBy->company->name}}
		
	</div>
</div>
</body>
</html>		
+