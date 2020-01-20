<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script>
         wsUri = 'http://127.0.0.1';
         //wsUri = 'https://line-chat-tarad.herokuapp.com/';
         var socket = io.connect(wsUri);

            $(document).ready(function() {
                // $('#chatboard').text(""); 
                var name = 'test';
                socket.emit('sendName', {name: name.trim()});

                socket.on('sendName', function(data) {  
                    $('#chatboard').append(data.trim() + "\r\n");
                });

                socket.on('hookMsg', function(data) {  
                    //console.log(data.text);
                    $('#chatboard').append(data.text.trim() + "\r\n");
                });

                $('#button').click(function() { // มีผลเหมือนกับฟังชั่น keypress เพียงแต่เป็นการคลิ๊กปุ่ม
                    var message = $('#messagebox').val();
                    $('#messagebox').val("");
                    $('#chatboard').append(message.trim() + "\r\n");
                    socket.emit('hookMsg', {message: message});
                });


                /*var name = prompt("Please enter your name?", ""); // รับ input ค่า name
                wsUri = 'http://127.0.0.1:9999'; // เขียนurlติดต่อไปยัง server ในพอร์ต 9999
                var socket = io.connect(wsUri); // ทำการติดต่อ
                socket.emit('sendName', {name: name.trim()}); // ส่งชื่อผ่านท่อ sendName ไป
                socket.on('sendName', function(data) { // ถ้ามีการส่งข้อมูลผ่าน ท่อ sendName 
                    $('#chatboard').append(data.name.trim() + "\r\n"); // เอาค่าที่ได้มาใส่ใน textarea
                });
                socket.on('sendMsg', function(data) {
                    $('#chatboard').append(data.message.trim() + "\r\n");
                });
                socket.on('disconnected', function(data) {
                    $('#chatboard').append(data.name.trim() + "'s Disconnect\r\n");
                });
                $('#messagebox').keypress(function(evt) {// กรณีที่มีการกดปุ่ม
                    if (event.which === 13) { // ถ้าเป็นปุ่ม enter ให้ส่งข้อมูลไปยัง server
                        var message = $('#messagebox').val();
                        $('#messagebox').val(""); // clear ค่าในช่องใส่ข้อความ
                        socket.emit('sendMsg', {message: message});
                    }
                });*/

                // socket.on('sendMsg', function(data) {
                //     $('#chatboard').append(data + "\r\n");
                // });


                // $('#button').click(function() { // มีผลเหมือนกับฟังชั่น keypress เพียงแต่เป็นการคลิ๊กปุ่ม
                //     var message = $('#messagebox').val();
                //     $('#messagebox').val("");
                //     socket.emit('sendMsg', {message: message});
                // });
                
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


        <div>
       <a href="javascript:clickname('new')">my name is New</a>
       <a href="javascript:clickname('o')">my name is O</a>
        </div>
    </body>

    <script>
    function clickname(name){
        //console.log(name);
        socket.emit('hookMsg', {name: name.trim()});
    }
    </script>
</html>
