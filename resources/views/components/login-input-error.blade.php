@props(['message' => ''])
<style>
    .login-input-error {
        font-family: 'IBM Plex Sans';
        font-size: 14px
    }
</style>

<div class="text-danger login-input-error"><strong> {{ $message }} </strong>
</div>
