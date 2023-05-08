
<?php
	include 'C:/xampp/htdocs/Cyjam/config.php';

  $id = $_GET['receive'];
  $sender = $_GET['send'];

    $sql = "SELECT *FROM chat_messages WHERE film_id='$id' ORDER BY created_at ASC";
    $db = config::getConnexion();
		$res = $db->query($sql);

      // $sql="SELECT * from chat_messages where film_id=$id";
			// $db = config::getConnexion();
			
			// $query=$db->prepare($sql);
			// $query->execute();

			// $res=$query->fetch();
				
			
		
    if($res){
    foreach($res as $msg){ 
    if($sender == $msg['user_id']){
    ?>
    <style>
      .item-group-you{
        position: relative;
        margin: 0 0 30px 0;
        }

        .item-group-you img{
          width: 50px;
          height: 50px;
          border-radius: 100%;
        }

        .text-message-you{
            background: #f5f6fa;
            padding: 20px;
            margin: 0 0 0 10px;
            font-size: 14px;
            border-top-left-radius:10px;
            border-bottom-left-radius:10px;
            border-top-right-radius:10px;
        }

        /* ---------------------- */

        .item-group-other{
            flex-direction: row-reverse;
            order:-1;
            position: relative;
            margin: 0px 0 30px 0;
        }

        .item-group-other img{
          width: 50px;
          height: 50px;
          border-radius: 100%;
        }

        .text-message-other{
            background: #00a8ff;
            padding: 20px;
            margin: 0 10px 0 0;
            font-size: 14px;
            color:#fff;
            border-top-left-radius:10px;
            border-top-right-radius:10px;
            border-bottom-right-radius:10px;
          }
          
        .message-to {position: relative;}
        .message-to img{
          width: 50px;
          border-radius: 100%;
        }

        .message-to i{
        color: #08c708;
        position: absolute;
        top: 28px;
        left: 37px;
        }

        .message-to h6{
        padding: 7px 0 0 6px;
        }

        .message-to p{
            position: absolute;
            top: 28px;
            left: 58px;
            font-size: 13px;
            font-weight: bold;
        }

        .dropdown{
            position: absolute;
            top: 18px;
            left: 375px;
        }

        .dropdown-toggle::after {
            border-top: .0em solid !important;
            border-right: .0em solid transparent !important;
            border-bottom: 0 !important;
            border-left: .0em solid transparent !important;
        }

        .time-track-you{
            position: absolute;
            font-size: 12px;
            top: 64px;
            left: 61px;
        }

        .time-track-other{
            position: absolute;
            font-size: 12px;
            top: 64px;
            text-align: right;
            right: 62px;
        }



        .chat-wrapper .chat-body::-webkit-scrollbar {
          display: none;
          /* for Chrome, Safari, and Opera */
        }

        .chat-wrapper .chat-body{
          /* background: url("../images/bg.jpg"); */
          width: 100%;
          overflow: auto;
          padding: 15px;
          -ms-overflow-style: none;
          /* for Internet Explorer, Edge */
          scrollbar-width: none;
          /* for Firefox */
          overflow-y: scroll;
        }
        .nameUser{
            padding: 20px;
            margin: 0 10px 0 0;
            font-size: 14px;
            
            border-top-left-radius:10px;
            border-top-right-radius:10px;
            border-bottom-right-radius:10px;
        }
      </style>
      
      
      <div class="item-group-other d-flex">
      <div class="nameUser">
        <!-- get user -->
        <?php 
          $idU=$msg['user_id'];
          $sql="SELECT * from client where id=$idU";
          $db = config::getConnexion();
          $query=$db->prepare($sql);
          $query->execute();
    
          $user=$query->fetch();
          echo $user['nom'];
            
          
        ?>
      </div>
        <div class="text-message-other">
        <?php echo $msg['message']; ?>
        </div>
        <p class="time-track-other">
        <?php echo $msg['created_at']  ; ?>
        </p>
    </div>
    <?php }else{ ?>

    <div class="item-group-you d-flex">
    <div class="nameUser">
        <!-- get user -->
        <?php 
          $idU=$msg['user_id'];
          $sql="SELECT * from client where id=$idU";
          $db = config::getConnexion();
          $query=$db->prepare($sql);
          $query->execute();
    
          $user=$query->fetch();
          echo $user['nom'];
            
          
        ?>
      </div>
        <div class="text-message-you">
        <?php echo $msg['message']; ?>
        </div>
        <p class="time-track-you">
        <?php echo $msg['created_at']  ; ?>
        </p>
    </div> 

    <?php } ?>
    <?php } }

  