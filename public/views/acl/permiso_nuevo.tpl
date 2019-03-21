<form id="form1" method="post" action="{$_layoutParams.root}acl/nuevo_permiso" 
     enctype='multipart/form-data'>
    <input type="hidden" name="guardar" value="1" />
    <p>Permiso:<br />
    <input type="texto" name="permiso" value="{$datos.permiso|default:''}"/></p>   

    <p>Llave:<br />
    <input type="texto" name="llave" value="{$datos.llave|default:''}"/></p> 
      
    <p><input type="submit" class="button" value="Guardar" /></p>
</form>
<p><a href="{$_layoutParams.root}acl/permisos" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>
