<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
    <style>
        .scrollbar
            {
                float: left;
                height: 100%;
                width: 100%;
                overflow-y: scroll;
            }
    </style>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
</head>
<body>
	<div class="main-section">
		<div class="head-section">
			<div class="headLeft-section">
				<div class="headLeft-sub">
					<input type="text" name="search" placeholder="Search...">
					<button> <i class="fa fa-search"></i> </button>
				</div>
			</div>
			<div class="headRight-section">
				<div class="headRight-sub">
					<h3 class="line_user">กรุณาเลือกการติดต่อ...</h3>
				</div>
			</div>
		</div>
		<div class="body-section">
			<div class="left-section mCustomScrollbar" data-mcs-theme="minimal-dark">
				<ul class="user-person">
					<li>
						<div class="chatList">
							<div class="img">
								<i class="fa fa-circle"></i>
								<img src="<?=base_url()?>assets/images/icons8-user-30.png">
							</div>
							<div class="desc">
								<small class="time">05:30 am</small>
								<h5>Luis Yankee</h5>
								<small>Lorem ipsum dolor sit amet...</small>
							</div>
						</div>
					</li>
					
				</ul>
			</div>
			<div class="right-section">
				<div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                    <div class="scrollbar" id="scrollbar">
                        <ul class="chat-detail">
                            <!-- <li class="msg-left">
                                <div class="msg-left-sub">
                                    <img src="<?=base_url()?>assets/images/icons8-user-80.png">
                                    <div class="msg-desc">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua.
                                    </div>
                                    <small>05:25 am</small>
                                </div>
                            </li>
                            <li class="msg-right">
                                <div class="msg-left-sub">
                                    <div class="msg-desc">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua.
                                    </div>
                                    <small>05:25 am</small>
                                </div>
                            </li> -->
                            <!-- <li class="msg-day"><small>Wednesday</small></li> -->
                            
                        </ul>
                    </div>
				</div>
				<div class="right-section-bottom">
						<div class="upload-btn">
						  	<button class="btn"><i class="fa fa-photo"></i></button>
						  	<input type="file" name="myfile" />
						</div>
						<input type="text" name="" id="text-msg" placeholder="type here...">
						<button class="btn-send" onclick="sendMsg()"><i class="fa fa-send"></i></button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- custom scrollbar plugin -->
    <script src="<?=base_url()?>assets/js/jquery-3.4.1.min.js"></script>
    <script>
        var user_id, shop_id = 5;
        wsUri = 'http://127.0.0.1';
        //wsUri = 'https://oobs-dba.com/webhook';
        var socket = io.connect(wsUri);
        $(function(){
            getData();

            socket.on('reHook', function(data) {
                if(data.message !== "" && data.user_id === user_id){
                    var html = 	'<li class="msg-left">'+
							'<div class="msg-left-sub">'+
                                '<img src="'+data.img+'">'+
								'<div class="msg-desc">'+data.message+'</div>'+
								'<small>05:25 am</small>'+
							'</div>'+
						'</li>';

                        $(".chat-detail").append(html);
                        $("#scrollbar").scrollTop( 20000 );
                }
            });

        })

        function sendMsg(){
            var message = $("#text-msg").val();
            if(message !== ""){
                $("#text-msg").val("");

                socket.emit('sendMsg', {user_id: user_id, shop_id: shop_id, message: message});

                var html = 	'<li class="msg-right">'+
							'<div class="msg-left-sub">'+
								'<div class="msg-desc">'+message+'</div>'+
								'<small>05:25 am</small>'+
							'</div>'+
						'</li>';

                $(".chat-detail").append(html);
                $("#scrollbar").scrollTop( 20000 );
            }
        }

        function clickli(){
            $(".user-person li").on("click",function() {
                var id = $(this).data('id');
                user_id = id;

                socket.emit('sendName', {shop_id: shop_id, user_id: id});

                var url = "<?=base_url()?>main/getlineuser/"+id;
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    success: function(result) {
                        //$(".line_user").html(result.line_user);
                        $(".line_user").html(result.user.line_name);
                        $(".chat-detail").html('');

                        for(var i = result.msg.length; i >= 0; i--){
                            if( result.msg[i] !== undefined){
                                var msg_type = "";
                                var msg_profile = "";
                                //console.log(result.msg[i]['ind']);

                                if(result.msg[i]['type']== 1){
                                    msg_type = "msg-right";
                                }else{
                                    msg_type = "msg-left";
                                    msg_profile = '<img src="'+result.user.line_img+'">';
                                }
                                var html = 	'<li class="'+msg_type+'">'+
                                    '<div class="msg-left-sub">'+msg_profile+
                                        '<div class="msg-desc">'+result.msg[i]['message']+'</div>'+
                                        '<small>05:25 am</small>'+
                                    '</div>'+
                                '</li>';

                                $(".chat-detail").append(html);
                            }
                            
                        }

                        $("#scrollbar").scrollTop( 20000 );
                    }
                });

                
            });

            
        }
           

        function getData(){
            
            var url = "<?=base_url()?>main/person/5";

            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(result) {
                    //alert(result.item);
                    $(".user-person").html('');
                    $.each( result.item, function( i, val ) {
                        //$( "#" + i ).append( document.createTextNode( " - " + val ) );
                        var html ='<li data-id="'+val.ind+'">'+
                            '<div class="chatList">'+
                                '<div class="img">'+
                                    '<i class="fa fa-circle"></i>'+
                                    '<img src="'+val.line_img+'">'+
                                '</div>'+
                                '<div class="desc">'+
                                    '<small class="time">05:30 am</small>'+
                                    '<h5>'+val.line_name+'</h5>'+
                                    '<small>-</small>'+
                                '</div>'+
                            '</div>'+
                        '</li>';
                        $( ".user-person" ).append(html);
                    });
                    
                    clickli();
                }
            });
        }
    </script>
</body>
</html>