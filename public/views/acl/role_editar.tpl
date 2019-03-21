{$titulo}
<form id="form1" method="post" action="">
    <input type="hidden" name="guardar" value="1" />
    <p>Role:<br />
    <input type="texto" name="role" value="{$roles.role|default:''}" /></p>
    
    <p><input type="submit" class="button" value="Guardar" /></p>
</form>
<p><a href="{$_layoutParams.root}acl/roles" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Retornar</a></p>
