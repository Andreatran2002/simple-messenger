<?php
class Announce{
      public static function alert($alert){
            $alert_word = $alert;
            echo "<script type='text/javascript'>";
            echo "alert('$alert_word');";
            echo "</script>";
           
      }
}
?>