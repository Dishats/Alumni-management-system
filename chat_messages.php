<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni Chat Room</title>
    <style>
        .chat-container {
            width: 500%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .chat-messages {
            max-height: 400px;
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .chat-input {
            display: flex;
        }
        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .chat-input button {
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
</head>
<body><br>
<br><br>
<br>
<br>
    <div class="chat-container">
        <h2>Alumni Chat Room</h2>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-input">
            <input type="text" id="chatInput" placeholder="Type your message...">
            <button id="sendBtn">Send</button>
        </div>
    </div>

    
    <script>
        $(document).ready(function () {
    // Load chat messages on page load
    loadMessages();

    // Send message using AJAX
    $('#sendBtn').click(function () {
        var message = $('#chatInput').val();
        if (message.trim() !== '') {
            $.ajax({
                url: 'save_chat.php',
                method: 'POST',
                data: { message: message },
                success: function (response) {
                    try {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            $('#chatInput').val(''); // Clear the input
                            loadMessages(); // Reload chat messages
                        } else {
                            alert(res.message); // Display error message
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    });

    // Function to load messages
    function loadMessages() {
        $.ajax({
            url: 'load_messages.php',
            method: 'GET',
            success: function (data) {
                $('#chatMessages').html(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    // Poll for new messages every 3 seconds
    setInterval(loadMessages, 2000);
});


    </script>
    
</body>
</html>

