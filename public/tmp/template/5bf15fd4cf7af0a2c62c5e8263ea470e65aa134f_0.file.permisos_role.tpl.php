<?php
/* Smarty version 3.1.33, created on 2019-03-23 01:16:17
  from '/home/vagrant/code/SagrarioBautizos/public/views/acl/permisos_role.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c9588e1f3ec69_90632243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5bf15fd4cf7af0a2c62c5e8263ea470e65aa134f' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/acl/permisos_role.tpl',
      1 => 1553303770,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c9588e1f3ec69_90632243 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Administración de permisos role</h2>

<h3>Role: <?php echo $_smarty_tpl->tpl_vars['role']->value['role'];?>
</h3>

<p>Permisos</p>

<form name='form1' method='post' action=''>
	<input type="hidden" name="guardar" value ='1'/>

	<?php if (isset($_smarty_tpl->tpl_vars['permisos']->value) && count($_smarty_tpl->tpl_vars['permisos']->value)) {?>
		<table>
			<tr>
				<th>Permiso</th>
				<th>Habilitado</th>
				<th>Denegado</th>
				<th>Ignorar</th>
			</tr>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['permisos']->value, 'pr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->value) {
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['pr']->value['nombre'];?>
</td>
					<td>
					<input type="radio" name="perm_<?php echo $_smarty_tpl->tpl_vars['pr']->value['id'];?>
" value="1" <?php if (($_smarty_tpl->tpl_vars['pr']->value['valor'] == 1)) {?>checked='checked'<?php }?>/></td>
					<td><input type="radio" name='perm_<?php echo $_smarty_tpl->tpl_vars['pr']->value['id'];?>
' value="" <?php if (($_smarty_tpl->tpl_vars['pr']->value['valor'] == '')) {?>checked='checked'<?php }?>/></td>
					<td><input type="radio" name='perm_<?php echo $_smarty_tpl->tpl_vars['pr']->value['id'];?>
' value="x" <?php if (($_smarty_tpl->tpl_vars['pr']->value['valor'] === 'x')) {?>checked='checked'<?php }?>/>
					</td>
				</tr>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</table>
	<?php }?>
	<p><input type="submit" value="Guardar"></p>

</form>
<p><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/roles" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>
<?php }
}
