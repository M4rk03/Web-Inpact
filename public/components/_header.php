<header>
    <figure> <a href="./index.php"> <img class="logo" src="./media/img/logo.webp" alt="logo Web Inpact"> </a> </figure>
    <h1 class="titolo"> WEB INPACT </h1>

    <?php 
        //PAGINA STUDENTE
        //REGISTRO DOCENTE
        //REGISTRO ALUNNI
    ?>

    <?php   // ACCOUNT
            //echo isset($_SESSION['nomeUtente']) ? 'si' : 'no';

            if (isset($_SESSION['nomeUtente'])) {
                echo '<div class="header-account menu">';

                echo '<div class="account-icon">';
                echo '<i class="fa-solid fa-circle-user"></i>';
                echo '<p> Account </p> </div>';

                echo '<div class="account-options">';
                echo '<p onclick="deleteAccount()"> Elimina </p>';
                echo '<a href="./login.php"> <p> <i class="fa-solid fa-xmark"></i> Esci </p> </a> </div>';
                
            } else {
                echo '<div class="header-account">';

                echo '<a href="./login.php" class="account-icon"> <i class="fa-solid fa-circle-user"></i>';
                echo '<p> Accedi </p> </a>';
            }

            echo '</div>';
        ?>
</header>