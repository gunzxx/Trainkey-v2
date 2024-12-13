<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <button id="send">Tes</button>
    <script src="/js/pusher.min.js"></script>
    {{-- <script src="/js/echo.min.js"></script> --}}


    <script>
        var pusher = new Pusher('local', {
            cluster: 'mt1',
            wsHost: 'localhost',
            wsPort: 6001,
            forceTLS: false
        });

        var channel = pusher.subscribe('forum');
        channel.bind('message', function(data) {
            console.log(data);
        });

        const sendButton = document.getElementById('send');
        sendButton.addEventListener('click', (event) => {
            fetch('/api/emit-event', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    message: 'Hello from client'
                }),
            }).then(async (result) => {
                console.log(await result.json());
            }).catch((err) => {
                console.log(err);
            });;
        });
    </script>
</body>

</html>
