<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Sistema de Capital Humano

El flujo recomendado es construir y probar una parte completa antes de abrir el siguiente módulo:

1. Catálogos organizacionales y personales.
2. Alta y consulta de trabajadores, con información personal, domicilio, contactos y dependientes.
3. Historial laboral, contratos, vacaciones e incapacidades.
4. Cursos, sanciones, equipo y EPP.
5. Autorizaciones por rol y pruebas de privacidad antes de usar datos reales.

La base existente usa algunos nombres heredados de Laravel, como `trabajadors`, `estado_civils`, `lugar_nacimientos` y `tipo_sangres`. Los modelos declaran esos nombres explícitamente; no renombres esas tablas sin una migración de datos planificada.

Un trabajador tiene una sola información personal y un solo domicilio vigente. El domicilio tiene una restricción única por trabajador; cambiarlo debe actualizar el registro, no crear otro. Los catálogos iniciales —incluidos los tipos de cuenta Administrador, Recursos Humanos y Consulta— se pueden insertar con `php artisan db:seed`; sus seeders son idempotentes y no crean trabajadores ficticios.

El acceso a trabajadores requiere sesión. El registro público está deshabilitado; una persona administradora debe crear cuentas en el servidor con `php artisan users:create`. Ese comando pide la contraseña sin mostrarla y exige al menos 12 caracteres. La autenticación usa [Laravel Fortify](https://laravel.com/docs/12.x/fortify), con las pantallas protegidas implementadas en [Livewire](https://livewire.laravel.com/docs). Las cuentas se pueden relacionar con un trabajador, gerencia y tipo de usuario. La verificación en dos pasos usa TOTP y códigos de recuperación de Fortify; no se guardan contraseñas de correo ni códigos OTP sin proteger. El diagrama incluye una contraseña de correo, pero se excluyó del esquema porque no es seguro almacenar credenciales de correo. Para asegurar el acceso por tipo/gerencia, todavía habrá que implementar y probar políticas de autorización.

Para validar cambios de base primero revisa el SQL con `php artisan migrate --pretend`. Antes de aplicar migraciones al MySQL configurado, haz un respaldo y confirma el destino; no uses `migrate:fresh` en una base con datos.

Las relaciones, conversiones de atributos y fábricas usan Eloquent. Consulta la guía de [relaciones](https://laravel.com/framework/docs/12.x/eloquent-relationships), [casts](https://laravel.com/framework/docs/12.x/eloquent) y [factories](https://laravel.com/framework/docs/12.x/eloquent-factories). API Resources y serialización conviene agregarlos cuando se defina una API y sus campos permitidos, especialmente por la información clínica y psicológica.

Ejecuta las pruebas con `php artisan test`.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
