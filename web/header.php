<!--<header>
    <h2><a href="#">ОРИОН</a></h2>
    <nav>
        <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#about">О нас</a></li>
            <li><a href="#services">Службы</a></li>
            <li><a href="#contact">Контакты</a></li>
            <li><a href="login.php">Вход</a></li>
        </ul>
     </nav>
</header>-->

      <header class="header">
         <div class="container">
            <nav class="header__nav nav">

               <a href="#" class="nav__logo">
                    <picture>
                        <img src="img/logo.png" alt="logotip">
                    </picture>
                    <p class="company__name">ОРИОН</p>
                </a>

               <ul class="nav__body">
                  <li class="nav__list">
                     <a href="#" class="nav__link">Главная</a>
                  </li>

                  <li class="nav__list">
                     <a href="#about" class="nav__link">О нас</a>
                  </li>

                  <li class="nav__list">
                     <a href="#services" class="nav__link">Службы</a>
                  </li>

                  <li class="nav__list">
                     <a href="#contact" class="nav__link">Контакты</a>
                  </li>

                  <li class="nav__list">
                     <?
                     if(!isset($_SESSION['authorized'])){
                     ?>
                        <a href="?page=1" class="nav__link">Вход</a>
                     <?
                     }
                     else{
                     ?>
                        <a href="?page=2" class="nav__link">Информация</a>
                     <?
                     }
                     ?>
                  </li>
               </ul>

               <div class="nav__burger">
                    <span></span>
               </div>
            </nav>
         </div>
      </header>

      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/script.js"></script>
