# FactorEnergia-Api

Este repositorio corresponde a la prueba técnica realizada para Factor Energía.

## Estructura de la prueba

La implementación de esta prueba se ha desarrollado en el framework **Laravel**, elegido por su familiaridad y eficiencia. Aunque estoy siempre dispuesto a aprender nuevos lenguajes y tecnologías, en este caso he optado por la herramienta que mejor manejo.

### Pasos realizados:

1. **Creación del endpoint:** El endpoint se ha implementado en el archivo `routes/api.php` con la siguiente ruta: `Route::get('/stackoverflow', [StackOverflowController::class, 'getDataFromAPI']);`.

2. **Llamada a la API de Stack Overflow:** Se ha implementado la lógica necesaria para realizar la llamada a la API de Stack Overflow utilizando el patrón de diseño **DDD (Domain Driven Design)**. Se han aplicado los filtros especificados en el enunciado: 'fromdate', 'todate' y 'tagged'.

3. **Creación de la base de datos:** Los resultados obtenidos de la API se almacenan en una base de datos para evitar llamadas repetidas. Se ha utilizado **Eloquent** para gestionar las consultas mediante un modelo. La creación de las tablas se realiza mediante las migraciones proporcionadas por Laravel, facilitando la implementación en distintos entornos.

## Cómo ejecutar la prueba localmente

Para poner en funcionamiento este endpoint, sigue estos sencillos pasos desde la raíz del proyecto:

1. Configura correctamente el archivo `.env` (por defecto, se proporciona la base de datos del contenedor).

2. Levanta los contenedores web y MySQL utilizando **Docker Compose**. Aunque en este caso solo se requiere MySQL, ejecuta el siguiente comando:
    ```bash
    docker-compose up -d mysql
    ```

3. Crea las tablas utilizando las migraciones de Laravel ejecutando el siguiente comando:
    ```bash
    php artisan migrate
    ```

4. Una vez completados estos pasos, simplemente llama al endpoint a través de la siguiente URL:
    ```
    http://127.0.0.1:8000/api/stackoverflow?tagged=php&todate=2023-12-08&fromdate=2023-11-23
    ```

5. Utiliza un cliente de MySQL para conectarte y visualizar los registros guardados. El endpoint devuelve un JSON con el resultado.
