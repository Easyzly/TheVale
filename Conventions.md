# Laravel Conventions

## 1. Naming Conventions
- **CamelCase for Functions:** Gebruik CamelCase voor functienamen. Bijvoorbeeld: `getUserName()`.
- **snake_case for Variables:** Gebruik snake_case voor variabelen. Bijvoorbeeld: `$user_name`.
- **StudlyCase for Classes:** Gebruik StudlyCase (of PascalCase) voor klassennamen. Bijvoorbeeld: `UserController`.
- **snake_case for Table Names:** Gebruik snake_case en meervoudsvormen voor tabelnamen. Bijvoorbeeld: `users`, `order_items`.
- **snake_case for Column Names:** Gebruik snake_case voor kolomnamen in databases. Bijvoorbeeld: `first_name`, `created_at`.

## 2. File Structure
- **Controllers in `app/Http/Controllers`:** Alle controllers worden geplaatst in de map `app/Http/Controllers`, uitzondering voor folders in de controllers.
- **Models in `app/Models`:** Models worden geplaatst in de map `app/Models`.
- **Migrations in `database/migrations`:** Database migraties worden geplaatst in de map `database/migrations`.
- **Routes in `routes/web.php` or `routes/api.php`:** Routes worden gedefinieerd in de respectievelijke bestanden, afhankelijk van het type route (web of API).
- **Views in `resources/views`:** Alle Blade-viewbestanden worden geplaatst in `resources/views`.

## 3. Database Conventions
- **Primary Key as `id`:** De primaire sleutel moet standaard `id` heten.
- **Foreign Keys as `table_id`:** Vreemde sleutels moeten de vorm `table_id` hebben. Bijvoorbeeld: `user_id`, `post_id`.
- **Timestamps:** Gebruik de `timestamps`-methode voor automatisch beheer van `created_at` en `updated_at` kolommen.

## 4. Routing Conventions
- **Resourceful Controllers:** Gebruik resourceful controllers voor standaard CRUD-acties.
- **Route Names:** Gebruik de naam van de controller methode als een prefix in de routenaam. Bijvoorbeeld: `user.index`, `user.store`.
- **Group Routes:** Groepeer routes die een gemeenschappelijk voorvoegsel of middleware hebben.

## 5. Blade Templating Conventions
- **Use `@extends` and `@section`:** Gebruik `@extends` om een basislay-out te gebruiken, en `@section` om inhoud te injecteren.
- **Use `@include` for Partials:** Gebruik `@include` om gedeeltelijke views in te voegen.
- **Avoid Logic in Views:** Vermijd zoveel mogelijk logica in de views; gebruik helpers of view composers in plaats daarvan.
