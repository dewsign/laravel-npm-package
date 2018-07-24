# Internal Pages module for Maxfactor CMS

This boilderplate is ready to be published to Packagist and NPM JS.

## Installation

1. composer require maxfactor/pages
1. php artisan vendor:publish --provider=Maxfactor\\CMS\\Pages\\Providers\\PackageServiceProvider
1. php artisan migrate
1. Add PagesTableSeeder to DatabaseSeeder.php
1. Import the admin routes into `routes/admin.php` by adding `Maxfactor\CMS\Pages\Routes::admin();`
1. Import the Page Store module into `store/index.js`
1. Import Page routes and add `...Pages,` to the top of the `routes/routes.js` array
1. Import the Pages menu and add `...Pages,` to the top of the menu/index.js` array
