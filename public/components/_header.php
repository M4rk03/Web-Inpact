<header>
    <figure> <a href="./index.php"> <img class="logo" src="./media/img/logo.webp" alt="logo Web Inpact"> </a> </figure>
    <h1 class="titolo">
        <?php
            $name_page = basename($_SERVER['PHP_SELF']);
            echo controlNamePage($name_page);
        ?>
    </h1>

    <?php   // ACCOUNT

            if (isset($_SESSION['nomeUtente']) && $_SESSION["tipo"] != 1) {
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
                echo '<p>';
                echo isset($_SESSION['tipo']) ? 'Logout' : 'Accedi';
                echo '</p> </a>';
            }

            echo '</div>';
        ?>
</header>