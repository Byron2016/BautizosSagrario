{$titulo}
<form id="form1" method="post" action="">
    <input type="hidden" name="guardar" value="1" />
    <p>Titulo:<br />
    <input type="texto" name="titulo" value="{$posts.titulo|default:''}" /></p>
    
    <p>Cuerpo:<br />
    <textarea name="cuerpo">{$posts.cuerpo|default:''}</textarea></p>
     
    <p><input type="submit" class="button" value="Guardar" /></p>
</form>