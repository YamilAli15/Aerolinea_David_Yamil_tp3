{if $Rango}
    {include 'NavigationBar.tpl'}
    {include 'formAeronave.tpl'}
    <table class="table table-success table-striped mt-2">
        <thead>
            <tr>
                <th scope="col">Aeronave🛬</th>
                <th scope="col">Precio</th>
                <th scope="col">Fecha🕓</th>
                <th scope="col">más datos sobre el vuelo📖</th>
                <th scope="col">Configuración de admin</th>
            </tr>
        </thead>
        <tbody>
            {if $cantidad == 0}
                <tr>
                    <td colspan=5>No hay tareas para mostrar</td>
                </tr>
            {/if}
            {foreach $Aeronave as $a}
                <tr>
                    <td>{$a->Aeronave}</td>
                    <td>{$a->Precio}</td>
                    <td>{$a->Fecha}</td>

                    <td> <a href='Verdatos/{$a->ID}' class='btn btn-primary'>Ver📖</a></td>


                    <td>
                        <a href='EliminarAeronave/{$a->ID}' class='btn btn-danger'>Eliminar🧹</a>
                    <td>

                </tr>
                {include 'htmlEnd.tpl'}
            {/foreach}
        {else}
            {include 'NavigationBar.tpl'}
            <table class="table table-success table-striped mt-2">
                <thead>
                    <tr>
                        <th scope="col">Aeronave🛬</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Fecha🕓</th>
                        <th scope="col">más datos sobre el vuelo📖</th>
                    </tr>
                </thead>
                <tbody>
                    {if $cantidad == 0}
                        <tr>
                            <td colspan=5>No hay tareas para mostrar</td>
                        </tr>
                    {/if}
                    {foreach $Aeronave as $a}
                        <tr>
                            <td>{$a->Aeronave}</td>
                            <td>{$a->Precio}</td>
                            <td>{$a->Fecha}</td>
                            <td> <a href='Verdatos/{$a->ID}' class='btn btn-primary'>Ver📖</a></td>
                        </tr>
                    {/foreach}
                    {include 'htmlEnd.tpl'}
{/if}