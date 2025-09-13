<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OrderEmail</title>
</head>
<body style="font-family :arial, helvetica, sans-serif; font-size:16px;">
    <p> Hello , {{ $formData['user']->name }}</p>
    <h1>You have reuested to change password </h1>
    <p>Please click on the link below to change password</p>

    <a href="{{ route('front.resetPassword',$formData['token'])}}">click here</a>
     <p>Thanks </p>
</body>
</html>

