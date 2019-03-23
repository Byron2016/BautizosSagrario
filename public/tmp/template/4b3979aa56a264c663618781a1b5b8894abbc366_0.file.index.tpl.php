<?php
/* Smarty version 3.1.33, created on 2019-03-22 22:38:55
  from '/home/vagrant/code/SagrarioBautizos/public/views/usuarios/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c9563ffd2a864_95597323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b3979aa56a264c663618781a1b5b8894abbc366' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/usuarios/index.tpl',
      1 => 1553294331,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c9563ffd2a864_95597323 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Usuarios</h2>
<?php if (isset($_smarty_tpl->tpl_vars['usuarios']->value) && count($_smarty_tpl->tpl_vars['usuarios']->value)) {?>
	<table  class="table table-bordered table-condensed table-striped">
		<tr>
			<th>ID</th>
            <th>Usuario</th>
			<th>Role</th>
			<th></th>
		</tr>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'us');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['us']->value) {
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['us']->value['id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['us']->value['usuario'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['us']->value['role'];?>
</td>
                <td>
					<a href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuarios/permisos/<?php echo $_smarty_tpl->tpl_vars['us']->value['id'];?>
'>Permisos</a>
				</td>
			</tr>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</table>
<?php }
}
}
