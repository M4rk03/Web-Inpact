<?php
    // controlla se la sessione è attiva, se no la starta
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    /* FUNZIONI */

    // rindirizza l'utente in una pagina
    function redirect($path = 'index.php') {
        header('Location: ' . $path);
    }

    // controlla errori login (Da fare)
    function checkLog($email, $password, $conf_pwd = 0) {
        $errors = [];

        if (empty($email)) {
            $errors[] = 'Campo email obbligatorio';
        }

        if (empty($password)) {
            $errors[] = 'Campo password obbligatorio';
        } else if (strlen($password) < 5) {
            $errors[] = 'Password troppo corta';
        } else if (($conf_pwd != 0) && ($password !== $conf_pwd)) {
            $errors[] = 'Le password non coincidono';
        }

        if (count($errors) <= 0) {
            return true;
        }

        return $errors;
    }
?>