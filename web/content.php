        <?php		
			
            $p = $_GET['page'];
            if(!isset($p)||$p>10||$p<=0){
                $p = 0;
        ?>
            
            <section class="banner-area">
                <style>
                    .header{
                        background-color: rgb(23%, 23%, 44%, 0.6);
                        padding-bottom: 10px;
                    }
                </style>
                <div class="banner-img">

                    <div class="banner-text">
                        <h1 class="glow">ОРИОН</h1>
                        <h3 class="glow">ЦЕНТР ЛАЗЕРНО-ОПТИЧЕСКИХ ИЗМЕРЕНИЙ</h3>
                    </div>
                </div>
            </section>
            
            <?
            
                    $conn = new mysqli($servername, $username, $password, $dbname, $port);
					
					$conn->set_charset("utf8");
								
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

                    $sql = "SELECT * FROM site_info WHERE id = '1'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        $row = $result->fetch_assoc();
            ?>

			<section class="about-area" id="about">
                <h3 class="section-title">О компании</h3>

                <ul class="about-content">
                    <li class="about-left">
                    </li>
                    <li class="about-right">
                        <h2><?echo $row['section'];?></h2>
                        <p><?echo $row['info'];?></p>
                        <a href="https://www.dstu.education/ru/orion.php" class="about-btn">Узнать больше</a>
                    </li>
                </ul>

            </section>

            <?
                    }
                    $sql = "SELECT * FROM site_info WHERE id = '2'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        $row = $result->fetch_assoc();
            ?>
            <section class="services-area" id="services">
                <h3 class="section-title">Службы</h3>
                <ul class="services-content">
                    <li>
                        <i class="fa fa-signal"></i>
                        <h4><?echo $row['section'];?></h4>
                        <p><?echo $row['info'];?></p>
                    </li>

                    <?
                    }
                    $sql = "SELECT * FROM site_info WHERE id = '3'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        $row = $result->fetch_assoc();
                    ?>

                    <li>
                        <i class="fa fa-eye"></i>
                        <h4><?echo $row['section'];?></h4>
                        <p><?echo $row['info'];?></p>
                    </li>
                    <?
                    }
                    ?>
                </ul>
            </section>

            <section class="contact-area" id="contact">

                <h3 class="section-title">Контакты</h3>
                
                <ul class="contact-content">
                    <li>
                    <?
                    $sql = "SELECT * FROM site_info WHERE id = '4'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        $row = $result->fetch_assoc();
                    ?>
                        <i class="fa fa-map-marker"></i>
                        <p><?echo $row['info'];?></p>
                        <?}?>
                    </li>

                    <li>
                        <?
                        $sql = "SELECT * FROM site_info WHERE id = '5'";


                        $result = $conn->query($sql);
    
                        if($result->num_rows){
                            $row = $result->fetch_assoc();
                        ?>
                        <i class="fa fa-phone"></i>
                        <p><?echo $row['info'];?></p>
                        <?}?>
                    </li>

                    <li>
                        <?
                        $sql = "SELECT * FROM site_info WHERE id = '6'";


                        $result = $conn->query($sql);
    
                        if($result->num_rows){
                            $row = $result->fetch_assoc();
                        ?>
                        <i class="fa fa-envelope"></i>
                        <p><?echo $row['info'];?></p>
                        <?}?>
                    </li>
                </ul>

            </section>
<?
            }

            else if($p==1){
                if(!isset($_SESSION['authorized'])){
                ?>
                <style>
                    .header{
                        background-color: rgb(23%, 23%, 44%, 0.6);
                        padding-bottom: 10px;
                    }
                </style>
                <form method="post">
                    <section class="section_login">
                    <div class="div_login">
                        <h1 class="neonText">Авторизация</h1>
                        <div class="textbox">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <input type="text" placeholder="Имя" name="log_name" value="">
                        </div>
                        
                        <div class="textbox">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input type="password" placeholder="Пароль" name="log_password" value="">
                        </div>
                        
                        <input type="submit" name="login" value="Вход" id="login" class="btn">
                        
                        <input type="submit" name="reg" value="Регистрация" id="reg" class="btn">

                        <p><? echo $_SESSION['authorized_error'];?></p>
                    </div>
                    </section>
                </form>
            <?php
                }
                else{
                    //ВЗЛОМ
                }
            }

            else if($p==2){

                    if($_SESSION['user_name']==''){
                        //ОШИБКА. ВЗЛОМ САЙТА
                    }
                    else{
                    $conn = new mysqli($servername, $username, $password, $dbname, $port);
					
					$conn->set_charset("utf8");
								
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

                    $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
               ?>

            <style>
                .header{
                    background-color: rgb(23%, 23%, 44%, 0.6);
                    padding-bottom: 10px;
                }
            </style>

            <section class="section_data">
                <div class="div_data">
                    
                    <div class="setting">
                        <h1>Настройки</h1>
                        <form method="POST">
                            <input type="submit" name="set_account" value="Настройки аккаунта" class="btn_set">
                        </form>

                        <form method="POST">
                            <input type="submit" name="exit_btn" value="Выход" class="btn_set">
                        </form>
                        
                        <div class="short_info">
                            <h3>Краткая информация об аккаунте:</h3>
                            <p>Имя пользователя: <?echo $_SESSION['user_name'];?></p>
                            <p>Уровень аккаунта: <?
                            
                            if($_SESSION['lvl']==1){
                                echo 'Администратор';
                            }
                            else{
                                echo 'Пользователь';
                            }
                            
                            ?></p>
                        </div>
                    </div>

                    <?
                    if($_SESSION['lvl']==1){
                    ?>
                    <div class="admin_panel">
                        <h1>Панель администрирования</h1>
                        <form method="POST">
                            <input type="submit" name="account_list" value="Список аккаунтов" class="btn_set">
                        </form>
                        
                        <form method="POST">
                            <input type="submit" name="edit_sections" value="Редактирование разделов" class="btn_set">
                        </form>
                    </div>
                    <?
                    }
                    ?>

                    <div class="get_data">
                        <h1>Полученные данные</h1>
                        <div class="data_block_1">

                        <form method="POST">
                            <input type="submit" name="btn_gps" value="GPS" class="btn_set">
                        </form>

                        </div>

                        <div class="data_block_2">

                        <form method="POST">
                            <input type="submit" name="btn_mtd" value="Метеоданные" class="btn_set">
                        </form>
                            
                        </div>

                    </div>
                </div>
            </section>

            <?
                }
                else{
                    //ПОПЫТКА ВЗЛОМА
                }
            }
            }

            else if($p==3){

                if(isset($_SESSION['user_name'])){
                    //ПОПЫТКА ВЗЛОМА
                }
                else{

                ?>
                <style>
                    .header{
                        background-color: rgb(23%, 23%, 44%, 0.6);
                        padding-bottom: 10px;
                    }
                </style>
                <form method='POST'>
                    <section class="reg_panel">
                        <div class="div_reg_panel">
                            <h1>Регистрация</h1>
                            <div class="textbox">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Имя" name="reg_name" value="">
                            </div>
                            
                            <div class="textbox">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" placeholder="Пароль" name="reg_password" value="">
                            </div>

                            <div class="textbox">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" placeholder="Повторите пароль" name="reg_password_rep" value="">
                            </div>
                            
                            <input type="submit" name="reg_btn" value="Зарегистрировать" id="reg" class="btn">

                            <p><?echo $_SESSION['reg_error'];?></p>
                        </div>
                    </section>
                </form>
            <?
            }
        }

            else if($p==4){
                if($_SESSION['user_name']==''){
                    //ОШИБКА. ВЗЛОМ САЙТА
                }
                else{
                $conn = new mysqli($servername, $username, $password, $dbname, $port);
                
                $conn->set_charset("utf8");
                            
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


                $result = $conn->query($sql);

                if($result->num_rows){
                    //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
            ?>

            <style>
                .header{
                    background-color: rgb(23%, 23%, 44%, 0.6);
                    padding-bottom: 10px;
                }
            </style>

            <form method="POST">
                <section class="section_set_account">
                    <h1>Настройки аккаунта</h1>
                    <p>Имя: <input class="set_textbox" type="text" placeholder="Имя" name="set_account_name" value="<? echo $_SESSION['user_name'];?>"></p>
                    <p>Пароль: <input class="set_textbox" type="text" placeholder="Пароль" name="set_account_password" value="<? echo $_SESSION['password'];?>"></p>
                    <p>Уровень доступа: <?
                                
                    if($_SESSION['lvl']==1){
                        echo 'Администратор';
                    }
                    else{
                        echo 'Пользователь';
                    }
                                
                    ?></p>
                    
                    <input type="submit" name="set_account_save" value="Сохранить" id="login" class="btn_set">
                    <p>
                        <?
                            echo $_SESSION['set_account_error'];
                        ?>
                    </p>
                </section>
            </form>
            <?
            }
            else{
                //ПОПЫТКА ВЗЛОМА
            }

        }
    }

            else if($p==5){

                if(empty($_SESSION['user_name'])){
                    //Попытка взлома
                }
                else{
                    $conn = new mysqli($servername, $username, $password, $dbname, $port);
					
					$conn->set_charset("utf8");
								
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

                    $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


                    $result = $conn->query($sql);

                    if($result->num_rows){
                        //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
                            $row = $result->fetch_assoc();
                            if($row['lvl']==="1"){

                ?>
                <style>
                    .header{
                        background-color: rgb(23%, 23%, 44%, 0.6);
                        padding-bottom: 10px;
                    }
                </style>

                <section class="section_account_list">
                    <div class="div_account_list">
                        <h1>Список пользователей сайта</h1>

                        <?
                        //Получение списка пользователей
                        $sql = "SELECT * FROM users";

                        $result = $conn->query($sql);

                        if ($result->num_rows) {
                            ?>
                            <table class="styled-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Имя</th>
                                            <th>Пароль</th>
                                            <th>Уровень доступа</th>
                                            <th>Управление</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?
                            while($row = $result->fetch_assoc()) {
                                ?>                             
                                        <tr>
                                            <form method="POST">
                                                <td><input name="account_list_id" value="<? echo $row['id'];?>" class="al_textbox" readonly="readonly"></td>
                                                <td><?echo $row['nick'];?></td>
                                                <td><?echo $row['password']?></td>
                                                <td><?
                                                if($row['lvl']==1){
                                                    echo 'Администратор';
                                                }
                                                else{
                                                    echo 'Пользователь';
                                                }?>
                                                </td>
                                                <td>
                                                    <input type="submit" name="list_account_edit_btn" value="Редактировать" class="btn_set">
                                                </td>
                                            </form>
                                        </tr>
                                <?
                            }
                            ?>
                            </tbody>
                            </table>
                            <?

                        ?>
                    </div>



                    <!--Мобильная версия-->

                    <div class="m_div_account_list">
                        <h1>Список пользователей сайта</h1>

                        <?
                        //Получение списка пользователей
                        $sql = "SELECT * FROM users";

                        $result = $conn->query($sql);

                        if ($result->num_rows) {
                            $count = 0;
                            while($row = $result->fetch_assoc()) {
                                ?>
                                    <form method="POST">
                                        <?
                                        if($count%2==0){
                                        ?>
                                            <div class="m_div_item_account_list">
                                        <?
                                        }
                                        else{
                                        ?>
                                            <div class="m_div_item_account_list" style="background-color: #f3f3f3">
                                        <?
                                        }
                                        ?>
                                            <p>Идентификатор: <input name="account_list_id" value="<? echo $row['id'];?>" class="al_textbox" readonly="readonly"></p>
                                            <p>Имя: <?echo $row['nick'];?></p>
                                            <p>Пароль: <?echo $row['password'];?></p>
                                            <p>Статус: <?
                                                        if($row['lvl']==1){
                                                            echo 'Администратор';
                                                        }
                                                        else{
                                                            echo 'Пользователь';
                                                        }
                                                        $count++;
                                                        ?></p>
                                            <input type="submit" name="list_account_edit_btn" value="Редактировать" class="btn_set">
                                        </div>
                                    </form>
                                <?
                            }
                        }
                        ?>

                    </div>

                </section>
                <?
                    }
                    else{
                        //ПОПЫТКА ВЗЛОМА
                    }
                }
                    else{
                        //ПОПЫТКА ВЗЛОМА
                    }
            }
                }
        }

        else if($p==6){

            if(empty($_SESSION['user_name'])){
                //Попытка взлома
            }
            else{
                $conn = new mysqli($servername, $username, $password, $dbname, $port);
                
                $conn->set_charset("utf8");
                            
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


                $result = $conn->query($sql);

                if($result->num_rows){
                    //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
                    if($result->num_rows){
                        $row = $result->fetch_assoc();
                        if($row['lvl']==="1"){

            ?>
            <style>
                .header{
                    background-color: rgb(23%, 23%, 44%, 0.6);
                    padding-bottom: 10px;
                }
            </style>
                <form method="POST">
                    <section class="change_account">

                        <?
                        $conn = new mysqli($servername, $username, $password, $dbname, $port);
					
                        $conn->set_charset("utf8");
                                    
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
    
                        if(empty($_SESSION['change_account_id'])){
                            $sql = "SELECT * FROM users WHERE id='".$_POST['account_list_id']."'";
                        }
                        else{
                            $sql = "SELECT * FROM users WHERE id='".$_SESSION['change_account_id']."'";
                            $_POST['account_list_id'] = $_SESSION['change_account_id'];
                            $_SESSION['change_account_id'] = '';
                        }

                        $result = $conn->query($sql);

                        $row = $result->fetch_assoc();
                        ?>

                        <h1>Управление аккаунтом</h1>
                        <p>Идентификатор: <input name="change_account_id" value="<? echo $_POST['account_list_id'];?>" class="al_textbox" readonly="readonly"></p>
                        <p>Имя: <input class="set_textbox" type="text" placeholder="Имя" name="change_account_name" value="<? echo $row['nick'];?>"></p>
                        <p>Пароль: <input class="set_textbox" type="text" placeholder="Пароль" name="change_account_password" value="<? echo $row['password'];?>"></p>
                        <p>Уровень доступа: 
                        <select class="change_select" name="select_level">
                            <?
                            if($row['lvl']==0){
                            ?>
                            <option selected value='0'>
                                Пользователь
                            </option>
                            <option value='1'>
                                Администратор
                            </option>
                            <?
                            }
                            else{
                            ?>
                            <option value='0'>
                                Пользователь
                            </option>
                            <option selected value='1'>
                                Администратор
                            </option>
                            <?}?>
                        </select>
                        </p>
                        <input type="submit" name="change_account" value="Сохранить" class="btn_set">
                        <?echo $_SESSION['change_account_error'];
                        $_SESSION['change_account_error']='';?>
                    </section>
                </form>
            <?
            }
                    else{
                        //ПОПЫТКА ВЗЛОМА
                    }
                }
                    else{
                        //ПОПЫТКА ВЗЛОМА
                    }
        }
        }
    }
    else if($p==7){
        if(empty($_SESSION['user_name'])){
            //Попытка взлома
        }
        else{
            $conn = new mysqli($servername, $username, $password, $dbname, $port);
            
            $conn->set_charset("utf8");
                        
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


            $result = $conn->query($sql);

            if($result->num_rows){
                //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
                if($result->num_rows){
                    $row = $result->fetch_assoc();
                    if($row['lvl']==="1"){
                        //ВХОД С АДМИНИСТРАТОРА

        ?>
        <style>
            .header{
                background-color: rgb(23%, 23%, 44%, 0.6);
                padding-bottom: 10px;
            }
        </style>
            <form method="POST">
            
                <section class="section_edits">
                <?  
                $conn = new mysqli($servername, $username, $password, $dbname, $port);
            
                $conn->set_charset("utf8");
                            
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM site_info WHERE id='1'";

                $result = $conn->query($sql);

                $row = $result->fetch_assoc();

                ?>

                    <h1>Редактирование разделов сайта</h1>

                    <h4>РАЗДЕЛ 1</h4>
                    <div class="block_info">Пункт</div>
                    <textarea class="class_edit" name="edit_about_us"><?echo $row['section'];?></textarea>
                    <div class="block_info">Информация:</div>
                    <textarea class="class_edit" name="edit_about_us_info"><?echo $row['info'];?></textarea>

                    <?$sql = "SELECT * FROM site_info WHERE id='2'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();?>

                    <div class="r2">
                    <h4>РАЗДЕЛ 2</h4>
                    <div class="block_info">Пункт 1</div>
                    <textarea class="class_edit" name="edit_r2_1"><?echo $row['section'];?></textarea>
                    <div class="block_info">Информация:</div>
                    <textarea class="class_edit" name="edit_r2_1_info"><?echo $row['info'];?></textarea>

                    <?$sql = "SELECT * FROM site_info WHERE id='3'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();?>

                    <div class="block_info">Пункт 2</div>
                    <textarea class="class_edit" name="edit_r2_2"><?echo $row['section'];?></textarea>
                    <div class="block_info">Информация:</div>
                    <textarea class="class_edit" name="edit_r2_2_info"><?echo $row['info'];?></textarea>

                    <?$sql = "SELECT * FROM site_info WHERE id='4'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();?>
                    </div>

                    <h4>РАЗДЕЛ 3</h4>
                    <div class="block_info">Адрес</div>
                    <input class="set_textbox" type="text" placeholder="Адрес" name="edit_r3_1" value="<?echo $row['info'];?>">

                    <?$sql = "SELECT * FROM site_info WHERE id='5'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();?>

                    <div class="block_info">Телефон</div>
                    <input class="set_textbox" type="text" placeholder="Телефон" name="edit_r3_2" value="<?echo $row['info'];?>">

                    <?$sql = "SELECT * FROM site_info WHERE id='6'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();?>

                    <div class="block_info">e-mail</div>
                    <input class="set_textbox" type="text" placeholder="e-mail" name="edit_r3_3" value="<?echo $row['info'];?>">

                    <?$sql = "SELECT * FROM site_info WHERE id='7'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();?>

                    <div class="r4">
                    <h4>Подвал сайта</h4>
                    <textarea class="class_edit" name="footer_info"><?echo $row['info'];?></textarea>
                    </div>

                    <input type="submit" name="edit_sections_btn" value="Сохранить" class="btn_set">

                </section>

            </form>
        <?
    }
    else{
        //ПОПЫТКА ВЗЛОМА
    }
}
    else{
        //ПОПЫТКА ВЗЛОМА
    }
}
}
}

else if($p==8){
    if(empty($_SESSION['user_name'])){
        //Попытка взлома
    }
    else{
        $conn = new mysqli($servername, $username, $password, $dbname, $port);
        
        $conn->set_charset("utf8");
                    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


        $result = $conn->query($sql);

        if($result->num_rows){
            //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
            if($result->num_rows){
                $row = $result->fetch_assoc();
                if($row['lvl']==="1"){
                    //ВХОД С АДМИНИСТРАТОРА

    ?>
    <style>
        .header{
            background-color: rgb(23%, 23%, 44%, 0.6);
            padding-bottom: 10px;
        }
    </style>
        <form method="POST">
        
            <section name="section_gps">
                <div name="div_gps">
                    <h1>Данные GPS</h1>

                    <p>Проверка</p>
                    <p>Проверка</p>
                    <p>Проверка</p>
                    <p>Проверка</p>
                </div>
            </section>

        </form>
    <?
}
else{
    //ПОПЫТКА ВЗЛОМА
}
}
else{
    //ПОПЫТКА ВЗЛОМА
}
}
}
}

else if($p==9){
    if(empty($_SESSION['user_name'])){
        //Попытка взлома
    }
    else{
        $conn = new mysqli($servername, $username, $password, $dbname, $port);
        
        $conn->set_charset("utf8");
                    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE nick='".$_SESSION['user_name']."' and password = '".$_SESSION['password']."'";


        $result = $conn->query($sql);

        if($result->num_rows){
            //СУЩЕСТВУЕТ ТАКОЙ АККАУНТ
            if($result->num_rows){
                $row = $result->fetch_assoc();
                if($row['lvl']==="1"){
                    //ВХОД С АДМИНИСТРАТОРА

    ?>
    <style>
        .header{
            background-color: rgb(23%, 23%, 44%, 0.6);
            padding-bottom: 10px;
        }
    </style>
        <form method="POST">
        
        <section name="section_mtd">

            <h3>Метеоданные</h3>

        </section>
            
        </form>
    <?
}
else{
    //ПОПЫТКА ВЗЛОМА
}
}
else{
    //ПОПЫТКА ВЗЛОМА
}
}
}
}
?>