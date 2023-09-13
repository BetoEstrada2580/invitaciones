
# Invitaciones

Proyecto en laravel 10 para sistema de venta de invitaciones web

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
  composer install;
  npm install
```

Running migrations and seeders

```bash
  php artisan migrate;
  php artisan db:seed
```

Start Vite development server

```bash
  npm run dev
```

Start the laravel server (doesn't neeeded in laravel)

```bash
  php artisan serve
```

## Commands

- php artisan make:model --migration **{ModelName}**
    - Crear archivo de modelo y migracion a la vez
-  php artisan migrate:fresh **--seed**
    - Eliminar base de datos y volver a correr toda la migración y los seed
-  php artisan migrate:rollback **--step=1**
    - Hacer rollback de migracion con numero de pasos hacia atras
-  php artisan make:migration **add_username_to_users_table**
    - (Ejemplo y de preferencia poner el nombre de la migracion en ingles con esta estructura para agregar campos)
- php artisan route:cache
    - Eliminar cache del router por sí no reconoce cambios
- php artisan make:controller **{ControllerName}** -r
    - Crear archivo de Controller
- php artisan make:model --migration --controller **{ControllerName}**
    - Crear modelo, migracion y controller a la vez
- php artisan make:policy **{ModelNamePolicy}** --model=**{ModelName}**
    - Crear arhivo de policys de cierto modelo
- php artisan tinker
    - shell de Laravel
- php artisan make:model --migration --factory **{ModelName}**
    - Hacer modelo, migracion y factory (creacion de registros para pruebas junto con tinker)
- php artisan make:seeder **{ModelNameSeeder}**
    - Crear seeder
## Documentation

- [Laravel Documentation](https://laravel.com/docs/10.x)
- [Trello](https://trello.com/b/HrYki7FI/invitaciones)
- [DataTables](https://datatables.net/examples/index)
- [Tailwindscss](https://tailwindcss.com/docs/guides/laravel)

## Authors

- [@BetoEstrada2580](https://github.com/BetoEstrada2580)
