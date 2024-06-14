
        {include 'NavigationBar.tpl'}
        <table class="table table-success table-striped mt-2">
            <thead>
                <tr>
                <th scope="col">Destino</th>
                <th scope="col">Pilotos</th>
                </tr>
            </thead>
            <tbody>
                {if $cantidad == 0}
                    <tr>
                        <td colspan=5>No hay tareas para mostrar</td>
                    </tr>
                {/if}
                {foreach $vuelos as $a}
                    <tr>
                        <td>{$a->Destino}</td>
                        <td>{$a->Pilotos}</td>
                    </tr>
                {/foreach}
                {include 'htmlEnd.tpl'}
