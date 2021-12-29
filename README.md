# MegaStream Documentation
---
## Installation
> Dependancies: Composer (php package manager), Nodejs (with npm, node package manager), php >= 7.4 / 8, Postgresql

*Install Dependencies*
```bash
npm install
composer install
```
```bash
#ffmpeg is used to generate thumbnail
sudo apt-get update
sudo apt-get install ffmpeg
```

> Note: for windows user make sure to add path to ffmpeg and ffprobe binaries in your .env
```
FFMPEG_BINARIES='PATH_TO_FFMPEG_BINARIES'
FFPROBE_BINARIES='PATH_TO_FFPROBE_BINARIES'
```

*Database Connection*
>Edit a .env files to configure your database connection (see .env.example)
>note: We used pgsql w/ pgAdmin4

*Run Migration*
```bash
php artisan migrate
```

*Seeding Database (important for Categories Table)*
```bash
php artisan db:seed --class=CategorieSeeder
```

*Create storage link*
```bash
php artisan storage:link
```

*Launching Queue Work (don't forget timeout, transcoding to HLS can take a lot of time*
```bash
php artisan queue:work --timeout=600
```

*Generate Key for application*
```bash
php artisan key:generate
php artisan config:cache
```

*Launch Local Server*
```bash
php artisan serve
```

## Usefull cmd
```bash
# rollback latest migration
php artisan migrate:rollback
# rollback w/ step
php artisan migrate:rollback --step=5
# rollback all
php artisan migrate:reset
# Refresh the database and run all database seeds...
php artisan migrate:refresh --seed
```

---
## Ressources
[**Kanban**](https://trello.com/invite/b/k9ADIOWK/0b6345b58bb236166c85c581f57337a6/megastreaming)

[**Diag. de Gant**](https://lucid.app/lucidchart/b0379927-c113-4582-a4dd-ae15c873cc3c/edit?viewport_loc=-345%2C-100%2C2588%2C1121%2CuDe-dIt-NWfS&invitationId=inv_b4bc6b6f-3991-4eca-8af7-2d7b514c3846https://lucid.app/lucidchart/b0379927-c113-4582-a4dd-ae15c873cc3c/edit?viewport_loc=-345%2C-561%2C2588%2C1121%2CuDe-dIt-NWfS&invitationId=inv_cf51e98d-b8ff-4c6a-b02c-53739f035d54)

[**ERD**](https://lucid.app/lucidchart/ba9dc218-9f66-4450-9a04-68eda48c9e55/edit?viewport_loc=-1406%2C-777%2C5206%2C2475%2C0_0&invitationId=inv_ee184744-6cb8-43af-8f0b-984bdeb643a4)


