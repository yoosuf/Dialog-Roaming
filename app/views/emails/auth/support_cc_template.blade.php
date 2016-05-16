<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>

			<p>Dear {{$payload['user_name']}},</p>
			<p>Thank you for your support request. The Customer Support team will get in touch with you soon.</p>
			<p>Support category: {{$payload['subject']}} </p>
			<p>Support message: {{$payload['comment']}} </p>
			<p>Thank You</p>
			<p>Customer Support</p>
					<small>This is an automated email. Please refrain from replaying.</small>
		</div>
	</body>
</html>
