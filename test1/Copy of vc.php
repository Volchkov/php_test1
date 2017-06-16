<?

// show head

print "<HTML>";
print "<HEAD><title> VC page </title></HEAD>";
print "<BODY bgcolor='#DCDCDC'>";
print "<CENTER><A HREF='vc.php'>Clear Page</A></CENTER>";

@$action=$_GET['action'];

//
$phone="";
$slogin="";
$spassword="";


if ($action=="genauth")
{
// gen sip login and password
@$phone=$_GET['phone'];
$phonelen=strlen($phone);
	if (($phonelen>=12)&&($phonelen<16))
	{
		$rand=rand(10000,340000);
		$ctime=time();	
		$code_line=$rand.$ctime."eeeeqerghew";	
		$get_line=$phone.$rand."aedgrrgrgr";	
		$code_line2="pkm".$rand.$ctime."g5";
                $get_line2="123".$phone.$rand."i125w"; 
		$spassword=crypt($code_line,$get_line);
		$slogin=crypt($code_line2,$get_line2);
		$pass_past1 = substr($spassword,2,14);
		$pass_past2 = substr($spassword,-1);
		$spassword=$pass_past2.$pass_past1;
		$slogin=substr($phone,5,12).substr($slogin,9,14);
// normalization
		$spassword=str_replace(".","w",$spassword);
                $spassword=str_replace("/","e",$spassword);

                $slogin=str_replace(".","E",$slogin);
                $slogin=str_replace("/","W",$slogin);

// show gen data
		print "<TABLE align=\"center\" border=\"1\">";
		print "<TR>";
		print "<TD>";
			print $phone;
		print "</TD>";
		print "<TD>";
			print $slogin;
		print "</TD>";  
		print "<TD>";
			print $spassword;
		print "</TD>";
		print "<TD>vegatelecom</TD>";
		print "<TD>null@vt.com</TD>";
		print "</TR>";
		print "</TABLE>";

	}	
	else 
	{
		print "Phone len is incorrect<BR>";
	}

}
elseif ($action=="g1248v")
{
// gen 1248v config 
	@$phone=$_GET['phone'];
	@$port=$_GET['port'];
	@$slogin=$_GET['slogin'];
        @$spassword=$_GET['spassword'];
	$phonelen=strlen($phone);
	$portlen=strlen($port);
	$sloginlen=strlen($slogin);
        $spasswordlen=strlen($spassword);
	if (($phonelen>11)&&($portlen>0)&&($sloginlen>5)&&($spasswordlen>5))
	{
		// show 1248v config
		print "<HR>";
		print "voip profile sip callsvc set $slogin password $spassword numberplan off<BR>";
		print "voip profile sip callsvc set $slogin callhold off callwait off calltransfer off clip on clir off dnd off dtmf rfc2833 fax g711<BR>";
		print "voip profile sip callsvc set $slogin callreturn off cidcw on<BR>";
		print "voip profile sip callsvc set $slogin flash invite<BR>";
		print "voip profile sip callsvc set $slogin localcall off mwi on reanswer 0 registration on 1800<BR>";
		print "voip profile sip callsvc set $slogin localhelp off<BR>";
		print "voip profile sip callsvc set $slogin keypattern VC-KEY<BR>";
		print "voip port tel $port $phone<BR>";
		print "voip port sip set $port VC $slogin VC-CODEC<BR>";
		print "voip port en $port<BR>";
		print "adsl en $port<BR>";
                print "<HR>";
		$phone=$port=$slogin=$spassword="";
	}
	else
	{
		print "incorrect data for generate 1248V commands";
	}
}
elseif ($action=="g5000")
{
// gen 5000 config
        @$phone=$_GET['phone'];
        @$port=$_GET['port'];
        @$slogin=$_GET['slogin'];
        @$spassword=$_GET['spassword'];
        $phonelen=strlen($phone);
        $portlen=strlen($port);
        $sloginlen=strlen($slogin);
        $spasswordlen=strlen($spassword);
        if (($phonelen>11)&&($portlen>0)&&($sloginlen>5)&&($spasswordlen>5))
        {
                // show 5000 config
                print "<HR>";
		print "profile voip sip callsvc set $slogin localhelp off<BR>";
		print "profile voip sip callsvc set $slogin password $spassword<BR>";
		print "profile voip sip callsvc set $slogin keypattern VC-KEY<BR>";
		print "profile voip sip callsvc set $slogin numberplan off<BR>";
		print "profile voip sip callsvc set $slogin dnd off callhold off callwait off clip on clir off calltransfer off cidcw on fax g711 dtmf rfc2833 callreturn off localcall off registration on 1800 flash invite mwi on reanswer 0<BR>";
		print "profile voip sip callsvc set $slogin conference off callsvcmode europe firstdigit 8 interdigit 3 onhooktransfer off conftransfer off<BR>";
		print "port sip set $port VC $slogin VC-CODEC<BR>";
		print "port tel $port $phone<BR>";
		print "port enable $port<BR>";
                print "<HR>";
                $phone=$port=$slogin=$spassword="";
        }
        else
        {
                print "incorrect data for generate 5000 commands";
        }
 
}
elseif ($action=="coshis")
{
// get cos histiry
        @$phone=$_GET['phone'];
        $phonelen=strlen($phone);
	if (($phonelen<16)||($phonelen>11))
	{
		// connect to mysql server
                $db_con_id = mysql_pconnect('10.57.0.21','develop','zaq123');
                mysql_select_db('num');
		//
		$query="SELECT number,cos,cdate FROM numhis WHERE number LIKE '%$phone%' ORDER BY number ,cdate DESC";
		$qresult=mysql_query($query);
		$qnum=mysql_num_rows($qresult);
		print "<TABLE align=\"center\" border=\"1\">";
		print "<TR><TD>CoS History</TD></TR>";
		for ($i=0;$i<$qnum;$i++)
		{
			print "<TR>";
			$qrow=mysql_fetch_array($qresult);
			$number=$qrow['number'];
			$cos=$qrow['cos'];
			$cdate=$qrow['cdate'];
			print "<TD>$number</TD><TD>$cos</TD><TD>$cdate</TD>";
			print "</TR>";
		}
		print "</TABLE>";
		$phone=$port=$slogin=$spassword="";
	}
	else
	{
		print "incorrect number for CoS history query";
	}
}
else
{
}


// menu for gen sip login/pass
print "<HR>";
print "<TABLE align=\"center\" border=\"1\">";
print "<TR>";
print "<TD>";
print "<FORM action=\"vc.php\" method=\"GET\">";
print "<input type=hidden name=action value=genauth>";
print "<input type=\"text\" name='phone' maxlength=\"25\" size=\"25\">";
print "</TD>";
print "</TR>";
print "<TR>";
print "<TD>";
print "<input type=submit Value=\"Gen Sip Login and pass\">";
print "</FORM>";
print "</TD>";
print "</TR>";
print "</TABLE>";

print "<HR>";
// menu for gen 1248v

print "<TABLE align=\"center\" border=\"1\">";
print "<TR>";
print "<TD>Phone Number";
print "</TD>";
print "<TD>Port";
print "</TD>";
print "<TD>SIP pass";
print "</TD>";
print "<TD>SIP Login";
print "</TD>";
print "</TR>";
print "<TR>";
print "<FORM action=\"vc.php\" method=\"GET\">";
print "<TD>";
print "<input type=hidden name=action value=g1248v>";
print "<input type=\"text\" name='phone' maxlength=\"25\" size=\"25\" value=$phone>";
print "</TD>";
print "<TD>";
print "<input type=\"text\" name='port' maxlength=\"4\" size=\"4\">";
print "</TD>";
print "<TD>";
print "<input type=\"text\" name='spassword' maxlength=\"14\" size=\"14\" value=$spassword>";
print "</TD>";
print "<TD>";
print "<input type=\"text\" name='slogin' maxlength=\"14\" size=\"14\" value=$slogin>";
print "</TD>";
print "</TR>";
print "<TR>";
print "<TD>";
print "<input type=submit Value=\"Gen Zyxel 1248V Config\">";
print "</FORM>";
print "</TD>";
print "</TR>";
print "</TABLE>";
print "<HR>";
// menu for gen 5000
 
print "<TABLE align=\"center\" border=\"1\">";
print "<TR>";
print "<TD>Phone Number";
print "</TD>";
print "<TD>Port";
print "</TD>";
print "<TD>SIP pass";
print "</TD>";
print "<TD>SIP Login";
print "</TD>";
print "</TR>";
print "<TR>";
print "<FORM action=\"vc.php\" method=\"GET\">";
print "<TD>";
print "<input type=hidden name=action value=g5000>";
print "<input type=\"text\" name='phone' maxlength=\"25\" size=\"25\" value=$phone>";
print "</TD>";
print "<TD>";
print "<input type=\"text\" name='port' maxlength=\"4\" size=\"4\">";
print "</TD>";
print "<TD>";
print "<input type=\"text\" name='spassword' maxlength=\"14\" size=\"14\" value=$spassword>";
print "</TD>";
print "<TD>";
print "<input type=\"text\" name='slogin' maxlength=\"14\" size=\"14\" value=$slogin>";
print "</TD>";
print "</TR>";
print "<TR>";
print "<TD>";
print "<input type=submit Value=\"Gen Zyxel IES-5000 Config\">";
print "</FORM>";
print "</TD>";
print "</TR>";
print "</TABLE>";
print "<HR>";

// menu for select CoS History
print "<TABLE align=\"center\" border=\"1\">";
print "<TR>";
print "<TD>";
print "<FORM action=\"vc.php\" method=\"GET\">";
print "<input type=hidden name=action value=coshis>";
print "<input type=\"text\" name='phone' maxlength=\"25\" size=\"25\">";
print "</TD>";
print "</TR>";
print "<TR>";
print "<TD>";
print "<input type=submit Value=\"Get CoS history\">";
print "</FORM>";
print "</TD>";
print "</TR>";
print "</TABLE>";

print "<HR>";


?>
