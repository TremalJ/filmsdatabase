**Página inicial**
En caso de querer crear la BD y actualizar esquema:

`php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:schema:update --force`

Tras arrancar el proyecto :

`symfony serve`

Para cargar desde la raiz:

https://localhost:8000/


Para cargar desde el dashboard de films:
https://localhost:8000/en/easyadmin?crudAction=index&crudControllerFqcn=App%5CController%5CEasyAdmin%5CFilmCrudController&menuIndex=0&signature=Bdoif9c292LJJFXVv7lBkequzT3Q0lcDfHK9orY5Jio&submenuIndex=-1


**Creación de Bases de Datos**

Elegida PostgreSQL para realizar el test.

**Esquema e entidades**

**Películas**

■ Titulo (string)

■ Fecha de publicación (date)

■ Género(s) (string)

■ Duración (string)

■ Productora (string)


**Actor(es)**

■ Nombre (string)
 
■ Fecha nacimiento (date)

■ Fecha fallecimiento (date)

■ Lugar de nacimiento (date)

**Director(es)**

■ Nombre (string)

■ Fecha nacimiento (date)

No se han agregado los campos created_at ni updated_at, al no estar especificados en la documentación. 
Para evitar añadir campos de más.

**Definición de las tablas para la Base de datos**

Creación de las tablas y entidades Film, Actor y Director.

Relación N:N entre :
Actor - Film
Director - Film

Para desde la ficha de actor y director poder agregar las películas en las que pueden aparecer.

**Creación del comando para importar el CSV:**

Para poder importar los datos desde el éxcel hay que ejecutar el siguiente comando:

`php bin/console app:import-csv`

El único campo que puede dar errores por su formato podría ser date_published al ser un campo date, para ello
hacemos su validación, el resto al ser carácteres no tendrá problemas en la inserción y el escapado de datos.

**Interfaz**

-Los buscadores cargan las búsquedas planteadas tanto en Film, Actor y Director.

-Se han usado los CSS por defecto.
