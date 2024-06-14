{include 'htmlStart.tpl'}
<form class="col-3 m-auto formAddTask" action="Verify_login" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
    <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="Password">
  </div>
  {if $msj}
    <div class='alert alert-warning'>
      {$msj}
    </div>
  {/if}

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
{include 'htmlEnd.tpl'}