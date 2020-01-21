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
                <?php /*foreach($chat as $key => $value){ ?>
					<li data-id="<?=$value['ind']?>">
						<div class="chatList">
							<div class="img">
								<i class="fa fa-circle"></i>
								<img src="<?=$value['line_img']?>">
							</div>
							<div class="desc">
								<small class="time"><?=$value['date_time']?></small>
								<h5><?=$value['line_name']?></h5>
								<small><?=$value['message']?>...</small>
							</div>
						</div>
					</li>
                <?php }*/?>
				</ul>
			</div>
			<div class="right-section">
				<div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                    <div class="scrollbar" id="scrollbar">
                        <ul class="chat-detail">
                           
                        </ul>
                    </div>
				</div>
				<div class="right-section-bottom">
						<div class="upload-btn">
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
	wsUri = 'localhsot:3000';
	var socket = io.connect(wsUri);
	var user_id, shop_id = "<?=$shop_id?>";
    $(function(){
        //clickli()
		socket.emit('connect', {test:'111'});
		loadChat()
    })

	function loadChat(){

		var url = "<?=base_url()?>line/getChart/"+shop_id;
		$.ajax({
		type: "GET",
		dataType: "json",
		url: url,
		success: function(result) {
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
						'<small class="time">'+val.date_time+'</small>'+
						'<h5>'+val.line_name+'</h5>'+
						'<small>'+val.message+'</small>'+
					'</div>'+
				'</div>'+
			'</li>';
			$( ".user-person" ).append(html);
		});
		
		clickli();
		}

		});
	}

    function clickli(){
        $(".user-person li").on("click",function() {
                var id = $(this).data('id');
                user_id = id;

				var url = "<?=base_url()?>line/getlineuser/"+id;
				$.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    success: function(result) {

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

    </script>

</body>
</html>