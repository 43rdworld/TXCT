<?php
/*
* script by spyka webmaster - www.spyka.net
* version: 1.0.0
* copyright (c) 2008 spyka Web Group
* license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

// file where referrals are stored, change if you wish
$file = "refers.txt";

// if set to 1 IPs will be logged and associated with the URL they were referred by
$log_ip = 0;

//////////////////// NO NEED TO EDIT BELOW ////////////////////
//echo $_SERVER['HTTP_REFERER']."<BR><BR>";
$referer = (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == '') ? 'an unknown url/direct access (typing in URL)' : $_SERVER['HTTP_REFERER'];
$ip = ($log_ip == 1) ? $_SERVER['REMOTE_ADDR'] : false;
$time = date('d F Y');
$user_text  = ($log_ip == 1) ? "On {$time} {$ip}" : "On {$time} a user";
$refer_text = "{$user_text} was referred by {$referer}";
$fp = fopen($file, 'a');
fwrite($fp, "{$refer_text}\n\r");
fclose($fp);

?>