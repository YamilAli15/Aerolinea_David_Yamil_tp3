# Proyecto Página de Aerolíneas

Este proyecto consiste en una página web para la gestión de aeronaves y vuelos, implementando funcionalidades CRUD (Crear, Leer, Actualizar, Eliminar) utilizando PHP.

## Índice

### Controladores

1. [Controlador de Aeronaves](#controlador-de-aeronaves)
    - [Función `mostrarTablaDeAviones()`](#función-mostrartabladeaviones)
    - [Función `listarPorPrecio()`](#función-listarporprecio)
    - [Función `filtrarPorPrecioMayorElegido()`](#función-filtrarporpreciomayorelegido)
    - [Función `eliminarAeronave()`](#función-eliminaraeronave)
    - [Función `insertarAeronave()`](#función-insertaraeronave)
    - [Función `actualizarAeronave()`](#función-actualizaraeronave)
    
2. [Controlador de Vuelos](#controlador-de-vuelos)
    - [Función `Mostrartabladevuelos()`](#función-Mostrartabladevuelos)
    - [Función `mostrarTablaDeVuelosID()`](#función-mostrarTablaDeVuelosID)
    - [Función `insertarVuelo()`](#función-insertarvuelo)
    - [Función `actualizarVuelo()`](#función-actualizarvuelo)
    - [Función `eliminarvuelo()`](#función-eliminarvuelo)

## Controlador de Aeronaves

### Función `mostrarTablaDeAviones()`

## Configurar la URL de la API

Si tu aplicación está corriendo en localhost y la función Mostrar_tabla_de_aviones está expuesta en una ruta como /api/aviones, la URL podría ser algo como localhost/"A dónde guardaste tu archivo"/api/Aviones.

1. Crear una nueva petición en Postman:

Abre Postman y crea una nueva petición seleccionando New -> HTTP Request.

2. Seleccionar el método HTTP:

Selecciona GET como el método HTTP, ya que parece que esta función está diseñada para obtener datos.

3. Configurar la URL:

Ingresa la URL que configuraste en el primer paso.

4. Enviar la petición:

Haz clic en el botón Send para enviar la petición.

5. Verificar la respuesta:

Si todo está configurado correctamente y hay datos en la base de datos, deberías ver una respuesta similar a esta en Postman:

~~~json
"status": 200,
    "data": [
        {
            "ID": "2",
            "Aeronave": "Boeing 747",
            "Precio": "2000000",
            "Fecha": "2024-08-14 16:30:00"
        },]
~~~

- Si no hay datos, deberías ver:

~~~json
{
    "status": 404,
    "message": "No hay tareas en la base de datos"
}
~~~

- Si ocurre un error en el servidor, verás algo como:

~~~json
{
    "status": 500,
    "message": "Error de servidor: [mensaje de error]"
}
~~~

## Notas Adicionales

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `listarPorPrecio()`

## Configurar la URL de la API

1. Crear una nueva petición:

Haz clic en "New" y selecciona "Request".

2. Configurar la URL de la petición:

En la barra de dirección, ingresa la URL correspondiente a tu servidor y la ruta configurada. Por ejemplo:
localhost/"A dónde guardaste tu archivo"/api/Aviones/"Elegir si es ascendente o descendente
Por ejemplo lo podrías hacer con un botón en la vista"
Pero recuerda que el parámetro tiene que ser uno de los dos **ascendente o descendente**

3. Seleccionar el método HTTP:

Cambia el método a GET si tu ruta está configurada para responder a peticiones GET.

4. Agregar parámetros:

Haz clic en la pestaña "Params" debajo de la barra de dirección.
Agrega un nuevo parámetro con la clave :ID y el valor correspondiente. Según tu función, los valores válidos son ascendente o descendente.

Ejemplo de parámetros:

Key    | Value

: ID    | ascendente

Ejecutar la Petición y Enviar la petición:

Haz clic en el botón "Send" para enviar la petición.
5. Revisar la respuesta:

- La respuesta se mostrará en la sección de "Body" de Postman.
Ejemplo de Petición en Postman

URL: http://tu-servidor/listar_por_precio

Método: GET

Parámetros:  ID = ascendente

La función en el servidor PHP responderá con una lista de aeronaves ordenadas por precio de manera ascendente si el parámetro :ID es ascendente. De manera similar, responderá con una lista de aeronaves ordenadas por precio de manera descendente si el parámetro es descendente.

- Ejemplo de Respuesta 

Respuesta exitosa:

 ascendente

~~~json
{
    "status": 200,
    "data": 
    [
        {
            "ID": "6",
            "Aeronave": "Boeing 500",
            "Precio": "1500000",
            "Fecha": "2024-05-18 19:53:00"
        },
        {
            "ID": "12",
            "Aeronave": "Londres ",
            "Precio": "1600000",
            "Fecha": "2024-06-13 19:28:29"
        },
        {
            "ID": "2",
            "Aeronave": "Boeing 747",
            "Precio": "2000000",
            "Fecha": "2024-08-14 16:30:00"
        },
    ]
}
~~~

- Respuesta exitosa:

descendente

~~~json
{
    "status": 200,
    "data": 
    [
        {
            "ID": "19",
            "Aeronave": "Boeing 300",
            "Precio": "80000000",
            "Fecha": "2024-06-27 00:00:00"
        },
        {
            "ID": "15",
            "Aeronave": "Paris",
            "Precio": "50000000",
            "Fecha": "2024-06-18 19:31:25"
        },
        {
            "ID": "14",
            "Aeronave": "Nueva York",
            "Precio": "3000000",
            "Fecha": "2024-06-26 19:31:25"
        },
    ]    
}        
~~~

- Parámetro no proporcionado:

~~~json
{
    "status": 500,
    "message": "Parámetro no proporcionado"
}
~~~

- Parámetro inválido:

~~~json
{
    "status": 500,
    "message": "Error de parámetro inválido"
}
~~~

-No hay tareas en la base de datos:

~~~json
{
    "status": 404,
    "message": "No hay tareas en la base de datos"
}
~~~

- Manejo de Errores
Si hay algún problema con la base de datos o con la ejecución de la función, la respuesta será:

~~~json
{
    "status": 500,
    "message": "Error de servidor: [mensaje de error]"
}
~~~

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `filtrarPorPrecioMayorElegido()`

La función Filtrar por el precio mayor elegido en tu código PHP se encarga de filtrar aeronaves por un precio mayor o igual al que se pasa como parámetro. A continuación, te explico en detalle cómo usar esta función con Postman:

1. Configuración de la petición en Postman:

Método HTTP: GET

2. URL:

La URL de tu API que maneja esta función. Por ejemplo: localhost/"A dónde guardaste tu archivo"/api/Aviones/"Acá tendrías que poner la cantidad que quieres que filtre Por ejemplo el 300 y te va a traer todos los iguales o mayores a **300**".

3. Ejemplo de respuestas

-Caso exitoso:

Descripción: Cuando se encuentran aeronaves con el precio mayor o igual al especificado.

~~~json
{
    "status": 200,
    "data": [
        {
            "ID": 2,
            "Aeronave": "Boeing 747",
            "Precio": 2000000,
            "Fecha": "2024-08-14 16:30:00"
        },{
            "ID": 14,
            "Aeronave": "Nueva York",
            "Precio": 3000000,
            "Fecha": "2024-06-26 19:31:25"
        }
    ]
}    
~~~

- Si no hay aeronaves:

~~~json
{
    "status": 404,
    "message": "No hay aeronaves en la base de datos"
}
~~~

- Si hay un error en el servidor:

~~~json
{
    "status": 500,
    "message": "Error de servidor: descripción del error"
}
~~~

Con estos pasos, deberías poder utilizar tu función **Filtrar_por_el_precio_mayor_elegido** en **Postman** para probar y verificar su comportamiento.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `eliminarAeronave()`

Para usar la función eliminarAeronave en Postman, deberás configurar una solicitud HTTP (generalmente DELETE) para que llame a esta función en tu API. Aquí te explico paso a paso cómo hacerlo:

1. Método HTTP:
La función eliminarAeronave se utiliza para eliminar una aeronave, por lo que el método HTTP que usarás será DELETE.

2. URL de la solicitud:
La URL debe apuntar al endpoint de tu API que maneja la eliminación de aeronaves. Por ejemplo:

localhost/"A dónde guardaste tu archivo"/api/Aviones/ID

Reemplaza {ID} con el ID de la aeronave que deseas eliminar.

3. Parámetros de la solicitud:
En este caso, el parámetro necesario es el ID de la aeronave, que se puede pasar directamente en la URL. No necesitas enviar parámetros en el cuerpo de la solicitud para un método DELETE.
Recuerda que no tenga Ninguna vinculación a la otra Tabla Porque si no no se van a poder borrar Sin haber borrado antes lo de la tabla de vuelo.

4. Enviar la solicitud:

Haz clic en el botón "Send".

5. Ejemplo de respuestas.

- Caso exitoso:

~~~json
{
    "msg": "El Aeronave con id: 13 ha sido borrado con éxito"
}
~~~

- Si no hay aeronaves:

~~~json
{
    "msg": "El Aeronave con id: 133 NO existe"
}
~~~

- Si hay un error en el servidor o Se te haya olvidado borrar los vuelos vinculados:

1. Error por la vinculación a la tabla de vuelos Por eso necesitas Borrar el vuelo vinculado primero

~~~json
"Error de servidor: SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`db_aerolineas`.`vuelos`, CONSTRAINT `FK_VUELO_AEROLINEA` FOREIGN KEY (`id_aerolinea`) REFERENCES `aerolineas_argentinas` (`ID`))"
~~~

2. Si hay un error en el servidor

~~~json
"Error de servidor: 500"
~~~

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `insertarAeronave()`

1. Seleccionar método HTTP:

Selecciona POST como método HTTP.

2. Establecer URL:

Introduce la URL de tu API que apunta al endpoint correspondiente. Por ejemplo:

localhost/"A dónde guardaste tu archivo"/api/Aviones

3. Configurar el cuerpo de la solicitud:

Ve a la pestaña Body.
Selecciona raw y luego JSON (application/json).
Introduce los datos en formato JSON, por ejemplo

~~~json
{
    "Aeronave": "Boeing 300",
    "Precio": 80000000,
    "Fecha": "2024-06-27"
}
~~~

4. Enviar la solicitud:

Haz clic en el botón Send para enviar la solicitud.

5. Ver la respuesta:

- En la sección de respuesta de Postman, deberías ver la respuesta de la API, que podría ser algo como:

~~~json
{
  "message": "Se insertó correctamente",
  "status": 200
}
~~~

- O en caso de error

~~~json
{
  "message": "Faltan datos requeridos.",
  "status": 400
}
~~~

~~~json
{
  "message": "Error al insertar los datos.",
  "status": 500
}
~~~

Con estos pasos, podrás probar la función insert_Aeronave en tu API usando Postman.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `actualizarAeronave()`

1. Configurar la URL y el método HTTP
Método HTTP: PUT

Actualiza la información de una aeronave existente.

2. URL: La URL dependerá de tu localhost/"A dónde guardaste tu archivo"/Aviones/ID, donde :ID será el identificador de la aeronave.

3.  Configurar el Body
Selecciona la opción raw y elige el tipo JSON. Luego, en el cuerpo de la solicitud, proporciona los datos necesarios como se espera en la función.

~~~json
{
  "Aeronave": "Nuevo Aeronave",
  "Precio": "Nuevo Piloto",
  "Fecha": "2024-06-277/07/24",
  "ID":2
}
~~~

4. Enviar la solicitud

Envía la solicitud y observa la respuesta. La función debe responder con uno de los siguientes mensajes:

- Si la aeronave se actualiza correctamente:

~~~json
{
    "msg:": "la Aeronave con el id: 2 fue modificado"
}
~~~

- Si faltan datos obligatorios:

~~~json
{
  "msg": "Faltan datos obligatorios para modificar o los datos ingresados no coinciden con los datos de la tabla"
}
~~~

- Si la aeronave no existe:

~~~json
{
  "msg": "la Aeronave con el id: [ID] no existe"
}
~~~

Siguiendo estos pasos, podrás hacer la solicitud correcta a tu API para actualizar una aeronave usando Postman.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

## Controlador de Vuelos

### Función `Mostrartabladevuelos()`

1. Configura la solicitud:

- Método HTTP: GET
- URL: localhost/"A dónde guardaste tu archivo"/api/vuelos

2. Enviar la solicitud:

Haz clic en Send.

3. Ejemplo de Respuesta:

- 200 OK:

Esto indica que los datos de los vuelos fueron recuperados con éxito.

~~~json
"status": 200,
    "data": 
    [
        {
            "ID_Vuelos": 1,
            "Destino": "Francia",
            "Pilotos": "Juan y Pepito",
            "id_aerolinea": 2
        },
    ]
~~~

- 404 Not Found:

Esto indica que no hay datos en la tabla de vuelos.

~~~json
{
  "status": 404,
  "message": "No hay tareas en la base de datos"
}
~~~

- 500 Internal Server Error:

Esto indica que ocurrió un error en el servidor.

~~~json
{
  "status": 500,
  "message": "Error de servidor: [mensaje de error]"
}
~~~

Con estos pasos, deberías poder invocar la función Mostrar_tabla_de_vuelos desde Postman y ver la respuesta correspondiente.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `mostrarTablaDeVuelosID()`

1. URL de la API:
Asume que tu API está alojada en localhost/"A dónde guardaste tu archivo"/api/Vuelos/ID

2. Método HTTP:
Selecciona el método HTTP adecuado. Generalmente, será GET si solo estás obteniendo datos.

3. Parámetros:
En la sección de "Params" de Postman, agrega un parámetro de ruta llamado id con el valor que quieres consultar. Alternativamente, puedes usar el formato de la URL: localhost/"A dónde guardaste tu archivo"/123 donde 123 es el ID del vuelo.

4. Enviar la Petición:
Haz clic en el botón "Send" y revisa la respuesta de la API en la sección de "Response" de Postman.

5. Ejemplo de Respuesta:

- Respuesta exitosa

~~~json
{
    "status": 200,
    "data": [
        {
            "ID_Vuelos": 1,
            "Destino": "Francia",
            "Pilotos": "Juan y Pepito",
            "id_aerolinea": 2,
            "ID": 2,
            "Aeronave": "Nuevo Aeronave",
            "Precio": 0,
            "Fecha": "0000-00-00 00:00:00"
        }
    ]
}
~~~

- O en caso de error:

~~~json
{
    "status": 404,
    "message": "No hay vuelos en la base de datos"
}
~~~

Con estos pasos, podrás usar la función mostrarTablaDeVuelosID en Postman para probar y verificar el funcionamiento de tu API.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `insertarVuelo()`

1. Método: Selecciona POST.

2. URL: Ingresa la URL de tu endpoint, por ejemplo, localhost/"A dónde guardaste tu archivo"/api/Vuelos/ID La ID es el vuelo a elegir.

3. Paso 2: Configura el cuerpo de la solicitud

Ve a la pestaña Body.

Selecciona la opción raw.

Cambia el formato a JSON.

Ingresa el siguiente JSON en el cuerpo de la solicitud, asegurándote de incluir los campos necesarios (**Destino**, **Precio**, **id_aerolinea**):

- Ejemplo:

~~~json
{ 
    "Destino": "argentina",
    "Pilotos": "Yamil",
    "id_aerolinea": "6"
}
~~~

- Respuesta exitosa

~~~json
"Se insertó correctamente con id: 11"
~~~

- Error por falta de datos

~~~json
"Datos incompletos"
~~~

- Esto sucede cuando lo intentas conectar una ID que no existe:

~~~json
"Error al insertar el vuelo: Error al insertar el vuelo: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_aerolineas`.`vuelos`, CONSTRAINT `FK_VUELO_AEROLINEA` FOREIGN KEY (`id_aerolinea`) REFERENCES `aerolineas_argentinas` (`ID`))"
~~~


Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `actualizarVuelo()`

1. Configuración de la Solicitud HTTP:

Abre Postman y crea una nueva solicitud.
Selecciona el tipo de solicitud HTTP adecuado  PUT

2. URL de la solicitud:

- Ingresa la URL de tu API o ruta PHP que maneja la actualización del vuelo. Por ejemplo, si tu API está en localhost/"A dónde guardaste tu archivo"/api/Vuelos, esa sería la URL base.

- esta estar esperando datos como Destino, Pilotos, id_aerolinea, etc. Puedes configurar esto en el cuerpo de la solicitud en Postman, ya sea como JSON, form-data.

3. Enviar la Solicitud:

Después de configurar la URL y el cuerpo de la solicitud en Postman, puedes enviar la solicitud haciendo clic en el botón "Enviar".

4. Verificar la Respuesta:

- Modificado con éxito 200

~~~json
{
    "msg:": "El Vuelos con el id: 1 fue modificado",
}
~~~

- Faltan Campos 400

~~~json
{
"msg:": "Faltan datos obligatorios para modificar o los datos ingresados no coinciden con los datos de la tabla"
}
~~~

- ID de inexistente

~~~json
{
    "msg:": "El Vuelos con el id: 100 no existe"
}
~~~

Al enviar esta solicitud, deberías obtener una respuesta según cómo esté implementada la lógica en tu backend PHP, siguiendo los pasos de validación y actualización que has definido en la función actualizarVuelo.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05

### Función `eliminarvuelo()`

1. Configuración de la Solicitud HTTP:

- Abre Postman y crea una nueva solicitud.
Selecciona el tipo de solicitud HTTP adecuado  DELETE

- ngresa la URL del endpoint donde está ubicada tu función PHP que maneja la eliminación de vuelos.

2. Configurar los parámetros:

- Si tu función espera parámetros, como el ID del vuelo que se va a eliminar (:ID), asegúrate de incluirlos en la sección de parámetros de Postman.
Puedes agregar parámetros directamente en la pestaña "Params" de Postman, especificando la clave :ID y su valor correspondiente.

- Ingresa la URL de tu API o ruta PHP que maneja la actualización del vuelo. Por ejemplo, si tu API está en localhost/"A dónde guardaste tu archivo"/api/Vuelos/ID, esa sería la URL base.

3. nviar la solicitud:

Una vez configurados los parámetros necesarios, haz clic en el botón "Send" para enviar la solicitud a tu servidor PHP.

4. Verificar la Respuesta:

- Eliminación exitosa:

~~~json
{
    "msg": "El vuelo con id: 10 ha sido borrado con éxito"
}
~~~

- Error en la ID

~~~json
{
    "msg": "El vuelo con id: 100 NO existe"
}
~~~

Es importante que el endpoint al que apuntas en Postman coincida con la configuración de tu servidor PHP y que los parámetros enviados estén correctamente formateados según lo esperado por la función eliminarvuelo. Esto asegurará que puedas probar y verificar el comportamiento de tu función de eliminación de vuelos de manera efectiva.

Asegúrate de que tu servidor esté corriendo antes de enviar la petición desde Postman.
Verifica que la ruta de la API y el método HTTP sean correctos.
Si necesitas autenticación, asegúrate de incluir los encabezados necesarios en tu petición de Postman.
Si tienes alguna duda adicional o necesitas más detalles, ¡no dudes en preguntar!

mi email: aliiiyamil05@gmail.com

Mi Instagram: aliiyamil05
