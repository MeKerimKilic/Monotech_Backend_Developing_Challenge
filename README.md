<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Apı List

Giriş işlemleri için

``
/backoffice/login
``
Parametre:

`username,password`

Kayıt işlemleri için

``
/backoffice/register
``
Parametre:

`username,email,firstname,lastname,password,password_confirmation`

Kayıt olarak ve giriş yaparak işlemleri gerçekleştirebilir test edebilirsiniz.

Laravel Passport'ta hata verirse aşağıdaki komutu kullanın
`` composer run laravel-passport-client``
