<form class="col-3 m-auto formAddTask" action="insert_vuelos" method="POST">
  <legend class="text-center">Ingrese información a la Tabla </legend>
  <div class="mb-3">
    <label class="form-label">Destino</label>
    <input type="text" name="Destino" class="form-control" placeholder="Ingrese nombre">
  </div>
  <div class="mb-3">
    <label class="form-label">Pilotos</label>
    <input type="text" name="Pilotos" class="form-control" placeholder="Ingrese descripción">
  </div>
  
  <div class="mb-3">
  <label class="form-label">Tiendas a la que pertenece</label>
  <select  name="id_tienda" class="form-select">
  {foreach $Aeronave as $a}
       <option value="{$a->id_aerolinea}">{$a->Aeronave}</option>
     {/foreach}
   </select>
 </div>
  <button type="submit" class="btn btn-primary col-12">Submit</button>
</form>