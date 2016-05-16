<!DOCTYPE html>
<html lang="en-US">
	<head>

		<meta charset="utf-8">
	</head>
	<body>
		<div>
			<p>Dear Customer Support Team,</p>
			<p>Please find the details of the support request below.</p>
			<p>Support category: {{$payload['subject']}} </p>
			<p>Support message: {{$payload['comment']}} </p>
			<p>User's email: {{$payload['cc']}} </p>
			<p>User's contact number: {{$payload['contact']}} </p>
			<p>Thank You</p>
			<p>Traveller App</p>

		</div>
	</body>
</html>
