<?php

	
if ((substr($_SERVER['REMOTE_ADDR'],0,8) == "192.168.") || ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")) {
    echo $ip = getenv('REMOTE_ADDR');
    //echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
} else {
    echo $ip = gethostbyname(exec("hostname"));
    //echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
}


											
// CODE PAG KUHA SA IP ADDRESS
/*
$exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
$hostname = trim($exec); //remove any spaces before and after
echo $ip = gethostbyname($hostname);
*/
?>