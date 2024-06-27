# Proyecto Página de Aerolíneas

## Índice

### Controladores

1. [Controlador de Aeronaves](#controlador-de-aeronaves)
    - [Función `mostrarTablaDeAviones()`](#función-mostrartabladeaviones)
    - [Función `listarPorPrecio()`](#función-listarporprecio)
    - [Función `filtrarPorPrecioMayorElegido()`](#función-filtrarporpreciomayorelegido)
    - [Función `eliminarAeronave()`](#función-eliminaraeronave)
    - [Función `insertarAeronave()`](#función-insertaraeronave)
2. [Controlador de Vuelos](#controlador-de-vuelos)
    - [Función `mostrarTablaDeVuelos()`](#función-mostrartabladevuelos)
    - [Función `insertarVuelo()`](#función-insertarvuelo)
    - [Función `editarTablaDeVuelos()`](#función-editartabladevuelos)
3. [Controlador de Login](#controlador-de-login)
    - [Función `verificarLogin()`](#función-verificarlogin)

## Descripción de las Funciones

### Controlador de Aeronaves

#### Función `mostrarTablaDeAviones()`

## Descripción

La función `Mostrar_tabla_de_aviones` en nuestra API obtiene los datos de una tabla de aeronaves y los devuelve en formato JSON. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos

- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP

La función `Mostrar_tabla_de_aviones` se encuentra en la ruta `/aviones` y utiliza el método `GET`.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `GET` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/aviones`.

4. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un objeto JSON con los datos de la tabla de aeronaves. Ejemplo:

  ```json
  {
      "status": 200,
      "data": [
          {
              "id": 1,
              "modelo": "Boeing 737",
              "año": 2015
          },
          {
              "id": 2,
              "modelo": "Airbus A320",
              "año": 2018
          }
        
      ]
  }

  ```

- **No encontrado (404):** Si no hay datos en la base de datos, recibirás un mensaje como:

```json
{
    "status": 404,
    "message": "No hay tareas en la base de datos"
}

```

- **Error del servidor (500):** Si hay un problema en el servidor, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: mensaje_de_error"
}
```

## Código de la Función en PHP

- Para referencia, aquí está el código de la función       Mostrar_tabla_de_aviones:

```php
function Mostrar_tabla_de_aviones() { 
    $user = $this->authHelper->currentUser(); 
    if ($user) { 
        try {
            $Aeronave = $this->model->datos_de_tabla_de_Aeronave();
            if ($Aeronave) {
                $response = [
                    "status": 200,
                    "data" => $Aeronave
                ];
                return $this->view->response($response, 200);
            } else {
                return $this->view->response("No hay tareas en la base de datos", 404);
            }
        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
}

```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.
- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.
- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

- Este README proporciona una guía clara y detallada sobre cómo configurar y usar Postman para interactuar con la función `Mostrar_tabla_de_aviones` en tu API.

#### Función `listarPorPrecio()`

## Descripción
La función `Listar_por_precio` en nuestra API obtiene una lista de aeronaves ordenadas por precio de manera ascendente o descendente, según el parámetro proporcionado. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos
- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP
La función `Listar_por_precio` se encuentra en la ruta `/aviones/precio/:Posicióndelatabla` y utiliza el método `GET`. El parámetro `:Posicióndelatabla` puede ser `ascendente` o `descendente`.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `GET` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/aviones/precio/ascendente` o `http://tuservidor.com/api/aviones/precio/descendente`.

4. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un objeto JSON con la lista de aeronaves ordenadas por precio. Ejemplo:

  ```json
  {
      "status": 200,
      "data": [
          {
              "id": 1,
              "modelo": "Boeing 737",
              "precio": 80000000
          },
          {
              "id": 2,
              "modelo": "Airbus A320",
              "precio": 75000000
          }
      
      ]
  }
  ```

  - **No encontrado (404):** Si no hay datos en la base de datos, recibirás un mensaje como:

 ```json
{
    "status": 404,
    "message": "No hay tareas en la base de datos"
}
 ```

- **Error de parámetro inválido (500):** Si proporcionas un parámetro inválido, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de parámetro inválido"
}

```

- **Error del servidor (500):** Si hay un problema en el servidor, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: mensaje_de_error"
}
```

## Código de la Función en PHP

Para referencia, aquí está el código de la función Listar_por_precio:

```php
function Listar_por_precio($params = null) {
    $user = $this->authHelper->currentUser(); 
    if ($user) {
   
        if (!isset($params[':Posicióndelatabla'])) {
            return $this->view->response("Parámetro no proporcionado", 500);
        }

        $CondiciónDeLaLista = $params[':Posicióndelatabla'];

        try {
            
            $handleResponse = function($data) {
                if ($data) {
                    return $this->view->response([
                        "status" => 200,
                        "data" => $data
                    ], 200);
                } else {
                    return $this->view->response("No hay tareas en la base de datos", 404);
                }
            };

            switch (strtolower($CondiciónDeLaLista)) {
                case 'ascendente':
                    $Aeronave = $this->model->Lista_de_precio_de_manera_ascendente();
                    return $handleResponse($Aeronave);

                case 'descendente':
                    $Aeronave = $this->model->Lista_de_precio_de_manera_descendente();
                    return $handleResponse($Aeronave);

                default:
                    return $this->view->response("Error de parámetro inválido", 500);
            }

        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
}
```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.

- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.

- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

#### Función `filtrarPorPrecioMayorElegido()`

## Descripción

La función `Filtrar_por_el_precio_mayor_elegido` en nuestra API obtiene una lista de aeronaves cuyo precio es mayor o igual al precio especificado. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos

- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP

La función `Filtrar_por_el_precio_mayor_elegido` se encuentra en la ruta `/aviones/filtrar/:precio` y utiliza el método `GET`. El parámetro `:precio` debe ser un valor numérico que representa el precio mínimo para filtrar las aeronaves.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `GET` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/aviones/filtrar/1000000` (reemplazando `1000000` con el valor del precio deseado).

4. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un objeto JSON con la lista de aeronaves filtradas por el precio especificado. Ejemplo:

  ```json
  {
      "status": 200,
      "data": [
          {
              "id": 1,
              "modelo": "Boeing 737",
              "precio": 80000000
          },
          {
              "id": 2,
              "modelo": "Airbus A320",
              "precio": 75000000
          }
      ]
  }
  ```

- **No encontrado (404):** Si no hay datos en la base de datos que cumplan con el criterio, recibirás un mensaje como:

```json
{
    "status": 404,
    "message": "No hay aeronaves en la base de datos"
}
```

- **Parámetro faltante o inválido (400):** Si el parámetro precio no es proporcionado o es inválido, recibirás un mensaje de error:

```json
{
    "status": 400,
    "message": "El parámetro 'precio' es requerido"
}

```

- **Error del servidor (500):** Si hay un problema en el servidor, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: mensaje_de_error"
}

```

## Código de la Función en PHP

- Para referencia, aquí está el código de la función Filtrar_por_el_precio_mayor_elegido:

```php
public function Filtrar_por_el_precio_mayor_elegido($params = null) {
    $user = $this->authHelper->currentUser(); 
    if ($user) {
        $precio = $params[':precio'];
        
        if (is_null($precio) || $precio === '') {
            return $this->view->response("El parámetro 'precio' es requerido", 400);
        }

        try {
            $Aeronave = $this->model->Filtrarporelpreciomayorelegido($precio);
            if ($Aeronave) {
                $response = [
                    "status" => 200,
                    "data" => $Aeronave
                ];
                return $this->view->response($response, 200);
            } else {
                return $this->view->response("No hay aeronaves en la base de datos", 404);
            }
        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
}

```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.
- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.
- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

#### Función `eliminarAeronave()`

## Descripción

La función `eliminarAeronave` en nuestra API elimina una aeronave específica de la base de datos. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos

- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP

La función `eliminarAeronave` se encuentra en la ruta `/aviones/:ID` y utiliza el método `DELETE`. El parámetro `:ID` es el identificador de la aeronave que deseas eliminar.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `DELETE` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/aviones/1` (reemplazando `1` con el ID de la aeronave que deseas eliminar).

4. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un mensaje de confirmación indicando que la aeronave ha sido eliminada. Ejemplo:

  ```json
  {
      "status": 200,
      "message": "Aeronave 1, eliminada"
  }
  ```

- **No encontrado (404):** Si la aeronave no se encuentra en la base de datos, recibirás un mensaje como:

```json
{
    "status": 404,
    "message": "Aeronave 1, no encontrada"
}
```

- **Error del servidor (500):** Si hay un problema en el servidor, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: mensaje_de_error"
}
```

### Código de la Función en PHP

- Para referencia, aquí está el código de la función eliminarAeronave:

```php
function eliminarAeronave($params = null) {
    $id = $params[':ID'];
    $user = $this->authHelper->currentUser(); 
    if ($user) {
        try {
            $Aeronave = $this->model->datos_de_tabla_de_Aeronave($id);
            if ($Aeronave) {
                $this->model->eliminarAeronave($id);
                return $this->view->response("Aeronave $id, eliminada", 200);
            } else {
                return $this->view->response("Aeronave $id, no encontrada", 404);
            }
        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
}

```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.
- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.
- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

#### Función `insertarAeronave()`


## Descripción
La función `insert_Aeronave` en nuestra API inserta una nueva entrada de aeronave en la base de datos con los datos proporcionados. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos
- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP
La función `insert_Aeronave` se activa al enviar una solicitud `POST` a la ruta `/aviones/insertar`. No requiere parámetros en la URL, ya que los datos se envían en el cuerpo de la solicitud.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `POST` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/aviones/insertar`.

4. **Cuerpo (Body)**
   - Selecciona la pestaña "Body".
   - Selecciona `raw` y luego el tipo de datos `JSON (application/json)`.
   - En el cuerpo de la solicitud, proporciona los datos de la nueva aeronave en formato JSON. Por ejemplo:

     ```json
     {
         "Aeronave": "Boeing 737",
         "Precio": 80000000,
         "Fecha": "2024-06-27"
     }
     ```

   - Asegúrate de incluir todos los campos requeridos (`Aeronave`, `Precio`, `Fecha`).

5. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

6. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un mensaje indicando que la aeronave se ha insertado correctamente junto con el ID generado para la nueva entrada. Ejemplo:

  ```json
  {
      "status": 200,
      "message": "Se insertó correctamente con id: 1"
  }
  ```

- **Error de datos faltantes (400):** Si no se proporcionaron todos los datos requeridos en el cuerpo de la solicitud, recibirás un mensaje como:

 ```json
{
    "status": 400,
    "message": "Faltan datos requeridos."
}
```

- **Error del servidor (500):** Si hay un problema en el servidor al intentar insertar la aeronave, recibirás un mensaje de error:

 ```json
 {
    "status": 500,
    "message": "Error al insertar los datos."
}
```

## Código de la Función en PHP

- Para referencia, aquí está el código de la función insert_Aeronave en PHP:

 ```php
public function insert_Aeronave() {
    $user = $this->authHelper->currentUser(); 
    if ($user) {
       
        $tareaAeronave = $this->getData();

    
        if (!isset($tareaAeronave->Aeronave) || !isset($tareaAeronave->Precio) || !isset($tareaAeronave->Fecha)) {
            return $this->view->response("Faltan datos requeridos.", 400);
        }

        $Aeronave = htmlspecialchars($tareaAeronave->Aeronave);
        $Precio = htmlspecialchars($tareaAeronave->Precio);
        $Fecha = htmlspecialchars($tareaAeronave->Fecha);

      
        $lastId = $this->model->insert_Aeronave($Aeronave, $Precio, $Fecha);

    
        if ($lastId === false) {
            return $this->view->response("Error al insertar los datos.", 500);
        }

        return $this->view->response("Se insertó correctamente con id: $lastId", 200);
    }
}
```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.
- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.
- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

### Controlador de Vuelos


#### Función `mostrarTablaDeVuelos()`

## Descripción
La función `mostrarTablaDeVuelos` en nuestra API obtiene los datos de vuelos asociados a un ID específico desde la base de datos. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos
- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP
La función `mostrarTablaDeVuelos` se activa al enviar una solicitud `GET` a la ruta `/vuelos/:ID`. El parámetro `:ID` debe ser reemplazado con el ID específico de los vuelos que deseas consultar.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `GET` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/vuelos/1` (reemplazando `1` con el ID real de los vuelos que deseas consultar).

4. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un objeto JSON con los datos de los vuelos asociados al ID especificado. Ejemplo:

  ```json
  {
      "status": 200,
      "data": [
          {
              "id": 1,
              "origen": "Ciudad A",
              "destino": "Ciudad B",
              "fecha_salida": "2024-06-27 08:00:00",
              "fecha_llegada": "2024-06-27 10:00:00"
          },
          {
              "id": 2,
              "origen": "Ciudad C",
              "destino": "Ciudad D",
              "fecha_salida": "2024-06-27 12:00:00",
              "fecha_llegada": "2024-06-27 14:00:00"
          }
    
      ]
  }
  ```


- **No encontrado (404):** Si no hay vuelos asociados al ID proporcionado, recibirás un mensaje como:

 ```json
  {
    "status": 404,
    "message": "No hay vuelos en la base de datos"
}
```

- **Parámetros inválidos (400):** Si el parámetro :ID no está presente en la solicitud, recibirás un mensaje de error:

```json
{
    "status": 400,
    "message": "Parámetros inválidos"
}
```

- **Error del servidor (500):** Si hay un problema en el servidor al intentar obtener los datos de vuelos, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor"
}
```

## Código de la Función en PHP

- Para referencia, aquí está el código de la función mostrarTablaDeVuelos en PHP:

```php
public function mostrarTablaDeVuelos($params = null) {
    $user = $this->authHelper->currentUser(); 
    if ($user) {
    
        if (!isset($params[':ID'])) {
            return $this->view->response("Parámetros inválidos", 400);
        }

        $id = $params[':ID'];

        try {
    
            $vuelos = $this->modelvuelos->datosDeTablaDeVuelos($id);

            if ($vuelos) {
          
                $response = [
                    "status" => 200,
                    "data" => $vuelos
                ];
                return $this->view->response($response, 200);
            } else {
           
                return $this->view->response("No hay vuelos en la base de datos", 404);
            }
        } catch (Exception $e) {
         
            error_log("Error en mostrarTablaDeVuelos: " . $e->getMessage());

           
            return $this->view->response("Error de servidor", 500);
        }
    }
}

```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.

- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.

- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

#### Función `insertarVuelo()`

## Descripción

La función `insert_vuelo` en nuestra API inserta un nuevo vuelo en la base de datos con los datos proporcionados. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos

- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP
La función `insert_vuelo` se activa al enviar una solicitud `POST` a la ruta `/vuelos/insertar`. No requiere parámetros en la URL, ya que los datos se envían en el cuerpo de la solicitud.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `POST` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/vuelos/insertar`.

4. **Cuerpo (Body)**
   - Selecciona la pestaña "Body".
   - Selecciona `raw` y luego el tipo de datos `JSON (application/json)`.
   - En el cuerpo de la solicitud, proporciona los datos del nuevo vuelo en formato JSON. Por ejemplo:

 ```json
     {
         "Destino": "Ciudad B",
         "Precio": 500,
         "id_aerolinea": 1
     }
 ```

- Asegúrate de incluir todos los campos requeridos (`Destino`, `Precio`, `id_aerolinea`).

5. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

6. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un mensaje indicando que el vuelo se ha insertado correctamente junto con el ID generado para el nuevo vuelo. Ejemplo:

```json
  {
      "status": 200,
      "message": "Se insertó correctamente con id: 1"
  }
```

- **Datos incompletos (400):** Si no se proporcionaron todos los datos requeridos en el cuerpo de la solicitud, recibirás un mensaje como:

```json
{
    "status": 400,
    "message": "Datos incompletos"
}
```

- **Error del servidor (500):** Si hay un problema en el servidor al intentar insertar el vuelo, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error al insertar el vuelo: mensaje_de_error"
}
```

## Código de la Función en PHP

- Para referencia, aquí está el código de la función insert_vuelo en PHP:

```php
public function insert_vuelo() {
    $user = $this->authHelper->currentUser(); 
    if ($user) {
      
        $tareaAeronave = $this->getData();

    
        if (empty($tareaAeronave->Destino) || empty($tareaAeronave->Precio) || empty($tareaAeronave->id_aerolinea)) {
            return $this->view->response("Datos incompletos", 400);
        }

        try {
         
            $lastId = $this->modelvuelos->insert_vuelo(
                $tareaAeronave->Destino,
                $tareaAeronave->Precio,
                $tareaAeronave->id_aerolinea
            );

      
            return $this->view->response("Se insertó correctamente con id: $lastId", 200);
        } catch (Exception $e) {
       
            return $this->view->response("Error al insertar el vuelo: " . $e->getMessage(), 500);
        }
    }
}

```

#### Función `editarTablaDeVuelos()`

## Descripción

La función `Editar_tabla_de_vuelos` en nuestra API obtiene los datos de vuelos y aeronaves asociados a un ID específico desde la base de datos. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos

- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un token de autenticación válido si tu API lo requiere.

## Paso a Paso

### 1. Determinar la Ruta y el Método HTTP

La función `Editar_tabla_de_vuelos` se activa al enviar una solicitud `GET` a la ruta `/editar_vuelos/:ID`. El parámetro `:ID` debe ser reemplazado con el ID específico de los vuelos que deseas editar.

### 2. Configurar la Solicitud en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `GET` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint. Por ejemplo, `http://tuservidor.com/api/editar_vuelos/1` (reemplazando `1` con el ID real de los vuelos que deseas editar).

4. **Encabezados (Headers)**
   - Si tu API requiere autenticación, debes agregar los encabezados necesarios.
   - Por ejemplo, si utilizas un token JWT, agrega un encabezado `Authorization` con el valor `Bearer tu_token`.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Bearer tu_token` (reemplazando `tu_token` con el token real).

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 3. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un objeto JSON con los datos de las aeronaves y los vuelos asociados al ID especificado. Ejemplo:

  ```json
  {
      "status": 200,
      "data": {
          "aeronave": [
              {
                  "id": 1,
                  "modelo": "Modelo X",
                  "capacidad": 200
              },
              {
                  "id": 2,
                  "modelo": "Modelo Y",
                  "capacidad": 180
              }
              // Más datos de aeronaves si hay más de una
          ],
          "vuelos": [
              {
                  "id": 1,
                  "origen": "Ciudad A",
                  "destino": "Ciudad B",
                  "fecha_salida": "2024-06-27 08:00:00",
                  "fecha_llegada": "2024-06-27 10:00:00"
              },
              {
                  "id": 2,
                  "origen": "Ciudad C",
                  "destino": "Ciudad D",
                  "fecha_salida": "2024-06-27 12:00:00",
                  "fecha_llegada": "2024-06-27 14:00:00"
              }
              // Más datos de vuelos si hay más de uno
          ]
      }
  }

  ```

- **No encontrado (404):** Si no se encontraron datos de vuelos o aeronaves asociados al ID proporcionado, recibirás un mensaje como:

```json
{
    "status": 404,
    "message": "Hubo un error en una de las dos bases de datos"
}
```

- **Parámetros inválidos (400):** Si el parámetro :ID no está presente en la solicitud, recibirás un mensaje de error:

```json
{
    "status": 400,
    "message": "Faltan parámetros requeridos"
}
```

- **Error del servidor (500):** Si hay un problema en el servidor al intentar obtener los datos de vuelos y aeronaves, recibirás un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: mensaje_de_error"
}
```

## Código de la Función en PHP

- Para referencia, aquí está el código de la función Editar_tabla_de_vuelos en PHP:

```php
public function Editar_tabla_de_vuelos($params = null) {
    $user = $this->authHelper->currentUser(); 
    if ($user) {
      
        if (!isset($params[':ID'])) {
            return $this->view->response("Faltan parámetros requeridos", 400);
        }

        $id = $params[':ID'];

        try {
      
            $vuelos = $this->modelvuelos->tabla_de_vuelos($id);
            $aeronave = $this->modelAeronave->datos_de_tabla_de_Aeronave();

           
            if ($aeronave && $vuelos) {
                
                $response = [
                    "status" => 200,
                    "data" => [
                        "aeronave" => $aeronave,
                        "vuelos" => $vuelos
                    ]
                ];
                return $this->view->response($response, 200);
            } else {
             
                return $this->view->response("Hubo un error en una de las dos bases de datos", 404);
            }
        } catch (PDOException $e) {
          
            return $this->view->response("Error en la base de datos: " . $e->getMessage(), 500);
        } catch (Exception $e) {
       
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
}
```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo.
- Verifica que la ruta y el método HTTP estén configurados correctamente en tu API.
- Si tienes problemas, revisa los logs del servidor para más detalles sobre posibles errores.

### Controlador de Login

#### Función `verificarLogin()`

## Descripción
La función `login` en nuestra API realiza la autenticación de usuarios utilizando el método de autenticación básica (Basic Auth) y genera un token JWT para autorización en solicitudes subsiguientes. Esta guía te ayudará a configurar y enviar una solicitud HTTP a esta función usando Postman.

## Requisitos Previos

- Tener Postman instalado en tu ordenador.
- Conocer la URL base de tu API.
- Tener acceso a un usuario registrado en tu sistema con su email y contraseña.
- Entender el funcionamiento básico de autenticación básica (Basic Auth) y JWT.

## Paso a Paso

### 1. Configurar la Autenticación Básica en Postman

1. **Abrir Postman**
   - Abre Postman en tu ordenador.

2. **Crear una Nueva Solicitud**
   - Haz clic en el botón "New" y selecciona "Request".

3. **Configurar la Solicitud**
   - **Método HTTP:** Selecciona `POST` en el menú desplegable.
   - **URL:** Introduce la URL completa de tu endpoint de login. Por ejemplo, `http://tuservidor.com/api/login`.

4. **Encabezados (Headers)**
   - Agrega un encabezado `Authorization` con el valor `Basic base64(email:password)`.
     - Sustituye `email` y `password` con el email y contraseña válidos de un usuario registrado en tu sistema.
     - Para codificar en base64, puedes usar herramientas online o funciones de tu lenguaje de programación.

   **Para agregar un encabezado:**
   - Haz clic en la pestaña "Headers".
   - En la primera fila, en la columna "Key", escribe `Authorization`.
   - En la columna "Value", escribe `Basic base64(email:password)`.

5. **Enviar la Solicitud**
   - Haz clic en el botón "Send".

### 2. Interpretar la Respuesta

Dependiendo de la configuración de tu API, recibirás una de las siguientes respuestas:

- **Éxito (200):** Recibirás un objeto JSON con los datos del usuario y el token JWT generado. Ejemplo:

  ```json
  {
      "status": 200,
      "data": {
          "email": "usuario@example.com",
          "role": "admin"
      },
      "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InVzdWFyaW9AZXhhbXBsZS5jb20iLCJyb2xlIjoiYWRtaW4iLCJleHAiOjE2MzYxMjk3NTN9.DD-e2ZgzbTf01G9GAcLxxrJ3x7Am67q5BY0Bq58bQX0"
  }

  ```

- **No autorizado (401):** Si la autenticación falla debido a credenciales incorrectas o falta de encabezados de autenticación:

 ```json

{
    "status": 401,
    "message": "Autenticación incorrecta."
}
```

## Código de la Función en PHP

Para referencia, aquí está el código de la función login() en PHP y AuthHelper:

- Código PHP de la Función login()

 ```php
 public function login() {
    $basic = $this->authHelper->getAuthHeaders();

    if(empty($basic)) {
        $this->view->response('No envió encabezados de autenticación.', 401);
        die();
    }

    $basic = explode(" ", $basic);
    
    if($basic[0]!="Basic") {
        $this->view->response('Autenticación incorrecta.', 401);
        die();
    }
    
    $userpass = base64_decode($basic[1]);
    $userpass = explode(":", $userpass);
    
    $email = $userpass[0];
    $pass = $userpass[1];
    $user = $this->model->usuarios($email);
    
    if($user && password_verify($pass, $user->password)){
        $userdata = [ "email" => $user->email, "role" => $user->rol];
        $token = $this->authHelper->createToken($userdata);
        
        $response = [
            "status" => 200,
            "data" => $userdata,
            "token" => $token
        ];               
        $this->view->response($response, 200);
    } else {
        $response = [
            "status" => 404,
            "message" => "El usuario o contraseña son incorrectos."
        ];
        $this->view->response($response, 404);
    }
}
 ```

- Código PHP de AuthHelper

 ```php
 require_once("config.php");

class AuthHelper {
    
    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function getAuthHeaders() {
        $header = "";
        if(isset($_SERVER['HTTP_AUTHORIZATION']))
            $header = $_SERVER['HTTP_AUTHORIZATION'];
        if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
            $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        return $header;
    }

    function createToken($payload) {
        $header = array(
            'alg' => 'HS256',
            'typ' => 'JWT'
        );
        
        $payload['exp'] = time() + 60; // 1 minuto de expiración para propósitos prácticos
        
        $header = $this->base64url_encode(json_encode($header));
        $payload = $this->base64url_encode(json_encode($payload));
        
        $signature = hash_hmac('SHA256', "$header.$payload", true);
        $signature = $this->base64url_encode($signature);
        
        $token = "$header.$payload.$signature";

        return $token;
    }

    function currentUser() {
        $auth = $this->getAuthHeaders();
        $auth = explode(" ", $auth);
        
        if($auth[0] != "Bearer")
            return false;

        return $this->verifyToken($auth[1]);
    }

    private function verifyToken($token) {
        $token = explode(".", $token);
        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];

        $new_signature = hash_hmac('SHA256', "$header.$payload", true);
        $new_signature = $this->base64url_encode($new_signature);

        if($signature != $new_signature) 
            return false;
    
        $payload = json_decode(base64_decode($payload));

        if($payload->exp < time()) 
            return false;
    
        return $payload;
    }
}
 ```

## Notas Adicionales

- Asegúrate de que tu servidor esté corriendo y que los archivos config.php y AuthHelper estén correctamente incluidos.

- Verifica que la autenticación básica y la generación de token JWT funcionen según lo esperado en tu entorno de desarrollo.

- Si encuentras problemas, revisa los logs del servidor para más detalles sobre posibles errores.
