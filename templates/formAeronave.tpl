<form class="col-3 m-auto formAddTask" action="insert_Aeronave" method="POST">
  <legend class="text-center">Ingrese información a la Tabla </legend>
  <div class="mb-3">
    <label class="form-label">nombre de la Aeronave</label>
    <input type="text" name="Aeronave" class="form-control" placeholder="Ingrese nombre">
  </div>
  <div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="text" name="Precio" class="form-control" placeholder="Ingrese descripción">
  </div>
  <div class="mb-3">
    <label for="fecha">Fecha del vuelo:</label>
    <input type="datetime-local" name="Fecha">
  </div>
  <button type="submit" class="btn btn-primary col-12">Submit</button>
</form>