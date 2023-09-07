
# Invitaciones

Proyecto en laravel 9 para sistema de venta de invitaciones web

## Run Locally

Clone the project

```bash
  git clone https://github.com/BetoEstrada2580/invitaciones.git
```

Go to the project directory

```bash
  cd invitaciones
```

Install dependencies

```bash
  composer install
  npm install
```

Running migrations and seeders

```bash
  php artisan migrate
  php artisan db:seed
```

Start Vite development server

```bash
  npm run dev
```

Start the laravel server

```bash
  php artisan serve
```

## Commands

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
- php artisan tinker
    - shell de Laravel
- php artisan make:model --migration --factory **{Modelname}**
    - Hacer modelo, migracion y factory (creacion de registros para pruebas junto con tinker)
- php artisan make:seeder **{Seedername}**
    - Crear seeder
## Documentation

- [Laravel Documentation](https://laravel.com/docs/9.x)
- [Trello](https://trello.com/b/HrYki7FI/invitaciones)
- [Bootstrap](https://getbootstrap.com/docs/5.2/getting-started/introduction/)
## Authors

- [@BetoEstrada2580](https://github.com/BetoEstrada2580)
