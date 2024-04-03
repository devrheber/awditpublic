<!DOCTYPE html>
<html>
  <body>
    <h2>{{ __('message.Welcome to the site')}}  {{$user->username}}</h2>
    <br/>
    {{ __('message.Your registered email-id is')}} {{$user['email']}} ,{{ __('message.Please click on the below link to verify your email account')}}
    <br/>
    <a href="{{url('client/verify', $user->verifyUser->token)}}">{{__('message.Verify Email')}}</a>
  </body>
</html>