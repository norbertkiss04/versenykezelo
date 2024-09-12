

## Követelmények

 - PHP 8.2
 - Composer
 - Ezek a PHP bővítmények engedélyezése/letöltése: `fileinfo, pdo_mysql, mysqli`

## Futtatás menete

    git clone https://github.com/norbertkiss04/versenykezelo/
    cd megye-varos
    composer update
    composer install

`.env` létrehozása `.env.example` ből és az adatbázis konfigurálása

    php artisan key:generate
    php artisan migrate --seed
    php artisan serve

Ha a felhasznalónév `admin`, akkor hozzáférése lesz admin funkciókhoz. Általános felhasználók, akik meg tudják tekinteni az adatokat: `gabor_nagy`, `katinka_toth` . Versenyzők: `peter_kovacs`, `anna_szabo`
