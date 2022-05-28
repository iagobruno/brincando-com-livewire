# brincando-com-livewire

https://user-images.githubusercontent.com/3616259/169961377-cbfa4a8b-7020-45ac-9852-ccf84a88469b.mp4

## Getting started

Clone this repo and run commands in the order below:

```bash
composer install
cp .env.example .env # And edit the values
php artisan key:generate
php artisan storage:link
```

Then start the server:

```
php artisan serve
```

### Front-end assets

Open another terminal tab and run the command below to compile front-end assets:

```bash
yarn install
yarn run watch
```

Now you can access the project at http://localhost:8000 in the browser.
