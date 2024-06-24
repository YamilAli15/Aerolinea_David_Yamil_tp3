# Proyecto Página de aerolíneas

## Índice

### Los controladores

1. [Controlador Aeronave](#controlador-aeronave)
    - [Función `Mostrar_tabla_de_aviones()`](#función-mostrar_tabla_de_aviones)
    - [Función `Listar_por_precio()`](#función-listar_por_precio)
    - [Función `Filtrar_por_el_precio_mayor_elegido()`](#función-filtrar_por_el_precio_mayor_elegido)
    - [Función `eliminarAeronave()`](#función-eliminaraeronave)
    - [Función `insert_Aeronave()`](#función-insert_aeronave)
2. [Controlador Vuelos](#controlador-vuelos)
    - [Función `mostrarTablaDeVuelos()`](#función-mostrartabladevuelos)
    - [Función `insert_vuelo()`](#función-insert_vuelo)
    - [Función `Editar_tabla_de_vuelos()`](#función-editar_tabla_de_vuelos)
3. [Controlador Login](#controlador-login)
    - [Función `logout()`](#función-logout)
    - [Función `verify_login()`](#función-verify_login)

### Modelos de consulta de la base de datos

### Cómo se utiliza en Postman

## Controlador Aeronave

### Introducción

Este controlador PHP, Controlador_Aeronave, gestiona las operaciones relacionadas con aeronaves en una aplicación. Utiliza un modelo (Aeronavemodel) para interactuar con la base de datos y una vista (JSONView) para devolver respuestas en formato JSON. Aquí están sus funciones principales:

### Función `Mostrar_tabla_de_aviones()`

1. Inicio del bloque try:

```php

try {

```

- Se intenta ejecutar el código dentro del bloque try. Si ocurre un error, se capturará en el bloque catch.

2. Obtención de datos de aviones:

```php
$Aeronave = $this->model->datos_de_tabla_de_Aeronave();

```

- Se llama al método datos_de_tabla_de_Aeronave del modelo ($this->model) para obtener los datos de la tabla de aviones desde la base de datos. Los datos recuperados se almacenan en la variable $Aeronave.

3. Verificación de la existencia de datos:

```php
if ($Aeronave) {
```

- Se verifica si la variable $Aeronave contiene datos. Si es verdadera (es decir, no es null o false), significa que los datos fueron recuperados con éxito.

4. Preparación de la respuesta con datos:

```php
$response = [
    "status" => 200,
    "data" => $Aeronave
];
return $this->view->response($response, 200);
```

- Se prepara un arreglo asociativo $response con dos claves: status (con el valor 200 indicando éxito) y data (con los datos de aviones recuperados).

- Se llama al método response de la vista ($this->view) para devolver la respuesta en formato JSON con el código de estado HTTP 200 (OK).

5. Manejo del caso cuando no hay datos:

```php
} else {
    return $this->view->response("No hay tareas en la base de datos", 404);
}

```

- Si no se recuperaron datos (es decir, $Aeronave es null o false), se devuelve una respuesta con un mensaje de error "No hay tareas en la base de datos" y un código de estado HTTP 404 (Not Found).

6. Captura y manejo de excepciones

```php
} catch (Exception $e) {
    return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
}
```

- Si ocurre una excepción durante la ejecución del código en el bloque try, se captura la excepción en el bloque catch.

-Se devuelve una respuesta con un mensaje de error "Error de servidor: " seguido del mensaje de la excepción ($e->getMessage()), y un código de estado HTTP 500 (Internal Server Error).

## La función completa queda así

```php
function Mostrar_tabla_de_aviones() { 
    try {
        $Aeronave = $this->model->datos_de_tabla_de_Aeronave();
        if ($Aeronave) {
            $response = [
                "status" => 200,
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

```

- En resumen, esta función intenta recuperar los datos de aviones de la base de datos y devuelve una respuesta JSON con un código de estado HTTP adecuado, manejando tanto los casos exitosos como los errores de forma adecuada.

### Función `Listar_por_precio()`

1. Validar que el parámetro está presente:

```php
if (!isset($params[':Posicióndelatabla'])) {
    return $this->view->response("Parámetro no proporcionado", 500);
}
```

- La función verifica si el parámetro ':Posicióndelatabla' está presente en $params. Si no está presente, devuelve una respuesta de error con un mensaje "Parámetro no proporcionado" y un código de estado HTTP 500 (Internal Server Error).

2. Asignar el valor del parámetro a una variable:

```php
$CondiciónDeLaLista = $params[':Posicióndelatabla'];
```

- El valor del parámetro ':Posicióndelatabla' se asigna a la variable $CondiciónDeLaLista para su uso posterior en la lógica de la función.

3. Inicio del bloque try para manejar excepciones:

```php
try {
```

- Se intenta ejecutar el código dentro del bloque try. Si ocurre un error, será capturado en el bloque catch.

4. Definir una función interna para manejar la respuesta:

```php
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

```

- Se define una función interna handleResponse que toma como parámetro $data. Si $data contiene datos, devuelve una respuesta JSON con un código de estado 200 y los datos. Si $data está vacío, devuelve una respuesta con un mensaje "No hay tareas en la base de datos" y un código de estado 404.

5. Evaluar la condición del parámetro para determinar el orden:

```php
switch (strtolower($CondiciónDeLaLista)) {
```

- Se convierte el valor de $CondiciónDeLaLista a minúsculas utilizando strtolower y se evalúa en una estructura switch para determinar el orden de la lista.

6. Los case


- Caso ascendente:

```php
case 'ascendente':
    $Aeronave = $this->model->Lista_de_precio_de_manera_ascendente();
    return $handleResponse($Aeronave);
```

Si $CondiciónDeLaLista es "ascendente", se llama al método Lista_de_precio_de_manera_ascendente del modelo para obtener los datos en orden ascendente y se pasa a la función handleResponse para manejar la respuesta.

- Caso descendente:

```php
case 'descendente':
    $Aeronave = $this->model->Lista_de_precio_de_manera_descendente();
    return $handleResponse($Aeronave);

```

Si $CondiciónDeLaLista es "descendente", se llama al método Lista_de_precio_de_manera_descendente del modelo para obtener los datos en orden descendente y se pasa a la función handleResponse para manejar la respuesta.

- Caso por defecto para parámetros inválidos:

```php
default:
    return $this->view->response("Error de parámetro inválido", 500);

```

Si $CondiciónDeLaLista no es ni "ascendente" ni "descendente", se devuelve una respuesta de error con un mensaje "Error de parámetro inválido" y un código de estado 500.

7. Captura y manejo de excepciones:

```php
} catch (Exception $e) {
    return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
}
```

- Si ocurre una excepción durante la ejecución del código en el bloque try, se captura la excepción y se devuelve una respuesta con un mensaje de error "Error de servidor: " seguido del mensaje de la excepción ($e->getMessage()) y un código de estado 500.

## La función completa queda así

```php
function Listar_por_precio($params = null) {
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

```

- En resumen, esta función valida un parámetro de orden, obtiene una lista de aviones ordenada de acuerdo con el parámetro, y maneja tanto los casos exitosos como los errores, devolviendo una respuesta JSON adecuada.

### Función `Filtrar_por_el_precio_mayor_elegido()`

1. Definición y obtención del parámetro precio:

```php
public function Filtrar_por_el_precio_mayor_elegido($params = null) {
    $precio = $params[':precio'];
```

- La función comienza definiendo y obteniendo el parámetro ':precio' de $params. Este parámetro se asigna a la variable $precio.

2. Validación del parámetro precio:

```php
if (is_null($precio) || $precio === '') {
    return $this->view->response("El parámetro 'precio' es requerido", 400);
}
```

- Se verifica si $precio es null o una cadena vacía. Si alguna de estas condiciones se cumple, devuelve una respuesta con el mensaje "El parámetro 'precio' es requerido" y un código de estado HTTP 400 (Bad Request), indicando que el parámetro es obligatorio.

3. Inicio del bloque try para manejar excepciones:

```php
try {
```

- Se intenta ejecutar el código dentro del bloque try. Si ocurre un error, será capturado en el bloque catch.

4. Llamada al método del modelo para filtrar aviones por precio:

```php
$Aeronave = $this->model->Filtrarporelpreciomayorelegido($precio);
```

- Se llama al método Filtrarporelpreciomayorelegido del modelo ($this->model) pasando el parámetro $precio. Este método se espera que devuelva una lista de aviones cuyo precio es mayor que el precio especificado.

5. Verificación de los datos obtenidos:

```php
if ($Aeronave) {

```

- Se verifica si $Aeronave contiene datos. Si es verdadero (es decir, no es null o false), significa que se encontraron aviones que cumplen con el criterio de filtro.

6. Preparación y devolución de la respuesta con datos:

```php
$response = [
    "status" => 200,
    "data" => $Aeronave
];
return $this->view->response($response, 200);
```

-Se prepara un arreglo asociativo $response con dos claves: status (con el valor 200 indicando éxito) y data (con los datos de aviones filtrados).
Se llama al método response de la vista ($this->view) para devolver la respuesta en formato JSON con el código de estado HTTP 200 (OK).

7. Manejo del caso cuando no hay datos:

```php
} else {
    return $this->view->response("No hay aeronaves en la base de datos", 404);
}
```

- Si $Aeronave no contiene datos (es decir, es null o false), se devuelve una respuesta con un mensaje "No hay aeronaves en la base de datos" y un código de estado HTTP 404 (Not Found).

8. Captura y manejo de excepciones:

```php
} catch (Exception $e) {
    return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
}
```

- Si ocurre una excepción durante la ejecución del código en el bloque try, se captura la excepción y se devuelve una respuesta con un mensaje de error "Error de servidor: " seguido del mensaje de la excepción ($e->getMessage()) y un código de estado HTTP 500 (Internal Server Error).

## La función completa queda así

```php
public function Filtrar_por_el_precio_mayor_elegido($params = null) {
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

```

- En resumen, esta función valida que se haya proporcionado un parámetro precio, intenta obtener una lista de aviones cuyo precio sea mayor que el especificado, y maneja tanto los casos exitosos como los errores, devolviendo una respuesta JSON adecuada.

### Función `eliminarAeronave()`

1. Definición y obtención del parámetro id:

```php
function eliminarAeronave($params=null)
{ 
    $id = $params[':ID'];
```

- La función comienza definiendo y obteniendo el parámetro ':ID' de $params. Este parámetro se asigna a la variable $id.

2. Inicio del bloque try para manejar excepciones:

```php
try {
```

- Se intenta ejecutar el código dentro del bloque try. Si ocurre un error, será capturado en el bloque catch.

3. Llamada al método del modelo para obtener datos de la aeronave:

```php
$Aeronave = $this->model->datos_de_tabla_de_Aeronave($id);
```

-Se llama al método datos_de_tabla_de_Aeronave del modelo ($this->model) pasando el parámetro $id. Este método se espera que devuelva los datos de la aeronave con el ID especificado.

4. Verificación de los datos obtenidos:

```php
if($Aeronave){
```

- Se verifica si $Aeronave contiene datos. Si es verdadero (es decir, no es null o false), significa que la aeronave con el ID especificado fue encontrada.

5. Llamada al método del modelo para eliminar la aeronave:

```php
$Aeronave=$this->model->eliminarAeronave($id);
```

- Se llama al método eliminarAeronave del modelo ($this->model) pasando el parámetro $id. Este método se espera que elimine la aeronave con el ID especificado.

6. Preparación y devolución de la respuesta de éxito:

```php
return $this->view->response("Aeronave $id, eliminada", 200);
```

- Se devuelve una respuesta con el mensaje "Aeronave $id, eliminada" y un código de estado HTTP 200 (OK).

7. Manejo del caso cuando no se encuentra la aeronave:

```php
} else{
    return  $this->view->response("Aeronave $id, no encontrada", 404);
}
```

- Si $Aeronave no contiene datos (es decir, es null o false), se devuelve una respuesta con un mensaje "Aeronave $id, no encontrada" y un código de estado HTTP 404 (Not Found).

8. Captura y manejo de excepciones:

```php
} catch (Exception $e) {
    return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
}
```

- Si ocurre una excepción durante la ejecución del código en el bloque try, se captura la excepción y se devuelve una respuesta con un mensaje de error "Error de servidor: " seguido del mensaje de la excepción ($e->getMessage()) y un código de estado HTTP 500 (Internal Server Error).

## La función completa queda así

```php
function eliminarAeronave($params=null)
{ 
    $id = $params[':ID'];
    try {
        $Aeronave = $this->model->datos_de_tabla_de_Aeronave($id);
        if($Aeronave){
            $Aeronave = $this->model->eliminarAeronave($id);
            return $this->view->response("Aeronave $id, eliminada", 200);
        } else{
            return  $this->view->response("Aeronave $id, no encontrada", 404);
        }
    } catch (Exception $e) {
        return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
    }
}
```

- En resumen, la función intenta eliminar una aeronave de la base de datos si existe y maneja adecuadamente las situaciones donde la aeronave no se encuentra o si ocurre algún error durante el proceso.

### Función `insert_Aeronave()`

1. Obtención de los datos de entrada:

```php
function insert_Aeronave()
{
    $tareaAeronave = $this->getData();
```

- La función comienza obteniendo los datos de entrada llamando al método getData, que probablemente recupera los datos enviados en una solicitud HTTP.

2. Validación de los datos de entrada:

```php
if (!isset($tareaAeronave->Aeronave) || !isset($tareaAeronave->Precio) || !isset($tareaAeronave->Fecha)) {
    return $this->view->response("Faltan datos requeridos.", 400);
}
```

- Se verifica si los campos Aeronave, Precio y Fecha están presentes en los datos de entrada. Si alguno de estos campos falta, se devuelve una respuesta con el mensaje "Faltan datos requeridos." y un código de estado HTTP 400 (Bad Request).



3. Sanitización y escapado de los datos de entrada:

```php
$Aeronave = htmlspecialchars($tareaAeronave->Aeronave);
$Precio = htmlspecialchars($tareaAeronave->Precio);
$Fecha = htmlspecialchars($tareaAeronave->Fecha);
```

- Se sanitizan y escapan los valores de Aeronave, Precio y Fecha utilizando htmlspecialchars para prevenir ataques de inyección y otros problemas de seguridad.

## htmlspecialchars

- htmlspecialchars() es una función en PHP que se utiliza para convertir caracteres especiales en entidades HTML. Esto es útil cuando se quiere mostrar texto en una página web y se quiere asegurar que cualquier código HTML insertado en el texto no sea interpretado como tal, sino que se muestre literalmente. Por ejemplo, convierte caracteres como < y > en &lt; y &gt;, respectivamente, para que el navegador los muestre como texto en lugar de interpretarlos como etiquetas HTML. Esto ayuda a prevenir ataques de inyección de código y mejora la seguridad de la aplicación web

4. Inserción de los datos en la base de datos

```php
$lastId = $this->model->insert_Aeronave($Aeronave, $Precio, $Fecha);
```

- Se llama al método insert_Aeronave del modelo ($this->model) pasando los datos sanitizados. Este método se espera que inserte los datos en la base de datos y devuelva el ID del último registro insertado.

5. Manejo de errores en la inserción:

```php
if ($lastId === false) {
    return $this->view->response("Error al insertar los datos.", 500);
}
```

- Se verifica si la inserción fue exitosa comprobando si $lastId es false. Si es false, se devuelve una respuesta con el mensaje "Error al insertar los datos." y un código de estado HTTP 500 (Internal Server Error).

6. Preparación y devolución de la respuesta de éxito:

```php
return $this->view->response("Se insertó correctamente con id: $lastId", 200);
```

- Si la inserción fue exitosa, se devuelve una respuesta con el mensaje "Se insertó correctamente con id: $lastId" y un código de estado HTTP 200 (OK).

## La función completa queda así:

```php
function insert_Aeronave()
{
 
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
```

- En resumen, la función eliminarAeronave valida un parámetro de ID, intenta eliminar la aeronave correspondiente y maneja tanto los casos exitosos como los errores. La función insert_Aeronave valida los datos de entrada, los sanitiza, intenta insertar una nueva aeronave en la base de datos y maneja tanto los casos exitosos como los errores. Ambas funciones devuelven respuestas JSON adecuadas.


## Controlador Vuelos

El controlador PHP proporciona funcionalidades para gestionar los vuelos de una aplicación. Comienza importando las clases necesarias y define la clase
Controlador_vuelos. En su constructor, inicializa los modelos de vuelos y aeronaves, así como la vista JSON, y obtiene los datos de la solicitud.


### Función `mostrarTablaDeVuelos()`

1. Validación y obtención del ID:

```php
if (!isset($params[':ID'])) {
    return $this->view->response("Parámetros inválidos", 400);
}
$id = $params[':ID'];
```

- La función comienza verificando si el parámetro ':ID' está presente en $params. Si no está presente, devuelve una respuesta con el mensaje "Parámetros inválidos" y un código de estado HTTP 400 (Bad Request).

- Si el parámetro está presente, se asigna su valor a la variable $id.

2. Inicio del bloque try para manejar excepciones:


```php
try {
```

- Se intenta ejecutar el código dentro del bloque try. Si ocurre un error, será capturado en el bloque catch.

3. Obtención de los datos de vuelos desde el modelo:

```php
$vuelos = $this->modelvuelos->datosDeTablaDeVuelos($id);
```

- Se llama al método datosDeTablaDeVuelos del modelo de vuelos ($this->modelvuelos) pasando el ID como parámetro. Se espera que este método devuelva los datos de vuelos asociados con el ID especificado.

4. Verificación de los datos obtenidos:

```php
if ($vuelos) {
```

- Se verifica si $vuelos contiene datos. Si es verdadero (es decir, no es null o false), significa que se encontraron vuelos asociados con el ID especificado.

5. Preparación y devolución de la respuesta con datos de vuelos:

```php
$response = [
    "status" => 200,
    "data" => $vuelos
];
return $this->view->response($response, 200);
```

- Se prepara un arreglo asociativo $response con dos claves: status (con el valor 200 indicando éxito) y data (con los datos de vuelos obtenidos del modelo).

- Se llama al método response de la vista ($this->view) para devolver la respuesta en formato JSON con el código de estado HTTP 200 (OK).

6. Manejo del caso cuando no se encuentran vuelos:

```php
} else {
    return $this->view->response("No hay vuelos en la base de datos", 404);
}
```

- Si $vuelos no contiene datos (es decir, es null o false), se devuelve una respuesta con un mensaje "No hay vuelos en la base de datos" y un código de estado HTTP 404 (Not Found).

7. Captura y manejo de excepciones:

```php
} catch (Exception $e) {

    error_log("Error en mostrarTablaDeVuelos: " . $e->getMessage());


    return $this->view->response("Error de servidor", 500);
}
```

- Si ocurre una excepción durante la ejecución del código en el bloque try, se captura la excepción.

- Se registra el error para propósitos de debugging (esto es opcional y puede variar dependiendo del entorno).

- Se devuelve una respuesta con un mensaje "Error de servidor" y un código de estado HTTP 500 (Internal Server Error).

## La función completa queda así:

```php
function mostrarTablaDeVuelos($params = null)
    {
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
```

-En resumen, la función mostrarTablaDeVuelos valida y obtiene el ID proporcionado como parámetro, obtiene los datos de vuelos asociados con ese ID desde el modelo, y devuelve una respuesta JSON adecuada dependiendo de si se encontraron datos de vuelos o no, manejando también posibles errores.

### Función `insert_vuelo()`

1. Obtención de datos de la solicitud:

 ```php
$tareaAeronave = $this->getData();
```

- Se obtienen los datos de la solicitud llamando al método getData(), que probablemente recupera los datos enviados en una solicitud HTTP.

2. Validación de datos:

 ```php
if (empty($tareaAeronave->Destino) || empty($tareaAeronave->Precio) || empty($tareaAeronave->id_aerolinea)) {
    return $this->view->response("Datos incompletos", 400);
}
```

- Se verifica si los campos Destino, Precio y id_aerolinea están presentes y no son vacíos en los datos de la solicitud. Si algún campo falta o está vacío, se devuelve una respuesta con el mensaje "Datos incompletos" y un código de estado HTTP 400 (Bad Request).

3. Inicio del bloque try para manejar excepciones:

 ```php
 try {
  ```

- Se intenta ejecutar el código dentro del bloque try. Si ocurre un error, será capturado en el bloque catch.

4. Insertar vuelo en la base de datos:

```php 
$lastId = $this->modelvuelos->insert_vuelo(
    $tareaAeronave->Destino,
    $tareaAeronave->Precio,
    $tareaAeronave->id_aerolinea
);
```

- Se llama al método insert_vuelo del modelo de vuelos ($this->modelvuelos) pasando los datos del destino, precio y ID de aerolínea. Este método se espera que inserte los datos del vuelo en la base de datos y devuelva el ID del último registro insertado.

## htmlspecialchars

- htmlspecialchars() es una función en PHP que se utiliza para convertir caracteres especiales en entidades HTML. Esto es útil cuando se quiere mostrar texto en una página web y se quiere asegurar que cualquier código HTML insertado en el texto no sea interpretado como tal, sino que se muestre literalmente. Por ejemplo, convierte caracteres como < y > en &lt; y &gt;, respectivamente, para que el navegador los muestre como texto en lugar de interpretarlos como etiquetas HTML. Esto ayuda a prevenir ataques de inyección de código y mejora la seguridad de la aplicación web

5. Responder con éxito y el ID del nuevo vuelo:

```php
return $this->view->response("Se insertó correctamente con id: $lastId", 200);
```

- Si la inserción fue exitosa, se devuelve una respuesta con el mensaje "Se insertó correctamente con id: $lastId" y un código de estado HTTP 200 (OK).

6. Captura y manejo de excepciones:

```php
} catch (Exception $e) {
    // Manejo de errores
    return $this->view->response("Error al insertar el vuelo: " . $e->getMessage(), 500);
}
```

- Si ocurre una excepción durante la ejecución del código en el bloque try, se captura la excepción.

- Esta función valida los datos de entrada, inserta un nuevo vuelo en la base de datos y maneja tanto los casos de éxito como los errores de manera adecuada.

## La función completa queda así

```php
function insert_vuelo()
{
  
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
```

- Esta función valida los datos de entrada, inserta un nuevo vuelo en la base de datos y maneja tanto los casos de éxito como los errores de manera adecuada.

### Función `Editar_tabla_de_vuelos()`

1. Validación del parámetro ID:

```php
if (!isset($params[':ID'])) {
    return $this->view->response("Faltan parámetros requeridos", 400);
}
```

- La función verifica si el parámetro ':ID' está presente en $params. Si no está presente, devuelve una respuesta con el mensaje "Faltan parámetros requeridos" y un código de estado HTTP 400 (Bad Request).

2. Obtención del ID y ejecución de consultas:

```php
$id = $params[':ID'];
$vuelos = $this->modelvuelos->tabla_de_vuelos($id);
$aeronave = $this->modelAeronave->datos_de_tabla_de_Aeronave();
```

- Se obtiene el ID del parámetro y se ejecutan consultas para obtener los datos de la tabla de vuelos y la tabla de aeronaves.

3. Verificación de resultados:

```php
if ($aeronave && $vuelos) {
```

- Se verifica que ambas consultas hayan devuelto resultados válidos.

4. Preparación de la respuesta exitosa:

```php
$response = [
    "status" => 200,
    "data" => [
        "aeronave" => $aeronave,
        "vuelos" => $vuelos
    ]
];
```

- Se forma un arreglo asociativo $response con dos claves: status (con el valor 200 indicando éxito) y data (con los datos de aeronave y vuelos obtenidos).

5. Respuesta exitosa:

```php
return $this->view->response($response, 200);
```

-Se devuelve una respuesta con el arreglo $response en formato JSON y un código de estado HTTP 200 (OK).

## La función completa queda así

```php
function Editar_tabla_de_vuelos($params = null) {
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
```

- Esta función permite obtener y mostrar los datos de la tabla de vuelos y la tabla de aeronaves relacionados con un ID específico, manejando tanto casos de éxito como de errores de manera adecuada.

## Controlador Login

Este código representa una clase Controlador_login en PHP, que probablemente sea parte de un sistema de autenticación de usuarios en una aplicación web.En general, esta clase se encarga de manejar las funciones relacionadas con el inicio y cierre de sesión de usuarios, así como la verificación de credenciales.

### Función `logout()`

1. Iniciar la sesión:

```php
session_start();
```

-Se llama a la función session_start() para iniciar la sesión. Esto es necesario para acceder a las variables de sesión y destruir la sesión más adelante.

2. Destruir la sesión:

```php 
session_destroy();
```

- Se llama a la función session_destroy() para destruir la sesión actual. Esto elimina todos los datos de sesión asociados con la sesión actual, incluidas las variables de sesión y el ID de sesión.


## La función completa queda así

```php
function logout()
{
    session_start(); 
    session_destroy(); 
}
```

-Esta función se utiliza comúnmente en aplicaciones web para cerrar la sesión de un usuario, lo que implica eliminar toda la información de sesión almacenada y finalizar la sesión actual del usuario.

### Función `verify_login()`

1. Validación de datos de entrada:

```php
if (empty($username) || empty($password)) {
    return $this->view->response("Nombre de usuario y contraseña son requeridos", 400);
}
```

- Se verifica que tanto el nombre de usuario como la contraseña no estén vacíos. Si alguno de ellos está vacío, se devuelve una respuesta con el mensaje "Nombre de usuario y contraseña son requeridos" y un código de estado HTTP 400 (Bad Request).

2. Búsqueda del usuario en la base de datos:

```php
$user = $this->model->usuarios($username);
```

-Se busca el usuario en la base de datos utilizando el nombre de usuario proporcionado. Esto puede ser un método del modelo que recupera los datos del usuario correspondientes al nombre de usuario dado.

3. Verificación de credenciales:

```php
if ($user && password_verify($password, $user->Password)) {
```

- Se verifica si se encontró un usuario y si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos. Para verificar la contraseña de manera segura, se utiliza la función password_verify.

4. Inicio de sesión y almacenamiento de datos de usuario:

```php
session_start();
$_SESSION['IS_LOGGED'] = true;
$_SESSION['USERNAME'] = $user->name;
$_SESSION['ROLE'] = $user->Range;
```

- Si las credenciales son válidas, se inicia una sesión y se almacenan algunos datos del usuario en las variables de sesión, como el estado de inicio de sesión, el nombre de usuario y el rol del usuario.

5. Respuesta exitosa o error de autenticación:

```php
return $this->view->response("Inicio de sesión exitoso", 200);
```

- Si las credenciales son válidas, se devuelve una respuesta con el mensaje "Inicio de sesión exitoso" y un código de estado HTTP 200 (OK).

```php
return $this->view->response("Nombre de usuario o contraseña incorrectos", 401);
```

- Si las credenciales son incorrectas (usuario no encontrado o contraseña incorrecta), se devuelve una respuesta con el mensaje "Nombre de usuario o contraseña incorrectos" y un código de estado HTTP 401 (Unauthorized).

6. Manejo de errores:

```php
catch (Exception $e) {
    // Manejo de errores
    return $this->view->response("Error al verificar el login: " . $e->getMessage(), 500);
}
```

- Se captura cualquier excepción que ocurra durante el proceso de verificación de inicio de sesión y se devuelve una respuesta con un mensaje de error apropiado y un código de estado HTTP 500 (Internal Server Error) en caso de que ocurra una excepción.






## La función completa queda así

```php
function verify_login($username, $password) {
    if (empty($username) || empty($password)) {
        return $this->view->response("Nombre de usuario y contraseña son requeridos", 400);
    }

    try {

        $user = $this->model->usuarios($username);
        
        if ($user && password_verify($password, $user->Password)) {
            session_start();
            $_SESSION['IS_LOGGED'] = true;
            $_SESSION['USERNAME'] = $user->name;
            $_SESSION['ROLE'] = $user->Range;

    
            return $this->view->response("Inicio de sesión exitoso", 200);
        } else {
            return $this->view->response("Nombre de usuario o contraseña incorrectos", 401);
        }
    } catch (Exception $e) {
        return $this->view->response("Error al verificar el login: " . $e->getMessage(), 500);
    }
}

```

- La función verify_login verifica si las credenciales de inicio de sesión proporcionadas son válidas. Realiza las siguientes acciones
