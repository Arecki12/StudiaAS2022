<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Log In</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>
<body class="is-preload">

<!-- Sidebar -->
<section id="sidebar">
    <div class="inner">
        <nav>
            <ul>
                <li><a href="#intro">Log In</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Intro -->
    <section id="intro" class="wrapper style1 fullscreen fade-up">
        <div class="inner">
            <form action="<?php print(_APP_ROOT); ?>/app/login.php" method="post" class="pure-form pure-form-stacked">
                <legend>Logowanie</legend>
                <fieldset>
                    <label for="id_login">login: </label>
                    <input id="id_login" type="text" name="login" value="<?php out($form['login']); ?>" />
                    <label for="id_pass">pass: </label>
                    <input id="id_pass" type="password" name="pass" />
                </fieldset>
                <input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
            </form>

            <?php
            //wyświeltenie listy błędów, jeśli istnieją
            if (isset($messages)) {
                if (count ( $messages ) > 0) {
                    echo '<ol style="padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
                    foreach ( $messages as $key => $msg ) {
                        echo '<li>'.$msg.'</li>';
                    }
                    echo '</ol>';
                }
            }
            ?>
    </section>


</div>

<!-- Footer -->
<footer id="footer" class="wrapper style1-alt">
    <div class="inner">
        <ul class="menu">
        </ul>
    </div>
</footer>

</body>

</html>