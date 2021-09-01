<center>
<img src="{{env('APP_URL')}}/newIcon.jpg" class="fluid" style="max-width: 600px;">
</center>
  <h1 class="display-3">Hi, {{ $name }}!, Tranks for joining Beyond Bruges</h1>
  <p class="lead"><strong>Your account has been created succesfully</strong> Now you can start using our app.</p>
  <p>Your user data is:
    <br>
  Name:{{ $name }}
  <br>
  Email: {{$email}}
  <br>
  Password: {{$password}}
  </p>
  <hr>
  <p>
   This is your personal QR code. Remember to keep it safe because you'll need it for Bryghia transactions.
   This QR can also be accessed within the app.
  </p>
  <p class="lead">
   <img src="{{env('APP_URL')}}/storage/qrcodes/{{$id}}.svg" width="100%">
  </p>
