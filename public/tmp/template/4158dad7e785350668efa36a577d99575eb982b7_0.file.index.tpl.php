<?php
/* Smarty version 3.1.33, created on 2019-03-23 00:10:11
  from '/home/vagrant/code/SagrarioBautizos/public/views/acl/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c95796306fe04_10038691',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4158dad7e785350668efa36a577d99575eb982b7' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/acl/index.tpl',
      1 => 1553189866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c95796306fe04_10038691 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Listas de Acceso</h2>

<ul>
    <li>
        <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/roles">Administración de Roles</a>
    </li>
    <li>
        <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/permisos">Administración de Permisos</a>
    </li>
</ul><?php }
}
