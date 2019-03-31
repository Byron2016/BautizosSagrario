<h6>Prueba ajax view - post - prueba.tpl</h6>
{* //V20 - V21 view - post - prueba.tpl*}
<div class="well well-small"> {* //V21*}
    <form id="form1" class="form-inline">
        Nombre: <input type="text" name="nombre" id="nombre">
        <button type="button" id="btnEnviar" class="btn"><i class="icon-search"></i></button>
        <br><br>

        <select id="pais">
            <option value=""> - Seleccione un país - </option>
            {foreach from=$paises item=ps}

                <option value="{$ps.id}">{$ps.pais}</option>

            {/foreach}
        </select>
        <select id="ciudad">
            <option value=""> - Seleccione ciudad - </option>
        </select>
    </form>
</div>

<div id="lista_registros">
    {if isset($posts) && count($posts)}
        <table class="table table-bordered table-condensed table-striped">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Pais</th>
                <th>Ciudad</th>
            </tr>

            {foreach item=datos from=$posts}
                <tr>
                    <td>{$datos.id}</td>
                    <td>{$datos.nombre}</td>
                    <td>{$datos.pais}</td>
                    <td>{$datos.ciudad}</td>
                </tr>
            {/foreach}
        </table>
    {else}

        <p><strong>No hay posts!</strong></p>

    {/if}

    {$paginacion|default:""}
</div>
