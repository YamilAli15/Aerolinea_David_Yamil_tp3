{include 'NavigationBar.tpl'}
<div id="ImágenesError">
    <img src='Imágenes/download.jpg' class="d-block w-40" alt='ERROR'>
</div>
{if $msj}
    <div class='alert alert-warning'>
        {$msj}
    </div>
{/if}
{include 'htmlEnd.tpl'}