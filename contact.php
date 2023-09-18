<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
session_start();
$source = "eutopia_tandtgroup";
   if(isset($_POST) && $_POST['mobile']){   
        /*if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
			$msg="<span style='color:red'>The Validation code does not match!</span><br>";// Captcha verification is incorrect.		
		}else{// Captcha verification is Correct. Final Code Execute here!	*/	
			
        $_POST = array_map('trim', $_POST);   
        
        //Database constant
      	$servername = "localhost";
      	$username = "gulshan_dynasty";
      	$password = "w60.dKRTzJUh";
      	$dbname = "gulshan_dynasty_db";

      	// Create connection
      	$conn = new mysqli($servername, $username, $password, $dbname);
      	// Check connection
      	if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
      	}  
		$date = date("Y-m-d");
		$time = date("H:i");
		$datetime = time();
		
		$name 	= $_POST['name'];
		$mobile = $_POST['mobile'];
		$email  = $_POST['email'];
		
		$sql = "select * from leads where date='$date' and (contact='$mobile')";
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		if($row[0]=="")
		{
			$message = "";//$_POST['massage'];
			
			$from = "eutopia_tandtgroup";
			$sql = "INSERT INTO leads (name, email, contact, msg, source,date,time,datetime) VALUES ('$name', '$email', '$mobile', '$massage','$source','$date','$time','$datetime')";	

			if ($conn->query($sql) === TRUE) {
			 //echo "New record created successfully";
			} else {
				 echo "Error: " . $sql . "<br>" . $conn->error;
			}
		  
			$conn->close();
			 
			$to = 'leadsbsi@gmail.com';
			$header = "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$header .= 'To: '.$to.'' . "\r\n";
			$header .= 'From: '.$email.'' . "\r\n";
			$body='';

			$body = "<html><body><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-width:1px solid' bordercolor='#000000'>";	
			$body .="<tr bgcolor='000000'><td width='20%' colspan=3><p style='margin-left:10'><font size=2 color='ffffff' face=verdana><strong>Inquiry</strong></font></p></td></tr>";
			$body .="<tr><td width='20%'  align='right'><font size='2' face='Verdana'><b>Name&nbsp;</b></font></td><td width='4%'  align='center'><font size='2' face='Verdana'><b>:</b></font></td><td width='66%' > <font size='2' face='Verdana'>". $name ."</font></td></tr>";
			$body .="<tr><td width='20%'  align='right'><font size='2' face='Verdana'><b>Email&nbsp;</b></font></td><td width='4%'  align='center'><font size='2' face='Verdana'><b>:</b></font></td><td width='66%' > <font size='2' face='Verdana'>". $email ."</font></td></tr>";
			$body .="<tr><td width='20%'  align='right'><font size='2' face='Verdana'><b>Phone&nbsp;</b></font></td><td width='4%'  align='center'><font size='2' face='Verdana'><b>:</b></font></td><td width='66%' > <font size='2' face='Verdana'>". $mobile ."</font></td></tr>";
			 $body .="<tr><td width='20%'  align='right'><font size='2' face='Verdana'><b>Message&nbsp;</b></font></td><td width='4%'  align='center'><font size='2' face='Verdana'><b>:</b></font></td><td width='66%' > <font size='2' face='Verdana'>". $message ."</font></td></tr>";
			$body .="<tr><td width='100%'  colspan='3'></td></tr>";
			$body .="</table></body></html>";

			$subject	= "Enquiry for Eutopia Tandtgroup";

			$sentmail = mail($to, $subject, $body, $header);       
			$returnBody .= "Thanks, we will contact you soon";	
			
			/****************************************************/
			
			hit_api($name,$mobile,$email,"google_ET","IN");
			
			/*
			$curl = curl_init();
			$name 	= str_replace(" ","%20",$name);
			$email 	= str_replace(" ","%20",$email);
			$mobile = str_replace(" ","%20",$mobile);
			$message = str_replace(" ","%20",$message);
			$site = "spectrumatmetro.com";
			$Project = "Spectrum%20Metro";
			$UniqueId = time();

			curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bluesapphire01.realeasy.in/WebCreate.aspx?UID=fourqt&PWD=wn9mxO76f34=&Channel=GA&Src=Google&ISD=91&Mob=$mobile&Email=$email&name=$name&City=delhi&Location=delhi&Project=$Project&Remark=$message&url=$site&UniqueId=$UniqueId",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
			'Cookie: ASP.NET_SessionId=bx31qzk5jqzoue32z0ylgws0'
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);*/
			//echo $response;
		}
        
     }
	 
function hit_api($name,$phone,$email,$campaign_id,$country_code){
  $key = "76a853a227de598c";
  $channel = "LandingPage";
  $domain = "anarock.tech";
  $referer = $_SERVER["HTTP_REFERER"];
  $source = "google";
  $sub_source = "";
  $placement = "";
  $extra_details = "{}";
  try{
    //$source = preg_split("/&/",(preg_split("/utm_source=/",$referer)[1]))[0];
    $sub_source = preg_split("/&/",(preg_split("/utm_medium=/",$referer)[1]))[0];
    $placement = preg_split("/&/",(preg_split("/utm_campaign=/",$referer)[1]))[0];
    $gclid = preg_split("/&/",(preg_split("/gclid=/",$referer)[1]))[0];
    $extra_details = json_encode(array("gclid" => $gclid, "referer" => $referer));
  } catch(Exception $e) {
     echo 'Message: ' .$e->getMessage();
  }
  //$api_url = 'https://lead.'.$domain.'/api/v0/'.$channel.'/sync-lead';
  
  $api_url = 'https://lead.anarock.tech/api/v0/LandingPage/sync-lead';
  $current_time = (string)time();
  $hash = hash_hmac('sha256',$current_time,$key);
  $postFields  = "";
  $postFields .= "&name=".$name;
  $postFields .= "&phone=".$phone;
  $postFields .= "&email=".$email;
  $postFields .= "&purpose=buy";
  $postFields .= "&current_time=".$current_time;
  $postFields .= "&country_code=".$country_code;
  $postFields .= "&source=".$source; 
  $postFields .= "&sub_source=".$sub_source;
  $postFields .= "&placement=".$placement;
  $postFields .= "&hash=".$hash;
  $postFields .= "&campaign_id=".$campaign_id;
  $postFields .= "&extra_details=".$extra_details;
  //echo $postFields;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$api_url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$postFields);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $server_output = curl_exec ($ch);
  //return $server_output;
}
?>


<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-590532578"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-590532578');
</script>
<!-- Event snippet for https://medalleo.mahagunindia.info/ (submit lead form) conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-590532578/-tqBCMHgnbwYEOKfy5kC'});
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5HZQH2B');</script>
<!-- End Google Tag Manager -->

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '843187343836235');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=843187343836235&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HZQH2B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<section class="login-main-wrapper">
      <div class="main-container">
          <div class="login-process">
              <div class="login-main-container">
                  <div class="thankyou-wrapper">
                      <h1><img src="images/thankyou.png" alt="thanks" /></h1>
                        <p>for contacting us, we will get in touch with you soon... </p>
                        <a href="../">Back to home</a>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </section>
    
    <style>
.thankyou-wrapper{
  width:100%;
  height:auto;
  margin:auto;
  background:#ffffff; 
  padding:00px 0px 50px;
}
.thankyou-wrapper h1{
  font:100px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#333333;
  padding:0px 10px 10px;
}
.thankyou-wrapper p{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#333333;
  padding:5px 10px 10px;
}
.thankyou-wrapper a{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#ffffff;
  display:block;
  text-decoration:none;
  width:250px;
  background:#E47425;
  margin:10px auto 0px;
  padding:15px 20px 15px;
  border-bottom:5px solid #F96700;
}
.thankyou-wrapper a:hover{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#ffffff;
  display:block;
  text-decoration:none;
  width:250px;
  background:#F96700;
  margin:10px auto 0px;
  padding:15px 20px 15px;
  border-bottom:5px solid #F96700;
}
</style>
</body>