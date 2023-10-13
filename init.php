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

    // controlla nome pagina e restituisce il titolo corretto
    function controlNamePage($name_page): string {
        if ($name_page === 'index.php') {
            $name = 'WEB INPACT';
        } elseif ($name_page === 'docente.php') {
            $name =  'REGISTRO DOCENTE';
        } elseif ($name_page === 'elenco.php') {
            $name =  'REGISTRO ALUNNI';
        } elseif ($name_page === 'studente.php') {
            $name = 'PAGINA STUDENTE';
        }

        return $name;
    }

    // controlla errori login/registrazione
    function checkLog($email, $password, $conf_pwd = 0) {
        if (empty($email)) {
            throw new Exception('Campo email obbligatorio');
        }

        if (empty($password)) {
            throw new Exception('Campo password obbligatorio');
        }
        
        if (strlen($password) < 5) {
            throw new Exception('Password troppo corta');
        }
        
        if (($conf_pwd != 0) && ($password !== $conf_pwd)) {
            throw new Exception('Le password non coincidono');
        }

        return true;
    }
?>