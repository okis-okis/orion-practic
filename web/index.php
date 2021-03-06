<?
session_start();
?>


<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>ОРИОН</title>
        
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <base href="https://orion-practic.herokuapp.com/">
    
    </head>

    <body>

        <?
        

		$servername = "mysql-35751-0.cloudclusters.net";
		$username = "admin";
		$password = "cou7EokY";
		$dbname = "orion";
		$port = 35751;
        ?>

        <div class="wrapper">

            <?
                //if(isset($_POST['log_name'])&&isset($_POST['log_password'])&&!isset($_SESSION['authorized'])){
                if($_POST['login']){
                    $log_name = $_POST['log_name'];
                    $log_password = $_POST['log_password'];

                    $conn = new mysqli($servername, $username, $password, $dbname, $port);
					
					$conn->set_charset("utf8");
								
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

                    $sql = "SELECT * FROM users WHERE nick='".$log_name."' and password = '".$log_password."'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        $_GET['page'] = '2';
                        $row = $result->fetch_assoc();
                        $_SESSION['user_name'] = $row['nick'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['lvl'] = $row['lvl'];
                        $_SESSION['authorized'] = true;
                        $_SESSION['authorized_error'] = '';
                    }
                    else{
                        $_SESSION['authorized_error'] = 'Ошибка входа! Проверьте правильность имени и пароля от аккаунта.';
                    }
                }

                if(isset($_POST['reg'])){
                    $_GET['page']='3';
                }

                if(isset($_POST['exit_btn'])){
                    $_GET['page']='0';
                    session_unset();
                }

                if(isset($_POST['set_account'])){
                    $_GET['page']='4';
                }

                if(isset($_POST['account_list'])){
                    $_GET['page']='5';
                }

                if(isset($_POST['list_account_edit_btn'])){
                    $_GET['page']='6';
                }

                if(isset($_POST['list_account_edit_btn'])){
                    $_GET['page']='6';
                }

                if(isset($_POST['edit_sections'])){
                    $_GET['page']='7';
                }

                if(isset($_POST['btn_gps'])){
                    //Кисель
                    $_GET['page']='8';
                }

                if(isset($_POST['btn_mtd'])){
                    //Бодя и Лёха
                    $_GET['page']='9';
                }

                if(isset($_POST['edit_sections_btn'])){

                    $conn = new mysqli($servername, $username, $password, $dbname, $port);
                
                    $conn->set_charset("utf8");
                                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "UPDATE site_info SET section='".$_POST['edit_about_us']."', info='".$_POST['edit_about_us_info']."' WHERE id='1';";

                    $result = $conn->query($sql);

                    $sql = "UPDATE site_info SET section='".$_POST['edit_r2_1']."', info='".$_POST['edit_r2_1_info']."' WHERE id='2';";

                    $result = $conn->query($sql);
                    $_SESSION['temp'] = $sql;

                    $sql = "UPDATE site_info SET section='".$_POST['edit_r2_2']."', info='".$_POST['edit_r2_2_info']."' WHERE id='3'";

                    $result = $conn->query($sql);

                    $sql = "UPDATE site_info SET info='".$_POST['edit_r3_1']."' WHERE id='4'";

                    $result = $conn->query($sql);

                    $sql = "UPDATE site_info SET info='".$_POST['edit_r3_2']."' WHERE id='5'";

                    $result = $conn->query($sql);

                    $sql = "UPDATE site_info SET info='".$_POST['edit_r3_3']."' WHERE id='6'";

                    $result = $conn->query($sql);

                    $sql = "UPDATE site_info SET info='".$_POST['footer_info']."' WHERE id='7'";

                    $result = $conn->query($sql);

                    $_GET['page']='7';
                }

                if(isset($_POST['change_account'])){

                    if(empty($_POST['change_account_name']) || empty($_POST['change_account_password'])){
                        $_SESSION['change_account_error'] = 'Ошибка!!! Нужно, что бы поля были заполнены.';
                        $_SESSION['change_account_id'] = '';
                    }

                    else{

                        $conn = new mysqli($servername, $username, $password, $dbname, $port);
                
                        $conn->set_charset("utf8");
                                    
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "UPDATE users SET nick='".$_POST['change_account_name']."', password='".$_POST['change_account_password']."', lvl = '".$_POST['select_level']."' WHERE id='".$_POST['change_account_id']."'";

                        $_SESSION['change_account_id'] = $_POST['change_account_id'];

                        $result = $conn->query($sql);

                        $_SESSION['change_account_error'] = '</br>Найстройки аккаунта были изменены';
                    }

                    $_GET['page']='6';
                }

                if(isset($_POST['set_account_save'])){
                    if(empty($_POST['set_account_name']) || empty($_POST['set_account_password'])){
                        $_SESSION['set_account_error'] = 'Ошибка!!! Нужно, что бы поля были заполнены.';
                    }
                    else{
                        $_SESSION['set_account_error'] = '';

                        //SQL request

                        $conn = new mysqli($servername, $username, $password, $dbname, $port);
                
                        $conn->set_charset("utf8");
                                    
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT nick FROM users WHERE nick='".$_POST['set_account_name']."'";
                        
                        $result = $conn->query($sql);

                        if($result->num_rows>0&&$_POST['set_account_name']!=$_SESSION['user_name']){
                            $_SESSION['set_account_error'] = 'Ошибка!!! Аккаунт с таким именем уже зарегистрирован';
                        }
                        else{
                            $sql = "UPDATE users SET nick='".$_POST['set_account_name']."', password='".$_POST['set_account_password']."' WHERE nick='".$_SESSION['user_name']."'";

                            $result = $conn->query($sql);

                            $_SESSION['user_name'] = $_POST['set_account_name'];
                            $_SESSION['password'] = $_POST['set_account_password'];

                            $_SESSION['set_account_error'] = 'Поля были обновлены.';
                        }
                    }
                    $_GET['page']='4';
                }

                if(isset($_POST['reg_btn'])){

                    if(isset($_SESSION['user_name'])){
                        //ПОПЫТКА ВЗЛОМА
                        $_GET['page'] = '0';
                    }
                    else{
                    if($_POST['reg_password']===$_POST['reg_password_rep']){
                        $conn = new mysqli($servername, $username, $password, $dbname, $port);
                
                        $conn->set_charset("utf8");
                                    
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT nick FROM users WHERE nick='".$_POST['reg_name']."'";

                        $result = $conn->query($sql);

                        if($result->num_rows>0){
                            //ОШИБКА
                            $_SESSION['reg_error'] = 'Ошибка! Аккаунт с таким именем уже существует.';
                        }
                        else{
                            $_SESSION['reg_error']='';

                            $sql = 'INSERT INTO users (nick, password) VALUES ("'.$_POST['reg_name'].'", "'.$_POST['reg_password'].'")';

                            $result = $conn->query($sql);

                            $_SESSION['user_name'] = $_POST['reg_name'];
                            $_SESSION['password'] = $_POST['reg_password'];

                            $_GET['page'] = '4';
                        }
                    }
                    else{
                        $_SESSION['reg_error'] = 'Ошибка! Проверьте правильность написания паролей.';
                    }

                    $_GET['page']='3';
                }
                }
            ?>

            <?php
                include 'header.php';
            ?>

            <?php
                include 'content.php';
            ?>

            <?
                if ($p==0||$p==2){
                    include 'footer.php';
                }
            ?>
        </div>
    </body>
</html>

<style>
@import url("https://fonts.googleapis.com/css?family=Roboto:400,500,900&display=swap&subset=cyrillic-ext");

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html{
    scroll-behavior: smooth;
}

body{
    font-family: Roboto;
}
ul, nav{
    list-style: none;
}
a{
    text-decoration: none;
    cursor: pointer;
    color: inherit;
}

header{
    position: relative;
    top: 0;
    left: 0;
    z-index:  10;
    width: 100;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    padding: 15px 30px 0;
}

header h2{
    text-transform: uppercase;
}

header nav{
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: space-between;
}

header nav ul{
    display: flex;
}

header nav ul li{
    margin: 0 15px;
    display: flex;
}


header nav li:first-child{
    margin-left: 0;
}

header nav li:last-child{
    margin-right: 0;
}

.glow{
    font-size: 80px;
    color: #fff;
    text-align: center;
    animation: glow 1s ease-in-out infinite alternate;
  }
  
  @-webkit-keyframes glow {
    from {
      text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
    }
    
    to {
      text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
    }
  }

@media(max-width: 1000px){
    header{
        padding: 20px 50px;
    }

    .glow{
        font-size: 80px;
        color: #fff;
        text-align: center;
    }

    @-webkit-keyframes glow {
    from {
    }
    
    to {
    }
  }
}

@media(max-width: 700px){
    header{
        flex-direction: column;
    }
    header h2{
        margin-bottom: 15px;
        font-size: 25px;
    }
    header nav li{
        margin: 0 7px;
        font-size: 12px;
    }
}

/*banner area*/

section{
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 110px 100px;
}

@media(max-width: 1000px){
    section{
        padding: 100px 50px;
    }
}

@media(max-width: 600px){
    section{
        padding: 125px 30px;
    }

    .banner-text{
        font-size: 20px;
        line-height: 3.5;
        margin-top: 30vh;
    }
}

section p{
    max-width: 800px;
}

.banner-area{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    justify-content: center;
    min-height: 100vh;
    color: #fff;
    text-align: center;
}

.banner-area .banner-img{
    <?
    $i = rand(0, 7);
    switch($i){
    case 0:   
    ?>
        background-image: url(img/space.webp);
        <?
    break;
    case 1:
        ?>
        background-image: url(img/space_1.webp);
        <?
    break;
    case 2:
    ?>
        background-image: url(img/space_2.webp);
    <?
    break;
    case 3:
    ?>
        background-image: url(img/space_3.webp);
    <?
    break;
    case 4:?>    
        background-image: url(img/space_4.webp);
    <?
    break;
    case 5:?>
        background-image: url(img/space_5.webp);
    <?
    break;
    case 6:?>
        background-image: url(img/space_6.webp);
    <?
    break;
    case 7:?>
        background-image: url(img/space_7.webp);
    <?
    break;
    }?>
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -webkit-background-size: cover;
    background-size: cover;
    z-index: -1;
}

.banner-area .banner-text{
    margin-top: 45vh;
}

/*
.banner-area .banner-img:after{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #fff;
    opacity: .2;
}
*/
.banner-text h1{
    margin-bottom: 15px;
    font-size: 65px;
    font-family: rotato;
}

.banner-text h3{
    margin-bottom: 40px;
    font-size: 25px;
}

@media(max-width: 800px){
    .banner-area{
        min-height: 100vh;
    }

    .banner-text h1{
        font-size: 32px;
    }

    .banner-text h3{
        font-size: 20px;
    }

    .banner-area .banner-text{
        margin-top: 30vh;
    }
}

/*about area*/
.about-area{
    position: relative;
    margin-top: 100vh;
    padding-top: 0px;
}

ul.about-content{
    width: 100%;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.about-content li{
    padding: 20px;
    height: 290px;
    background-clip: content-box;
    -webkit-background-size: cover;
    background-size: cover;
    background-position: center;
}

.about-left{
    flex-basis: 40%;
    background-image: url(img/orion.webp);
}

.about-right{
    flex-basis: 60%;
    font-size: 25px;
}

.about-area p{
    max-width: 800px;
    margin-bottom: 35px;
    line-height: 1.5;
    text-align: left;
    padding-left: 0;
}

.section-title{
    text-transform: uppercase;
    font-size: 50px;
    margin-bottom: 5%;
}

.about-right h2{
    margin-bottom: 3%;
}


.about-area{
    margin-bottom: 150px;
    padding-bottom: 0;
    padding-top: 10px;
}

.about-btn{
    padding: 15px 35px;
    background: crimson;
    border-radius: 50px;
    text-transform: uppercase;
    color: #fff;
}

@media(max-width: 1025px){
    .about-area{
        margin-bottom: 250px;
        padding-bottom: 0;        
    }
}

@media(max-width: 1000px){
    .about-left, .about-right{
        flex-basis: 100%;
    }

    .section-title{
        font-size: 30px;
    }

    .about-right h2{
        font-size: 25px;
    }

    .about-right p{
        font-size: 20px;
    }

    .about-content li{
        padding: 8px;
        margin-bottom: 40px;
    }

    .about-btn{
        padding: 5px 15px;
        background: crimson;
        border-radius: 50px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 100px;
    }

}

/*service area*/

.services-area{
    padding-top: 50px;
    margin-top: 0;
}

#services{
    background: #ddd;
}

ul.services-content{
    width: 100%;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.services-content li{
    padding: 0 30px;
    flex-basis: 50%;
    text-align: center;
    font-size: 25px;
}

.services-content li i{
    font-size: 50px;
    color: crimson;
    margin-bottom: 25px;
}

.services-content li p{
    margin: 0;
}

@media(max-width: 1000px){
    .services-content li{
        flex-basis: 100%;
        margin-bottom: 65px;
    }

    .services-content li:last-child{
        margin-bottom: 0;
    }

    .services-content li h4{
        font-size: 25px;
    }

    .services-content li p{
        padding: 0;
        font-size: 20px;
    }
}

/*contact area*/

#contact{
    background: #fff;
}

ul.contact-content{
    width: 100%;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.contact-content li{
    padding: 0 30px;
    flex-basis: 33%;
    text-align: center;
    font-size: 25px;
}

.contact-content li i{
    font-size: 50px;
    color: crimson;
    margin-bottom: 25px;
}

@media(max-width: 1000px){
    .contact-content li{
        flex-basis: 100%;
        margin-bottom: 65px;
    }

    .contact-content li:last-child{
        margin-bottom: 0;
    }

    .contact-content li p{
        padding: 0;
        font-size: 25px;
    }
}

/* footer */

footer{
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    flex-direction: column;
    align-items:center;
    text-align: center;
    color: #fff;
    background-color: #000;
    padding: 60px 0;
}

.section_login{
	position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    justify-content: center;
    min-height: 100vh;
    color: #fff;
    text-align: center;
	
	background-image: url(img/space_2.webp);
	-webkit-background-size: cover;
    background-size: cover;
    z-index: -1;
}


.div_login{
    position: absolute;
    top: 40%;
    left: 50%;
	width: 20%;
	transform: translate(-50%, -50%);
}


.div_login h1{
    display: flex;
	font-size: 40px;
	border-bottom: 6px solid #ff4da6;
	margin-bottom: 50px;
    padding: 13px 0;
    width: 50%;
}

@media(max-width: 800px){
    .div_login h1{
        font-size: 30px;
    }
    .div_login{
        margin-left: 15px;
		
		top: 50%;
		left: 45%;
		width: 250px;
    }
}

@media(max-width: 1000px){
    .div_login h1{
        font-size: 35px;
    }
    .div_login{

        margin-left: 15px;
    }
}

.textbox{
    width: 100%;
    overflow: hidden;
    font-size: 20px;
    padding: 8px 0;
    margin: 8px 0;
    border-bottom: 1px solid #ff4da6;
    display: flex;
}

.textbox i{
    width: 26px;
    text-align: center;
    flex-basis: 10%;
}

.textbox input{
    border: none;
    outline: none;
    background:none;
    color: white;
    font-size: 18px;
    width: 80%;
    display: flex;
    margin: 0 10px;
}

.btn{
    width: 100%;
    background: none;
    border: 2px solid #ff4da6;
    color: white;
    padding: 5px;
    font-size: 18px;
    cursor: pointer;
    margin: 12px 0;
}

.neonText {
    color: #fff;
    animation: flicker 1.5s infinite alternate;  
    text-shadow:
        0 0 7px rgb(196, 196, 196),
        0 0 10px rgb(196, 196, 196),
        0 0 21px rgb(196, 196, 196),
        0 0 42px #ff4da6,
        0 0 82px #ff4da6,
        0 0 92px #ff4da6,
        0 0 102px #ff4da6,
        0 0 151px #ff4da6;
}

@keyframes flicker {
    
    0%, 18%, 22%, 25%, 53%, 57%, 100% {
  
        text-shadow:
        0 0 4px rgb(196, 196, 196),
        0 0 11px rgb(196, 196, 196),
        0 0 19px rgb(196, 196, 196),
        0 0 40px #ff4da6,
        0 0 80px #ff4da6,
        0 0 90px #ff4da6,
        0 0 100px #ff4da6,
        0 0 150px #ff4da6;
    
    }
    
    20%, 24%, 55% {        
        text-shadow: none;
    }    
  }

  @media(max-width: 1000px){
    .neonText {
        color: #fff;
        text-shadow: none;
    }

    @keyframes flicker {}
}

  /*new block*/
@import url("https://fonts.googleapis.com/css?family=Roboto:400,500,900&display=swap&subset=cyrillic-ext");

aside,
nav,
footer,
header,
section {
   display: block;
}

.header{
   position: fixed;
   left: 0;
   top: 0;
   width: 100%;
   z-index: 100;
}

.nav__logo{
   width: 50px;
   height: 50px;
   display: flex;
   align-items: center;
   pointer-events: none;
}

.company__name{
   margin-left: 15px;
   font-size: 30px;
}

.header:before{
   content: "";
   width: 100%;
   height: 100%;
   left: 0;
   top: 0;
   position: absolute;
}

.container{
   /*max-width: 1300px;*/
   /*margin: 0 auto;*/
   margin: 0 10px;
}

.header__nav{
   position: absolute;
   left: 0;
   top: 0;
   width: 100%;
   padding: 15px 0px;
}

.nav{
   position: relative;
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 0px 20px;
   height: 40px;
}

.nav__burger{
   display: none;
}

@media (max-width: 1000px){

   .nav{
      height: 50px;
      padding: 0;
   }

   .company__name{
      font-size: 20px;
      margin-left: 5px;
   }

   .nav__logo picture{
      display: none;
   }

   .nav:before{
      content: "";
      width: 100%;
      height: 100%;
      position: absolute;
      left: 0;
      top: 0;
      z-index: 2;
   }

   .nav__burger{
      display: block;
      position: relative;
      height: 22px;
      width: 30px;
      z-index: 3;
   }

   .container{
      margin: 0;
      padding: 0;
   }

   .nav__burger:before,
   .nav__burger:after{
      content: "";
      position: absolute;
      height: 2px;
      width: 100%;
      left: 0;
      background-color: #ff4da6;
      transition: all 0.4s ease 0s;
      -webkit-transition: all 0.4s ease 0s;
      -moz-transition: all 0.4s ease 0s;
      -ms-transition: all 0.4s ease 0s;
      -o-transition: all 0.4s ease 0s;
   }

   .nav__burger:before{
      top: 0;
   }

   .nav__burger:after{
      bottom: 0;
   }

   .nav__burger.active:before{
      transform: rotate(45deg);
      -webkit-transform: rotate(45deg);
      -moz-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      -o-transform: rotate(45deg);
      top: 10px;
   }

   .nav__burger.active:after{
      transform: rotate(-45deg);
      -webkit-transform: rotate(-45deg);
      -moz-transform: rotate(-45deg);
      -ms-transform: rotate(-45deg);
      -o-transform: rotate(-45deg);
      bottom: 10px;
   }

   .nav__burger span{
      position: absolute;
      height: 2px;
      width: 100%;
      left: 0;
      background-color: #ff4da6;
      top: 10px;
   }

   .nav__burger.active span{
      transform: scale(0);
      -webkit-transform: scale(0);
      -moz-transform: scale(0);
      -ms-transform: scale(0);
      -o-transform: scale(0);
   }

   .nav__body{
      position: fixed;
      width: 100%;
      height: 100%;
      left: 0;
      top: -100%;
      padding: 130px 0px 0px 0px;
      background-color: rgb(32, 32, 78, 0.98);
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: all 0.5s ease 0s;
      -webkit-transition: all 0.5s ease 0s;
      -moz-transition: all 0.5s ease 0s;
      -ms-transition: all 0.5s ease 0s;
      -o-transition: all 0.5s ease 0s;
      overflow: auto;
   }

   .nav__body.active{
      top: 0;
   }

   .nav__list{
      padding: 0px 0px 20px 0px;
   }

   .nav__link{
      font-size: 25px !important;
   }
}

.nav__logo{
   flex: 0 0 48px;
   z-index: 3;
}

.nav__logo img{
   width: 50px;
   height: 50px;
}

.nav__body{
   display: flex;
   flex-wrap: wrap;
   margin-right: 5px;
}

.nav__list{
   margin: 0px 0px 0px 18px;
}

.nav__link{
   color: rgb(252, 250, 250);
   font-size: 18px;
   text-transform: uppercase;
   transition: all 0.5s ease 0s;
   -webkit-transition: all 0.5s ease 0s;
   -moz-transition: all 0.5s ease 0s;
   -ms-transition: all 0.5s ease 0s;
   -o-transition: all 0.5s ease 0s;
   padding: 8px 10px;
   border-radius: 3px;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   -ms-border-radois: 3px;
   -o-border-radius: 3px;
}

.nav__link:hover {
   background: #ff4da6;
   color: #000;
}

.btn_set{
    width: 300px;
    background: none;
    border: 2px solid #ff4da6;
    color: #ff4da6;
    padding: 5px;
    font-size: 18px;
    cursor: pointer;
    margin: 12px 0;
}

.btn_set:hover{
    background: #ff4da6;
    color: white;
}
@media(max-width: 600px){
    .btn_set{
        width: 100%;
    }
}

.setting{
    margin-top: 10px;
    padding: 15px;
}

.short_info h3{
    margin-bottom: 5px;
}

.short_info p{
    margin: 0;
    max-width: 100%;
    margin-bottom: 5px;
    text-align: center;
    width: 100%;
}

.admin_panel{
    background-color: #ddd;
    padding: 15px;
}
.section_data{
    padding: 0;
    margin-top: 90px;
    
}

.get_data{
    padding: 15px 15px;
}

.reg_panel{
    background-image: url(img/reg_image_3.webp);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -webkit-background-size: cover;
    background-size: cover;
    z-index: -1;
}

.div_reg_panel{
    color: white;
    background-color: rgb(22%, 15%, 35%, 0.8);
    position: absolute;
    top: 40%;
    left: 50%;
	width: 30%;
	transform: translate(-50%, -50%);

    padding: 30px 30px 30px 30px;
}

@media (max-width: 800px){
    .div_reg_panel{
        top: 20%;
        left: 10%;
	    width: 80%;
        transform: translate(0, 0);
    }
}

.div_reg_panel h1{
  color: white;
  text-shadow:
    0 0 5px #fff,
    0 0 10px #fff,
    0 0 20px #fff,
    0 0 40px #ff4da6,
    0 0 80px #ff4da6,
    0 0 90px #ff4da6,
    0 0 100px #ff4da6,
    0 0 150px #ff4da6;

    margin-bottom: 20px;
    text-align: center;
}

.section_set_account{
    text-align: center;
}

.section_set_account .set_textbox{
    margin-top: 15px;
    margin-bottom: 15px;
    margin-left: 50%;
    transform: translate(-50%, -50%);
}

.section_set_account h1{
    margin-bottom: 15px;
}

.section_set_account p{
    margin: 0;
    max-width: 100%;
    margin-bottom: 10px;
}

.set_textbox{
    border: 1px solid #ff4da6;
    padding: 2px;
    outline: none;
    background:none;
    color: black;
    font-size: 18px;
    width: 200px;
    display: flex;
    flex-direction: column;
    margin: 0 10px;
}

.div_data{
    text-align: center;
}

.al_textbox{
    width: 40px;
    font-size: 16px;
    border: none;
    outline: none;
    background:none;
    color: black;
    cursor: default;
}

.change_select{
    border: 1px solid #ff4da6;
    padding: 2px;
    outline: none;
    background:none;
    color: black;
    font-size: 18px;
    width: 200px;
    display: flex;
    flex-direction: column;
    margin: 0 10px;
}

.change_account{
    margin-left: 30%;
    width: 60%;
}

.change_account h1{
    margin-bottom: 15px;
}

.change_account p{
    margin-bottom: 10px;
}

.section_account_list .styled-table{
    margin-left: 20%;
    width: 60%;
    font-size: 18px;
}

.section_account_list h1{
    text-align: center;
    margin-bottom: 15px;
}

.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #ff4da6;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #ff4da6;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #ff4da6;
}

.m_div_account_list{
    display: none;
}

@media (max-width: 1000px){
    .div_account_list{
        display: none;
    }
    .m_div_account_list{
        display: flex;
        flex-direction: column;
    }

    .section_account_list{
        margin: 0;
        padding: 0;
        margin-top: 100px;
    }

    .m_div_account_list{
        
    }

    .m_div_item_account_list{
        padding: 15px 10px 0px 10px;
    }

    .change_account{
        margin-left: 15px;
        width: 90%;
    }
}

.section_edits{
    margin: 0px;
    padding: 0px;
    width: 100%;
    text-align: center;

    margin-top: 100px;
    padding-bottom: 5px;
}


.section_edits .set_textbox{
    margin-left: 50%;
    transform: translate(-50%, 0);
    margin-bottom: 5px;
}

.section_edits h1{
    margin-bottom: 15px;
}
.section_edits h4{
    margin-bottom: 10px;
    font-size: 20px;
    padding-top: 10px;
}

.block_info{
    font-size: 18px;
    margin: 10px 0px 10px;
}

.class_edit{
    border: 1px solid #ff4da6;
    padding: 2px;
    outline: none;
    background:none;
    color: black;
    font-size: 18px;
    
    height: 150px;

    margin: 0;

    max-width: 100%;
    width: 95%;
    margin-left: 50px;
    margin-right: 50px;
}

@media(max-width: 1000px){
    .class_edit{
        width: 90%;
        margin-right: 15px;
        margin-left: 15px;
    }

    .section_edits .btn_set{
        margin-left: 15px;
        margin-right: 15px;
        width: 90%;
    }
}

.r2{
    background-color: #f3f3f3;
}

.r4{
    background-color: #f3f3f3;
}

/* Данные GPS */

.section_gps{
    /*margin-left: 30%;
    width: 60%;
    text-align: center;
    */
    width: 100%;
}

.div_gps{
    margin-left: 50%;
}

.div_gps h1{
    margin-bottom: 15px;
    color: red;
}

/* Метеоданные */
</style>