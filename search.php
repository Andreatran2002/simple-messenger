<?php
    include('class/DB.php'); 
    if (isset($_POST['search'])){
        $keyword = $_POST['keyword'];        
    }

?> 

<html>
<form action="search.php" method="post">
    <input type="text" name="keyword" placeholder="Type here.....">
    <input type="submit" name="search" value="Search"> 
</form>
<div>
    <h2>Kết quả</h2>
    <?php
        $conn=mysqli_connect('localhost','andreatran','123Phuongvy','simple_messenger');
        $results = mysqli_query($conn,"SELECT * FROM user WHERE username LIKE '%$keyword%'");
        //$results = DB::query("SELECT * FROM user WHERE username LIKE '%:keyword%'; ",array(':keyword'=>$keyword));
        
        foreach ($results as $r){ 
            echo $r['username'].'<br/>';
        }
    ?>
</div>
</html>