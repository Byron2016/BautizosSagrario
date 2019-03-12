<?php
/* Smarty version 3.1.33, created on 2019-02-28 20:43:24
  from '/home/vagrant/code/SagrarioBautizos/public/views/ajax/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c7847ec272d43_92145465',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77ade8b59497bb1325656877561530c7652281f3' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/ajax/index.tpl',
      1 => 1551386540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c7847ec272d43_92145465 (Smarty_Internal_Template $_smarty_tpl) {
?><style type="text/css">
    table.table td { vertical-align: middle; }
    table.table td input, select { margin: 0; }
</style>

<h2>Ejemplo de AJAX</h2>

<form>
    <table class="table table-bordered" style="width: 400px;">    
        <tr>
            <td style="text-align: right;">Pais:</td>
            <td>
            <select id="pais">
                <option value=""> -seleccione- </option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paises']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>

                    <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['pais'];?>
</option>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
            </td>
        </tr>

        <tr>
            <td style="text-align: right;">Ciudad: </td>
            <td><select id="ciudad"></select></td>
        </tr>

        <tr>
            <td style="text-align: right; vertical-align: middle;">Ciudad a insertar: </td>
            <td><input type="text" id="ins_ciudad" /></td>
        </tr>
    </table>
    
    <p><button id="btn_insertar" > Insertar</button></p>
</form><?php }
}
