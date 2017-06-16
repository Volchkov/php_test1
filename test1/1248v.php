<?
print "<HTML>";
print "<HEAD><title> 1248v page </title></HEAD>";
print "<BODY bgcolor='#DCDCDC'>";
print "<CENTER><A HREF='1248v.php'>Clear Page</A></CENTER>";

@$data=$_POST['data'];

if ($data)
{
        $arr = split("\n",$data);
	$cnt = count($arr);
        for ($i=0;$i<$cnt;$i++)
        {
		$arr_line = split("\t",$arr[$i]);
		$slogin = $arr_line[3];
		$spassword = $arr_line[2];
		$phone = $arr_line[0];
		$port = $arr_line[1];
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
        }
}
else
{
        print "<FORM action=\"1248v.php\" method=\"POST\">";
        print "<TEXTAREA NAME='data' COLS=100 ROWS=24></TEXTAREA>";
        print "<HR>";
        print "<input type=submit Value=\"Gen command for 1248v\">";
}

?>
