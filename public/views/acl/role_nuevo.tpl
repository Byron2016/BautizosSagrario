<form id="form1" method="post" action="{$_layoutParams.root}acl/nuevo_role" 
     enctype='multipart/form-data'>
    <input type="hidden" name="guardar" value="1" />
    <p>Role:<br />
    <input type="texto" name="role" value="{$datos.titulo|default:''}"/></p>   
      
    <p><input type="submit" class="button" value="Guardar" /></p>
</form>
<p><a href="{$_layoutParams.root}acl/roles" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>

