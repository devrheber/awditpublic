<!DOCTYPE html>
<html>
  <body>
    <h2>{{ __('message.Welcome to the site')}}</h2>
    <br/>
    {{ __('message.Your registered email-id is')}} :-> {{ $email }} , <br/>
    {{ __('message.Your password is')}}  :-> {{ $password }} , <br/>
    {{ __('message.Please click on the below link to login in your account')}} <br/>
    <br/>
    <a href="{{ route('login')}}">{{__('message.login to plateform')}}</a>
    <p> 
      {{ __('message.If you click and any not perform any action then please click on this link') }}
      <a href="http://chessmafia.com/php/SEAT/login"> http://chessmafia.com/php/SEAT/login </a>
    </p>
  </body>
</html>