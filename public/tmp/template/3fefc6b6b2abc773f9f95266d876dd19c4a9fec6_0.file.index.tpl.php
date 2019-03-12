<?php
/* Smarty version 3.1.33, created on 2019-03-12 20:56:24
  from '/home/vagrant/code/SagrarioBautizos/public/views/post/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c881cf83b1ad4_23296576',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3fefc6b6b2abc773f9f95266d876dd19c4a9fec6' => 
    array (
      0 => '/home/vagrant/code/SagrarioBautizos/public/views/post/index.tpl',
      1 => 1552424106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c881cf83b1ad4_23296576 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Últimos Posts</h2>

<?php if (isset($_smarty_tpl->tpl_vars['posts']->value) && count($_smarty_tpl->tpl_vars['posts']->value)) {?>

<table class="table table-bordered table-condensed table-striped">

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'datos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['datos']->value) {
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['datos']->value['id'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['datos']->value['titulo'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['datos']->value['cuerpo'];?>
</td>
        <td>
        <?php if (isset($_smarty_tpl->tpl_vars['datos']->value['imagen'])) {?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/post/<?php echo $_smarty_tpl->tpl_vars['datos']->value['imagen'];?>
">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/post/thumb/thumb_<?php echo $_smarty_tpl->tpl_vars['datos']->value['imagen'];?>
" />
            </a>
        <?php }?>
        </td>

        <td><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
post/editar/<?php echo $_smarty_tpl->tpl_vars['datos']->value['id'];?>
">Editar</a></td>
        <td><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
post/eliminar/<?php echo $_smarty_tpl->tpl_vars['datos']->value['id'];?>
">Eliminar</a></td>
    </tr> 
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>

<?php } else { ?>

<p><strong>No hay posts!</strong></p>

<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['paginacion']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['paginacion']->value;
}?>


    <p><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
post/nuevo">Agregar Post</a></p>

<?php }
}
