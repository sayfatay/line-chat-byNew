<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script>
         wsUri = 'http://127.0.0.1:9999';
         var socket = io.connect(wsUri);

            $(document).ready(function() {
               
                /*socket.on('sendName', function(data) {  
                    $('#chatboard').append(data+ "\r\n");
                });

                socket.on('sendMsg', function(data) {
                    $('#chatboard').append(data + "\r\n");
                });


                $('#button').click(function() { // มีผลเหมือนกับฟังชั่น keypress เพียงแต่เป็นการคลิ๊กปุ่ม
                    var message = $('#messagebox').val();
                    $('#messagebox').val("");
                    socket.emit('sendMsg', {message: message});
                });*/
                
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
                        <input type="button" value="Click me" onclick="clickname()">
                    </td>
                </tr>
            </table>
        </div>

        <div>
        </div>
    </body>

    <script>
    function clickname(){

       var message = $('#messagebox').val();
       $('#messagebox').val("");
       socket.emit('sendHook', {message: message});
       $('#chatboard').append(message + "\r\n");
    }
    </script>
</html>
