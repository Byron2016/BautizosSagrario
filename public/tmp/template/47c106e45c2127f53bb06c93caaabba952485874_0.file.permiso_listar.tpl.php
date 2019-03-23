<?php
/* Smarty version 3.1.33, created on 2019-03-22 23:15:15
  from '/home/vagrant/code/SagrarioBautizos/public/views/acl/permiso_listar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c956c8317b861_79261972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47c106e45c2127f53bb06c93caaabba952485874' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/acl/permiso_listar.tpl',
      1 => 1553191399,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c956c8317b861_79261972 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Administración de permisos</h2>

<?php if (isset($_smarty_tpl->tpl_vars['permisos']->value) && count($_smarty_tpl->tpl_vars['permisos']->value)) {?>
<table class="table table-bordered table-condensed table-striped" style="width:500px;">
    <tr>
        <th>ID</th>
        <th>Permiso</th>
        <th>Llave</th>
        <th></th>
    </tr>
    
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['permisos']->value, 'rl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rl']->value) {
?>
    
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['rl']->value['id_permiso'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rl']->value['permiso'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rl']->value['key'];?>
</td>
            <td>
				<a href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/editar_permiso/<?php echo $_smarty_tpl->tpl_vars['rl']->value['id_permiso'];?>
'>Editar</a>
			</td>
        </tr>
        
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    
</table>
<?php }?>

<p><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/nuevo_permiso" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Agregar Permiso</a></p>
<p><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
acl/index" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>

<?php }
}
