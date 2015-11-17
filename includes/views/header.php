<!doctype html>
<html>
<head>

    <title><?=(isset($this->title)) ? $this->title : 'NO TITLE'; ?></title>

    <!-- Jquery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />

    <!-- Custom CSS (READ THIS PLEASE, TNX : http://verekia.com/less-css/dont-read-less-css-tutorial-highly-addictive)-->
    <link rel="stylesheet" href="<?php echo URL; ?>/css/default.css" />

    <!-- Font awesome-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Bootstrap Original-->
    <!--link rel="stylesheet" href="<?php //echo URL; ?>/css/bootstrap.min.css" /-->
    <!--link rel="stylesheet" href="<?php //echo URL; ?>/css/bootstrap-theme.min.css" /-->

    <!-- Bootstrap Theme-->
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css" rel="stylesheet" integrity="sha256-hMIwZV8FylgKjXnmRI2YY0HLnozYr7Cuo1JvRtzmPWs= sha512-k+wW4K+gHODPy/0gaAMUNmCItIunOZ+PeLW7iZwkDZH/wMaTrSJTt7zK6TGy6p+rnDBghAxdvu1LX2Ohg0ypDw==" crossorigin="anonymous">
    <script type="text/javascript" src="<?php echo URL; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/js/npm.js"></script>

    <?php
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }
    }
    ?>
</head>
<body>
    
<div id="header">

    <?php if(!Session::get('my_user')) :?>
        <a href="<?php echo URL; ?>index">Index</a>
        <a href="<?php echo URL; ?>help">Help</a>
    <?php endif; ?>
    <?php if(Session::get('my_user')) :?>
        <a href="<?php echo URL; ?>dashboard">Dashboard</a>
        <a href="<?php echo URL; ?>note">Notes</a>

        <a href="<?php echo URL; ?>auth/doLogout"> logout</a>
    <?php else: ?>
        <a href="<?php echo URL; ?>auth"> login</a>
    <?php endif; ?>
</div>
    
<div id="content">
    
    