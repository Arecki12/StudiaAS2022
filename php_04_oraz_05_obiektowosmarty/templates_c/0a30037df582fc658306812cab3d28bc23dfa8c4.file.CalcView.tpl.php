<?php /* Smarty version Smarty-3.1.17, created on 2022-11-05 14:26:56
         compiled from "C:\xampp7.4\htdocs\obiektowo\app\View\CalcView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152669683463666271b72780-02035031%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a30037df582fc658306812cab3d28bc23dfa8c4' => 
    array (
      0 => 'C:\\xampp7.4\\htdocs\\obiektowo\\app\\View\\CalcView.tpl',
      1 => 1667654812,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152669683463666271b72780-02035031',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_63666271bd71a8_18647449',
  'variables' => 
  array (
    'result' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63666271bd71a8_18647449')) {function content_63666271bd71a8_18647449($_smarty_tpl) {?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <title>Kalkulator</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/obiektowo/app/assets/css/main.css"/>
    <noscript>
        <link rel="stylesheet" href="/obiektowo/app/assets/css/noscript.css"/>
    </noscript>
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
            <?php if (!empty($_smarty_tpl->tpl_vars['result']->value)) {?>
                <div class="inner" style="background: forestgreen; padding: 10px 15px;">
                    <?php echo $_smarty_tpl->tpl_vars['result']->value;?>

                </div>
            <?php }?>

            <?php if (!empty($_smarty_tpl->tpl_vars['error']->value)) {?>
                <div class="inner" style="background: indianred; padding: 10px 15px;">
                    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

                </div>
            <?php }?>

    </section>


</div>

<!-- Footer -->
<footer id="footer" class="wrapper style1-alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Untitled. All rights reserved.</li>
            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
        </ul>
    </div>
</footer>

<!-- Scripts -->
<script src="/obiektowo/app/assets/js/jquery.min.js"></script>
<script src="/obiektowo/app/assets/js/jquery.scrollex.min.js"></script>
<script src="/obiektowo/app/assets/js/jquery.scrolly.min.js"></script>
<script src="/obiektowo/app/assets/js/browser.min.js"></script>
<script src="/obiektowo/app/assets/js/breakpoints.min.js"></script>
<script src="/obiektowo/app/assets/js/util.js"></script>
<script src="/obiektowo/app/assets/js/main.js"></script>

</body>

</html><?php }} ?>
