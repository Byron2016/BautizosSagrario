<?php
/* Smarty version 3.1.33, created on 2019-02-28 19:59:38
  from '/home/vagrant/code/SagrarioBautizos/public/views/layout/layout1/template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c783daab72079_37210119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e0886f25fc4332e116e0da04db8de8dd919b21d' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/layout/layout1/template.tpl',
      1 => 1551383971,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c783daab72079_37210119 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['titulo']->value)===null||$tmp==='' ? "Sin título" : $tmp);?>
</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
estilos.css" rel="stylesheet" type="text/css" />
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/jquery.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/jquery.validate.js" type="text/javascript"><?php echo '</script'; ?>
>
    <!-- Para aumentar los js personalidos -->
    <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['js']) && count($_smarty_tpl->tpl_vars['_layoutParams']->value['js'])) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_layoutParams']->value['js'], 'js');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['js']->value) {
?>
            <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" type="text/javascript"><?php echo '</script'; ?>
>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
</head>
<body>
    <div id ="main">
        <div id="header">
            <div id="logo">
                <h1><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_name'];?>
</h1>
            </div>
            <div id="menu">
                <div id="top_menu">
                    <ul>
                    <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['menu'])) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_layoutParams']->value['menu'], 'it');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['it']->value) {
?>

                            <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['item']) && $_smarty_tpl->tpl_vars['_layoutParams']->value['item'] == $_smarty_tpl->tpl_vars['it']->value['id']) {?>

                            	<?php $_smarty_tpl->_assignInScope('_item_style', 'current');?>  

                            <?php } else { ?>

                                <?php $_smarty_tpl->_assignInScope('_item_style', '');?>
                                
                            <?php }?>
                            
                            <li><a class="<?php echo $_smarty_tpl->tpl_vars['_item_style']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['it']->value['enlace'];?>
"><?php echo $_smarty_tpl->tpl_vars['it']->value['titulo'];?>
</a></li>
                    	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    </ul>
            	</div>
        	</div>
    	</div>
        <div id="content">
            <noscript><p>Para el correcto funcionamiento debe tener el soporte de javascript habilitado</p></noscript>
            <?php if (isset($_smarty_tpl->tpl_vars['_error']->value)) {?>
            	<div id="error"><?php echo $_smarty_tpl->tpl_vars['_error']->value;?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['_mensaje']->value)) {?>
                <div id="mensaje"><?php echo $_smarty_tpl->tpl_vars['_mensaje']->value;?>
</div>
            <?php }?>

            <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['_contenido']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

        </div>
        <div id="footer">Copyright &COPY; 2014 <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_company'];?>
</div>
    </div>
</body>
</html><?php }
}
