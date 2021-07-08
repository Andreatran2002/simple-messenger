<?php
    include('class/DB.php'); 
?>
<html>

<head>
    <title>Messenger</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/index.css">
</head>

<body onload="checkcookie(); update();">

    < class="container">
        <div class="left-container ">
            <form action="" method="post" class="search-bar">
                <input type="text" name="keyword" id="">
                <input type="submit" name="submit" value="Submit">
            </form>
            <?php
                $results = DB::query("SELECT * FROM user "); 
                foreach($results as $r){
                    echo '<div class="friend-box">';
                    echo '<image class="img-friend" src="https://anhdep123.com/wp-content/uploads/2021/05/hinh-avatar-trang.jpg" > </image>' ;
                    echo $r['username'].'</div>'; 
                }
            ?>
        </div>

        <div id="whitebg"></div>
        <div id="loginbox">
            <h1>Pick a username:</h1>
            <p><input type="text" name="pickusername" id="cusername" placeholder="Pick a username" class="msginput">
            </p>
            <p class="buttonp"><button onclick="chooseusername()">Choose Username</button></p>
        </div>

        
            <div class="msg-container">
            <div class="header">Messenger</div>
                <div class="msg-area" id="msg-area"></div>
                <div class="bottom"><input type="text" name="msginput" class="msginput" id="msginput"
                        onkeydown="if (event.keyCode == 13) sendmsg()" value=""
                        placeholder="Enter your message here ... (Press enter to send message)"></div>
            </div>
        

        </div>
        <script type="text/javascript" src="javascript/index.js">

        </script>
</body>

</html>