## Instalação

O sistema para gerenciamento de uma creche de animais de estimação utiliza [Laravel](https://laravel.com/docs/10.x) v10+.

Instale as dependencias e inicie o server.

```sh
git clone https://github.com/vverardO/pets-daycare.git
cd pets-daycare
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Para rodar os testes basta executar o seguinte comando:

```sh
cd pets-daycare
php artisan test
```