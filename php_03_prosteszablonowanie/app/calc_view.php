<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <title>Kalkulator</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>
<body class="is-preload">

<!-- Sidebar -->
<section id="sidebar">
    <div class="inner">
        <nav>
            <ul>
                <li><a href="#intro">Kalkulator</a></li>
                <li><a href="login_view.php" type="button" >Logout</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Intro -->
    <section id="intro" class="wrapper style1 fullscreen fade-up">
        <div class="inner">
            <form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
                <label for="id_x">Kwota: </label>
                <input id="id_x" type="text" name="x" value="<?php print($x ?? ' '); ?>" /><br />
                <label for="id_y">Lata: </label>
                <input id="id_y" type="text" name="y" value="<?php print($y ?? ' '); ?>" /><br />
                <label for="id_z">Oprocentowanie: </label>
                <input id="id_z" type="text" name="z" value="<?php print($z ?? ' '); ?>" /><br />
                <input type="submit" class="btn btn-success" value="Oblicz" />
            </form>
            <?php
            //wyświeltenie listy błędów, jeśli istnieją
            if (isset($messages)) {
                if (count ( $messages ) > 0) {
                    echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
                    foreach ( $messages as $key => $msg ) {
                        echo '<li>'.$msg.'</li>';
                    }
                    echo '</ol>';
                }
            }
            ?>

            <?php if (isset($result)){ ?>
                <div class="inner">
                    <?php echo 'Wynik: '.$result; ?>
                </div>
            <?php } ?>
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