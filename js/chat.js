            submitMessages();
            function submitMessages(){
                // Submit the chat message
                $('#chat-form').submit(function(e) {
                e.preventDefault();
                var sender = $('#sender').val();
                var receiver = $('#receiver').val();
                var message = $('#message').val();
    
                $.ajax({
                    url: 'submit_message.php',
                    type: 'POST',
                    data: {sender: sender, receiver: receiver, message: message},
                    success: function() {
                        $('#message').val('');
                        fetchMessages(); // Fetch messages after submitting
                    }
                });
    
                });
            }
            function fetchMessages() {
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            
            $.ajax({
                url: 'fetch_messages.php',
                type: 'POST',
                data: {sender: sender, receiver: receiver},
                success: function(data) {
                    $('#chat-box-body').html(data);
                    scrollChatToBottom();
                }
            });
        }


        // Function to scroll the chat box to the bottom
        function scrollChatToBottom() {
            var chatBox = $('#chat-box-body');
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        }

 
        
        $(document).ready(function() {
            // Fetch messages every 3 seconds
            
            fetchMessages();
            setInterval(fetchMessages, 3000);
        });

            //submitMessages();
            // Submit the chat message
            /*$('#chat-form').submit(function(e) {
            e.preventDefault();
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            var message = $('#message').val();

            $.ajax({
                url: 'submit_message.php',
                type: 'POST',
                data: {sender: sender, receiver: receiver, message: message},
                success: function() {
                    $('#message').val('');
                    fetchMessages(); // Fetch messages after submitting
                }
            });*/
            

            //});