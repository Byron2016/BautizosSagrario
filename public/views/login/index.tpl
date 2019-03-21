{* {//V15} *}
<h2>Iniciar Sesi&oacute;n</h2>

<form id="form1" method="post" action="">
    <input type="hidden" value="1" name="enviar" />
    
    <p>
        <label>Usuario: </label>
        <input type="text" name="usuario" value="{if isset($datos)} {$datos.usuario} {/if}"/>
    </p>
    
    <p>
        <label>Password: </label>
        <input type="password" name="pass" />
    </p>
    
    <p>
        <input type="submit" class="button" value="enviar" />
    </p>