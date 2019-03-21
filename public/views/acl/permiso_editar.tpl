{$titulo}
<form id="form1" method="post" action="">
    <input type="hidden" name="guardar" value="1" />
    <p>Permiso:<br />
    <input type="texto" name="permiso" value="{$permiso.permiso|default:''}" /></p>

    <p>Llave:<br />
    <input type="texto" name="key" value="{$permiso.key|default:''}" /></p>
    
    
    <p><input type="submit" class="button" value="Guardar" /></p>
</form>
<p><a href="{$_layoutParams.root}acl/permisos" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>
