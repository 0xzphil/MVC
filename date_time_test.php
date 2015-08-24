


<?php
date_default_timezone_set('America/Thule');

$gmt = "+7"; // hour for time zone goes here
$hm = $gmt *60;
$ms= $hm*60;

$gmtime = gmdate("d/m/y g:i:s", time()+ $ms);
echo date_format( $gmtime, "d/m/y");
echo $gmtime;
 

?>

<?php
$date=date_create("2013-03-15");
echo date_format($date,"Y/m/d H:i:s");
?> 

<?php
print_r (date_parse_from_format("mmddyyyy","05122013"));
?> 