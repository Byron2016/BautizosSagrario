<?php
/* Smarty version 3.1.33, created on 2019-03-12 20:56:26
  from '/home/vagrant/code/SagrarioBautizos/public/views/post/nuevo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c881cfa7ecf28_78160114',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b2bf863a2502388312a18a30e051f7ce992a4c5b' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/post/nuevo.tpl',
      1 => 1552424158,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c881cfa7ecf28_78160114 (Smarty_Internal_Template $_smarty_tpl) {
?><form id="form1" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
post/nuevo" 
     enctype='multipart/form-data'>
    <input type="hidden" name="guardar" value="1" />
    <p>Titulo:<br />
    <input type="texto" name="titulo" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['titulo'])===null||$tmp==='' ? '' : $tmp);?>
"/></p>
    
    <p>Cuerpo:<br />
    <textarea name="cuerpo"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos']->value['cuerpo'])===null||$tmp==='' ? '' : $tmp);?>
</textarea></p>
    <input type="file" name="imagen"/>
     
      
    <p><input type="submit" class="button" value="Guardar" /></p><?php }
}
