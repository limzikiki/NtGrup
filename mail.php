<?php /*<!DOCTYPE HTML>

<head>
<title>Email</title>
</head>
<body>
<div id="status">
	<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1920" id="status_anim">
		<defs>
			<style>
		    	.cls-1{fill:#1a1a1a;}
		    	.cls-2{fill:#e6e6e6;}
		    </style>
		</defs>
		<circle class="cls-1" cx="960" cy="960" r="960"/>
		<rect id='rect1' class="cls-2" x="235" y="367" width="430" height="1186" rx="215"/>
		<rect id='rect3' class="cls-2" x="1253" y="367" width="430" height="1186" rx="215"/>
		<rect id='rect2' class="cls-2" x="745" y="367" width="430" height="1186" rx="215"/>
	</svg>
	<div id="main">
		<span class="inprogress">Jūsu vēstule ir nosūtīta</span>
		<span class="inprogress">Ваше письмо отправляется</span>
		<span class="inprogress">Your message is sending</span>
	</div>
	<div id="main_clone">
		<span class="inprogress_clone">Jūsu vēstule ir nosūtīta</span>
		<span class="inprogress_clone">Ваше письмо отправляется</span>
		<span class="inprogress_clone">Your message is sending</span>
	</div>
</div>
<style>
    #rect1{
            animation: resize 1s linear infinite;
        }
    #rect2{
            animation: resize 1s 0.5s linear infinite;
        }
    #rect3{
            animation: resize 1s linear infinite;
        }
	@keyframes resize{
            0%{
                height:1186px;
            }
            50%{
                height:430px;
                y:797px;
            }
            100%{
                height:1186px;
                y:367px;
            }
        }	
	body{
		margin:0;
		padding: 0;
		height: 100vh;
		width: 100vw;
		background: #C5C5C5;
		display: flex;
		justify-content: space-around;
		align-items: center;
		
	}
	
	svg{
        height:70%;
        width:70%;
		position: relative;
		z-index: 2;
    }
	
	.inprogress, .inprogress_clone{
		display: block;
		text-align: center;
		font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
		margin: 1vw 5vh 1vw 5vh;
		font-size: 1.3em;
	}
	
	.inprogress:first-of-type, .inprogress_clone:first-of-type{
		margin-top: 4vw;
	}
	
	.inprogress:last-of-type, .inprogress_clone:last-of-type{
		margin-bottom: 4vw;
	}
	.inprogress_clone{
		opacity: 0;
		cursor: default;
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select:none;
		user-select:none;
		-o-user-select:none;
	}
	
	#status{
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items:center;
	}
	
	#main{
		background:white;
		border-radius: 0 0 50px 50px;
		z-index: 1;
	}
	#main_clone{
		background: white;
		position: absolute;	
		z-index: 0;
	}
</style>*/?>
<?php
use PHPMailer\ PHPMailer\ PHPMailer;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->isHTML( true );
$mail->CharSet = "utf-8";
$mail->SMTPAuth = true;
$mail->Username = 'admin@ordypage.com';
$mail->Password = '123456';
$mail->setFrom( 'admin@ordypage.com', 'NOREPLY WEBSITE' );
$mail->addReplyTo( $_POST[ 'email' ], $_POST[ 'name' ] );
$mail->addAddress( 'admin@ordypage.com', 'NTGrup' );
$mail->Subject = 'Сообщение с сайта';
$mail->msgHTML( file_get_contents( 'message.html' ), __DIR__ );
$mail->Body = 'На сайте NTGrup была оставлено сообщение от ' . $_POST[ 'name' ] . ':' . $_POST[ 'email' ] . '  текст сообщения:<br>' . $_POST[ 'message' ];
//$mail->addAttachment('test.txt');
if ($_POST['lang'] === ""){
	$lan = 'en';
}else{
	$lan = substr($_POST['lang'], 1, 2);
}
echo 'succes';
if ( !$mail->send() ) {
	exit ;
} else {
	exit ;
}
?>
</body>