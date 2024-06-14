{include 'htmlStart.tpl'}

<nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="home">🗺️Página del inicio🛬</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="Tabla">📚Tabla de vuelos📖</a>
  {if $logeado}    
    <a class="flex-sm-fill text-sm-center nav-link" href="Editar_tabla_de_vuelos">🛠️Editar_tabla_de_vuelos🛠️</a>
    <a class="flex-sm-fill text-sm-center nav-link" href="logout">🔐Cerrar sesión🔑</a>
    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="">{$usuario}</a>
  {else}
    <a class="flex-sm-fill text-sm-center nav-link" aria-current="page" href="login">🔓Iniciar sesión🔑</a>
  {/if}
</nav>