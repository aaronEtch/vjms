<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]> <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>vintners journal</title>
	<meta name="author" content="ecw">
	<meta name="Copyright" content="VJ 2012. All Rights Reserved.">	
	<meta name="viewport" content="width=device-width,minimum-scale=1, initial-scale=1.0, maximum-scale=1"> 	
	<link href='http://fonts.googleapis.com/css?family=Tinos:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url();?>/css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/css/jquery.ui.all.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/css/jquery.ui.selectmenu.css">
	<!--smartphones and mini tablets -->
	<link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 740px)' href='<?php echo base_url();?>css/stylesMobile.css' />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.button.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.datepicker.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.dialog.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.mouse.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.draggable.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.position.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.selectable.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.ui.selectmenu.js"></script>
	<script src="<?php echo base_url();?>js/ui/jquery.validate.js"></script>
	<script src="<?php echo base_url();?>js/my.js"></script>
</head>
<body>
<div id="wrapper">
	<header>
		<h1>
			<div id="logoBullet"></div>
			<a href="<?php echo site_url('members') ?>"><img src="/img/vjmsLogo.png" class="headerImage"></a>
 		</h1>
		<nav>
			<ul>
			<li><?php echo anchor('members','Home');?></li>	
			<li><?php if($this->session->userdata('username')){echo anchor('members/list_view', 'MyWines');} ?></li>
			<li><?php 
						//$userNamen = $this->session->userdata('username');
						//echo "test ".$userNamen;
		if($this->session->userdata('username'))
		{
				echo anchor('auth/logout', 'SignOff'); 
		}		
				?></li>
			</ul>
		</nav>		
	</header>
	<div id="contentContainer">