<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<? include "cbt_con.php";
$xkodemapel = "GAL1";
//$xkodesoal = "XGAL1SOAL2";
//$xkodesoal = "$_REQUEST[kode]";
$user = $_COOKIE['PESERTA'];
//  setcookie('PESERTA',$user);
  $sqluser = mysql_query("SELECT * FROM  `cbt_siswa` s LEFT JOIN cbt_ujian u ON s.XKodeKelas = u.XKodeKelas WHERE XNomerUjian = 
  '$user' and u.XStatusUjian = '1'");
  $s = mysql_fetch_array($sqluser);
  $xkodesoal = $s['XKodeSoal'];
  $xtokenujian = $s['XTokenUjian'];
  
  
 $cek = mysql_num_rows(mysql_query("select * from cbt_jawaban where Urut='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'"));
 if($cek>0){
// $sql = mysql_query("update cbt_jawaban set XJawaban = '$_REQUEST[nama]' where XNomerSoal='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'");
$tgl = date("Y-m-d");
$jam = date("H:i:s");

$nomber = str_replace(" ","",$_REQUEST['nama']);

$ambiljawaban = "X$nomber";


$sqljwb = mysql_query("select *,$ambiljawaban as hasile from cbt_jawaban where Urut='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user' and XTokenUjian = '$xtokenujian'");
$uj = mysql_fetch_array($sqljwb);
$jwb = $uj['hasile'];
$tkn = $uj['XTokenUjian'];
$knc = $uj['XKunciJawaban'];
$es = $_POST['esse'];
$o = $_POST['o'];
$cpg = $_REQUEST['nama'];
if($jwb==$knc){$nil = 10;} else {$nil=0;}
if($cpg==''){$sql = mysql_query("update cbt_jawaban set XJawaban = 'O',XKodeJawab = '$ambiljawaban',XNilaiJawab = '$jwb', XNilai='$nil', XTglJawab = '$tgl',XJamJawab = '$jam', Campur = '$tkn', XEssay = '$es'
where Urut='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'  and XTokenUjian = '$xtokenujian'");
} else {$sqlX = mysql_query("update cbt_jawaban set XJawaban = '$_REQUEST[nama]',XKodeJawab = '$ambiljawaban',XNilaiJawab = '$jwb', XNilai='$nil', XTglJawab = '$tgl',XJamJawab = '$jam', Campur = '$tkn', XEssay = '$es'
where Urut='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'  and XTokenUjian = '$xtokenujian'");}



$sql2 = mysql_query("Update cbt_siswa_ujian set XLastUpdate = '$jam' where XNomerUjian = '$user' and XStatusUjian = '1'");


 
 } 

    if(mysql_query($sql)){
     return "success!";
   	} else {
    return "failed!";
  	}
	
 if(isset($_POST['hapusx'])){
	 $querya = "update cbt_jawaban set XJawaban = 'O', XTglJawab = '$tgl',XJamJawab = '$jam', XEssay = '$es'
where Urut='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'  and XTokenUjian = '$xtokenujian'";
	$hasil = mysql_query($querya);
 }
?>  


</body>
</html>