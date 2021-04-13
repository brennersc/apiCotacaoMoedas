<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Instalar projeto </br>
1 - Baixe/clone o repositório </br>
2 - Instale as dependências php: composer install </br>
3 - Instale as dependências nodejs: npm install </br>
4 - Altere o arquivo .env.example para .env </br>
5 - Altere o conteudo do arquivo .env com as configurações de banco de dados e email </br>
    - banco de dados </br>
    DB_CONNECTION=mysql </br>
    DB_HOST=127.0.0.1 </br>
    DB_PORT=3306 </br>
    DB_DATABASE=cotacao </br>
    DB_USERNAME=root </br> 
    DB_PASSWORD= </br>
 </br>
6 - Execute as migrations na linha de comando: php artisan migrate </br>
7 - Inicie a aplicação: php artisan serve </br>
8 - Acesse http://localhost:8000 </br>

</br></br></br>
## Teste Back-end Mawa Post 2021 #

Criar um painel administrativo para cotação de moedas utilizando [Laravel](https://laravel.com) e blade. No painel deverá ser possível fazer login e criar novas contas de usuário, além de poder realizar cotações da moeda escolhida e salvar o histórico das cotações realizadas pelo usuário logado. Para fazer as cotações utilize a API [AwesomeAPI](https://docs.awesomeapi.com.br/api-de-moedas).
