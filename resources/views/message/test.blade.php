<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{config('pusher.pusher_key')}}', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('test-channel');
        channel.bind('test-event', function(data) {
            alert(JSON.stringify(data));
        });

    </script>
</body>

</html>
