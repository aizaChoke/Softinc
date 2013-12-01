<?php
if(isset($_POST['login']) && isset($_POST['password'])){
    
    //echo $_POST['login'].' y Naira';
    if(strcmp($_POST['login'], 'naira') == 0 && strcmp($_POST['password'], 'romero') == 0 ) {
        echo true;
    } else {
        return false;
    }
    
}
?>