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
                <?php foreach($chat as $key => $value){ ?>
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
                <?php }?>
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

    $(function(){
        clickli()
    })

    function clickli(){
        $(".user-person li").on("click",function() {
                var id = $(this).data('id');
                user_id = id;
                alert(user_id);

        });
    }
    </script>

</body>
</html>