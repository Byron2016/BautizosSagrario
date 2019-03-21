{if isset($mensaje)}
    <h2>{$mensaje}</h2>
{/if}
<p>&nbsp;</p>

<a href="{$_layoutParams.root}">Ir al Inicio</a> | 
<a href="javascript:history.back(1)">Volver a la p&aacute;gina anterior</a>

{if !Session::get('autenticado')}

|
	<a href="{$_layoutParams.root}login">Iniciar Ses&iacute;on</a>
{/if}