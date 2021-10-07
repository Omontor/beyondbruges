<center>
<img src="{{env('APP_URL')}}/newIcon.jpg" class="fluid" style="max-width: 600px;">
</center>
  <h1 class="display-3">Hi, {{ $name }}!, Thanks for joining Beyond Bruges</h1>
  <p class="lead"><strong>Your account has been created succesfully</strong> Now you can start using our app.</p>
  <p>Your user data is:
    <br>
  Name:{{ $name }}
  <br>
  Email: {{$email}}
  <br>
  Password: {{$password}}
  </p>
  <p>Use these values to login to Beyond Bruges App</p>
  <hr>
  <p>
   This is your personal QR code. Remember to keep it safe because you'll need it for Bryghia transactions.
   This QR can also be accessed within the app.
  </p>
  <small>If you have any questions please feel free to reach us at "hello@beyondbruges.be" or www.beyondbruges.be where you can find o</small>
  <p class="lead">
   <img src="{{env('APP_URL')}}/storage/qrcodes/{{$id}}.svg" width="100%">
  </p>
