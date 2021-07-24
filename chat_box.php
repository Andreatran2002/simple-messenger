<?php
    include('class/DB.php'); 
    include('class/Login.php'); 
    if (!Login::isLoggedIn()){
      header("Location: http://andreatran.atwebpages.com/login.html");
      exit; // dừng các mã chạy phía dưới;
    }
?>
<html>

<head>
      <title>Messenger</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="styles/index.css">
      <link rel="stylesheet" href="styles/index.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
            crossorigin="anonymous" />
</head>

<body onload="checkcookie(); update();">

      <div class="container">
            <header>
                  <p>Messenger</p>
                  <i id="logout-icon"  onclick="logout()" class="logout-icon fas fa-sign-out-alt"></i>
            </header>
            <div class="left-container">
                  <div class="chat-box">
                        <h1>Chat</h1>
                  </div>
                  <form action="" method="post" class="search-bar">
                        <i class="search-bar-icon fas fa-search"></i>
                        <input type="text" name="keyword" id="" placeholder="Search ....">
                  </form>
                  <div id="friend_default_style" class="friend_container style-1">
                        <?php
                $results = DB::query("SELECT * FROM users"); 
/*                 $receiver_id = DB::query("SELECT id FROM users WHERE ")
 */                foreach($results as $r){
                    echo '<div class="friend-box" onclick="friendChatting(\''.$r['id'].'\')"  id="'.$r['id'].'">';
                    echo '<image class="img-friend" src="https://anhdep123.com/wp-content/uploads/2021/05/hinh-avatar-trang.jpg" > </image>' ;
                    echo $r['username'].'</div>'; 
                    
                }
                ?>
                        <div class="force-scroll"></div>
                  </div>

            </div>

            <div id="whitebg"></div>
           <!--  <div id="loginbox">
                  <h1>Please login to chat with your friend</h1>
                  <p><input type="text" name="pickusername" id="cusername" placeholder="Pick a username"
                              class="msginput">
                  </p>
                  <p class="buttonp"><button onclick="chooseusername()">Choose Username</button></p>
            </div>
 -->
            <div class="style-1 msg-container">
                  <div class="msg-area style-1" id="msg-area"></div>
                  <div class="bottom"><input type="text" name="msginput" class="msginput" id="msginput"
                              onkeydown="if (event.keyCode == 13) sendmsg()" value=""
                              placeholder="Enter your message here ... (Press enter to send message)"></div>
            </div>


      </div>
      <script type="text/javascript" src="javascript/index.js">

      </script>
</body>

</html>