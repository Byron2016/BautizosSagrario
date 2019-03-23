<?php
/* Smarty version 3.1.33, created on 2019-03-23 01:21:57
  from '/home/vagrant/code/SagrarioBautizos/public/views/usuarios/permisos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c958a354bfcb9_46138868',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7892b067b3ca9ae6ce23363d605cfb9aaa129dc' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/usuarios/permisos.tpl',
      1 => 1553304106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c958a354bfcb9_46138868 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h2>Permisos de Usuario</h2>

<h3>Usuario: <?php echo $_smarty_tpl->tpl_vars['info']->value['usuario'];?>
<br />Role: <?php echo $_smarty_tpl->tpl_vars['info']->value['role'];?>
</h3>

<form name="form1" method="post" action="">
    <input type="hidden" name="guardar" value="1" />

    <?php if (isset($_smarty_tpl->tpl_vars['permisos']->value) && count($_smarty_tpl->tpl_vars['permisos']->value)) {?>
        <table class="table table-bordered table-condensed table-striped">
            <tr>
                <th>Permiso</th>
                <th></th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['permisos']->value, 'pr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->tpl_vars['pr']->value]['valor'] == 1) {?>
                    <?php $_smarty_tpl->_assignInScope('v', "habilitado");?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('v', "denegado");?>
                <?php }?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['permiso'];?>
</td>
                    <td>
                        <select name='perm_<?php echo $_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['id'];?>
'>
                            <option value='x' <?php if ($_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['heredado']) {?> selected='selected' <?php }?>>Heredado(<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
)</option>
                            <option value='1' <?php if (($_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['valor'] == 1 && $_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['heredado'] == '')) {?> selected='selected' <?php }?>>Habilitado</option>
                            <option value='' <?php if (($_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['valor'] == '' && $_smarty_tpl->tpl_vars['usuario']->value[$_smarty_tpl->tpl_vars['pr']->value]['heredado'] == '')) {?> selected='selected' <?php }?>>Denegado</option>
                        </select>
                    </td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>

        <p><input type="submit" class="button" value="Guardar" /></p>
    <?php }?>
</form>

        

<p><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuarios" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>
<?php }
}
