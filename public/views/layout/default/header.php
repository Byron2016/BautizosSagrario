<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php if(isset($this->titulo))  echo $this->titulo;?></title>
		<link href="<?php echo $_layoutParams['ruta_css'];?>estilos1.css" rel="stylesheet" type="text/css" >
	</head>

	<body>
		<div id="main">
			<div id="header">
				<div id="logo">
					<h1><?php   echo APP_NAME;?></h1>
				</div>
			</div>
				<div id="menu">
					<div id="menu_top">
						<ul>
							<?php if(isset($_layoutParams['menu'])):?>
								<?php for($i = 0; $i < count($_layoutParams['menu']); $i++):?>
									<?php 
		                                if($item && $_layoutParams['menu'][$i]['id'] == $item ){ 
		                                    $_item_style = 'current'; 
		                                } else {
		                                    $_item_style = '';
		                                }
		                            ?>


								<li>
									<a class="<?php echo $_item_style; ?>" href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>"><?php echo $_layoutParams['menu'][$i]['titulo']; ?>
									</a>
								</li>
								<?php endfor; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
