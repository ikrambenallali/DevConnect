<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>test notification</h1>


    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        console.log('test');
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY ') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER ') }}",
            encrypted: true,
            disableStats: true,
            enabledTransports: ['ws']
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind("Illuminate\\Notifications\\Events\\BroadcastNotificationCreated", function(data) {

            console.log(data);

            alert(data);

        });
    </script>
</body>

</html>