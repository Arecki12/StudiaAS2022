<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <title>Kalkulator</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
</head>
<body class="is-preload">

<!-- Sidebar -->
<section id="sidebar">
    <div class="inner">
        <nav>
            <ul>
                <li><a href="#intro">Kalkulator</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Intro -->
    <section id="intro" class="wrapper style1 fullscreen fade-up">
        <div class="inner">
            <form action="" method="POST">
                <label for="id_x">Kwota: </label>
                <input id="id_x" type="text" name="x" value=""/><br/>
                <label for="id_y">Lata: </label>
                <input id="id_y" type="text" name="y" value=""/><br/>
                <label for="id_z">Oprocentowanie: </label>
                <input id="id_z" type="text" name="z" value=""/><br/>
                <input type="submit" class="btn btn-success" value="Oblicz"/>
            </form>
            {if !empty($result)}
                <div class="inner" style="background: green; padding: 15px;">
                    {$result}
                </div>
            {/if}

            {if !empty($error)}
                <div class="inner" style="background: red; padding: 15px;">
                    {$error}
                </div>
            {/if}

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