<?php
/* Smarty version 3.1.33, created on 2019-03-23 00:10:21
  from '/home/vagrant/code/SagrarioBautizos/public/views/acl/role_listar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c95796d99c864_19864726',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2595a71102a594a879cdac419be85a224988ad4b' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/acl/role_listar.tpl',
      1 => 1553191133,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c95796d99c864_19864726 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Administración de roles</h2>
<?php if (isset($_smarty_tpl->tpl_vars['roles']->value) && count($_smarty_tpl->tpl_vars['roles']->value)) {?>
	<table  class="table table-bordered table-condensed table-striped">
		<tr>
			<th>ID</th>
			<th>Role</th>
			<th></th>
			<th></th>
		</tr>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roles']->value, 'rl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rl']->value) {
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['rl']->value['id_role'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['rl']->value['role'];?>
</td>
				<td>
					<a href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/permisos_role/<?php echo $_smarty_tpl->tpl_vars['rl']->value['id_role'];?>
'>Permisos</a>
				</td>
				<td>
					<a href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/editar_role/<?php echo $_smarty_tpl->tpl_vars['rl']->value['id_role'];?>
'>Editar</a>
				</td>
			</tr>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</table>
<?php }?>

<p><a href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/nuevo_role'    class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Agregar Role</a></p>
<p><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/index" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>

<?php }
}
