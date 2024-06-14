{if $Rango}
    {include 'NavigationBar.tpl'}
    {include 'formvuelos.tpl'}
    <table class="table table-success table-striped mt-2">
        <thead>
            <tr>
                <th scope="col">Destino</th>
                <th scope="col">Pilotos</th>
                <th scope="col">Configuración de admin</th>
            </tr>
        </thead>

        {if $cantidad == 0}
            <tr>
                <td colspan=5>No hay tareas para mostrar</td>
            </tr>
        {/if}
        {foreach $vuelos as $a}
            <tr>
                <td>{$a->Destino}</td>
                <td>{$a->Pilotos}</td>
                <td>
                    <a href='Eliminarvuelos/{$a->ID_Vuelos}' class='btn btn-danger'>Eliminar🧹</a>
                <td>

            </tr>
            {include 'htmlEnd.tpl'}
        {/foreach}
{/if}