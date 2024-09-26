<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Notification</title>
</head>

<body>
    <h1>{{ $status === 'open' ? 'A New Support Ticket Has Been Opened' : 'Your Support Ticket Has Been Closed' }}</h1>

    <p><strong>Ticket Title:</strong> {{ $ticket->title }}</p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>

    @if ($status === 'open')
        <p>A new support ticket has been created by {{ $ticket->user->name }}.</p>
    @else
        <p>Your support ticket has been closed by our support team. If you have further questions, feel free to create a
            new one.</p>
    @endif

    <p>Thank you,<br>{{ config('app.name') }} Support Team</p>
</body>

</html>
