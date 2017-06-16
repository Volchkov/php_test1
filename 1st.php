<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; 
      // $Visitor_IP=$_SERVER['Remote_ADDR'];
      // print  "Visitor IP ".$Visitor_IP;
      $ip = getenv('REMOTE_ADDR');
      Echo "Your IP is ".$ip; 
     $a=10;
     $b=20;
     $c=$a+$b;
     print "<p>sum= ".$c;
     print "<p> ".phpinfo();

   ?> 
 </body>
</html>