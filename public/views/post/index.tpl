<h2>Últimos Posts</h2>

{if isset($posts) && count($posts)}

<table class="table table-bordered table-condensed table-striped">

    {foreach  item=datos from=$posts}
    <tr>
        <td>{$datos.id}</td>
        <td>{$datos.titulo}</td>
        <td>{$datos.cuerpo}</td>
        <td>
        {if isset($datos.imagen)}
        <a href="{$_layoutParams.root}public/img/post/{$datos.imagen}">
            <img src="{$_layoutParams.root}public/img/post/thumb/thumb_{$datos.imagen}" />
            </a>
        {/if}
        </td>

        <td> 
            {if $_acl->permiso('editar_post')}
                <a href="{$_layoutParams.root}post/editar/{$datos.id}">Editar</a>
            {else}
                <a href="{$_layoutParams.root}post/editar/{$datos.id}" class="disabled">Editar</a>
            {/if}
        </td>

        <td> 
            {if $_acl->permiso('eliminar_post')}
                <a href="{$_layoutParams.root}post/eliminar/{$datos.id}">eliminar</a>
            {else}
                <a href="{$_layoutParams.root}post/eliminar/{$datos.id}" class="disabled">eliminar</a>
            {/if}
        </td>
    </tr> 
    {/foreach}
</table>

{else}

<p><strong>No hay posts!</strong></p>

{/if}

{* {if isset($paginacion)} {$paginacion}{/if} *}

{$paginacion|default:""}

{* {if Session::accesoViewEstricto(array('usuario'))} *}

{* <p><a href="{$_layoutParams.root}post/nuevo">Agregar Post</a></p>  *}

{if $_acl->permiso('nuevo_post')}
    <p><a href="{$_layoutParams.root}post/nuevo">Agregar Post</a></p>
{/if}

{* {/if} *}