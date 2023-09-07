
# Invitaciones


## Instrucciones

- **Clonar repositorio**
    - Git clone
- **Instalar dependencias necesarias**
    - composer install
- **php artisan migrate**
    - Correr la migracion de las tablas
- **Comando de los seeders**
    - Agregar los registros base con los seeders
## Comandos Laravel

- php artisan make:model --migration **{ModelName}**
    - Crear archivo de modelo y migracion a la vez
-  php artisan migrate
    - Correr la migracion
-  php artisan migrate:rollback **--step=1**
    - Hacer rollback de migracion con numero de pasos hacia atras
-  php artisan make:migration **add_username_to_users_table**
    - (Ejemplo y de preferencia poner el nombre de la migracion en ingles con esta estructura para agregar campos)
- php artisan route:cache
    - Eliminar cache del router por sí no reconoce cambios
- php artisan make:controller **{Controllername}**
    - Crear archivo de Controller
- php artisan make:model --migration --controller **{Controllername}**
    - Crear modelo, migracion y controller a la vez
- php artisan make:policy **{Policyname}** --model=**{Modelname}**
    - Crear arhivo de policys de cierto modelo
- php artisan serve
    - Arrancar el server de laravel
- npm run dev
    - Correr server para hotload
- php artisan tinker
    - shell de Laravel
- php artisan make:model --migration --factory **{Modelname}**
    - Hacer modelo, migracion y factory (creacion de registros para pruebas junto con tinker)

## Paginas de interes

- **[Laravel Documentation](https://laravel.com/docs/9.x)**
- **[Trello](https://trello.com/b/HrYki7FI/invitaciones)**
- **[Bootstrap](https://getbootstrap.com/docs/5.2/getting-started/introduction/)**