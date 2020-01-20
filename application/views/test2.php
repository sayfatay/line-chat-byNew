<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#chatboard').text(""); 
                //var name = prompt("Please enter your name?", ""); // รับ input ค่า name
                wsUri = 'http://127.0.0.1:9999'; // เขียนurlติดต่อไปยัง server ในพอร์ต 9999
                var socket = io.connect(wsUri); // ทำการติดต่อ
                const userId = 'FOO';
                console.log('start')

                socket.on('askForUserId', function() {
                    socket.emit(userId);
                    console.log('userid :'+userId);
                });

                socket.on('send', function(message) {
                    console.log('You received a message');
                    console.log(message.data);
                });

                socket.on('message', function(data) {
                    console.log(data);
                });

                $('#button').click(function() { // มีผลเหมือนกับฟังชั่น keypress เพียงแต่เป็นการคลิ๊กปุ่ม
                    var message = $('#messagebox').val();
                    $('#messagebox').val("");
                    socket.emit('send', {message: message});
                });

            });
            
        </script>
    </head>
    <body>
        <div class="chat-room">
            <table>
                <tr>
                    <td colspan="2">
                        <textarea id="chatboard" readonly="readonly" rows='10' cols='50' style='resize:none;'>
                            
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type='text' id='messagebox' maxlength="100" style='width:100%;'/>
                    </td>
                    <td>
                        <input type='button' id="button" value='Send'/>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>