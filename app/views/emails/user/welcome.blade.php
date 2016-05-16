<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Your Account has been created</h2>



<div>
Please use the following link to create a password.<br/>
    <br/><br/>


    To setup your password, complete this form: {{ URL::to('account/setup/'. $user->invitation_code) }}.<br/>





</div>
</body>
</html>
