
# Validación de RUT chileno para Laravel 5.x - 6.x

Package pensado para validar y dar formato fácilmente al identificador **Rol Único Nacional** (**RUN**) para personas naturales y/o jurídicas de Chile, en el contexto del uso de Laravel Framework. 

Este package es un derivado de [MalaHierba\ChileRut](https://github.com/malahierba-lab/chile-rut), que surge como necesidad de cubrir ciertos requerimientos específicos que surgieron en proyectos de desarrollo.

Este package sólo valida que el formato y datos del RUT sean correctos. No implica su real existencia.

## Instalación

Para instalar esta librería basta con que la agregues a la sección *require* del composer.json de tu proyecto y luego ejecutes *composer update*

Para Laravel 5.x

    "malahierba-lab/chile-rut": "5.1.*"

Para Laravel 4.2

    "malahierba-lab/chile-rut": "4.2.*"

**Importante:** Si estás usando actualmente la versión "dev-master" **debes cambiarlo** por una de las versiones indicadas de acuerdo a la versión de Laravel que estés utilizando.

Luego carga el Service Provider dentro del arreglo *'providers'* del archivo *app/config/app.php*

Para Laravel 5.x

    Malahierba\ChileRut\ChileRutServiceProvider::class

Para Laravel 4.2

    'Malahierba\ChileRut\ChileRutServiceProvider'

Opcionalmente (pero altamente recomendado) puedes crear un alias dentro del archivo *app/config/app.php* en el arreglo 'aliases' para poder invocar las funcionalidades directamente.

Para Laravel 5.x

    'RUT' => Malahierba\ChileRut\Facades\ChileRut::class

Para Laravel 4.2

    'RUT' => 'Malahierba\ChileRut\Facades\ChileRut'

Si no deseas usar un Facade, sino la clase misma, no olvides incorporarlo en la clase donde desees usarlo:

	use Malahierba\ChileRut\ChileRut;

## Utilización

### Validar un rut

Para validar un rut chileno simplemente usas: RUT::check($rut_a_validar). Ej:
```php
    if (RUT::check('12.345.678-9'))
      echo 'es verdadero';
    else
      echo 'es falso';
```
Recuerda que en caso de no usar el Facade, debes usar la clase misma:
```php
    $chilerut = new ChileRut; //o \Malahierba\ChileRut\ChileRut en caso de que no hayas importado la clase

    if ($chilerut::check('12.345.678-9'))
        echo 'es verdadero';
      else
        echo 'es falso';
```
### Validación de RUT con Laravel

Se puede utilizar una validación personalizada, según sea la necesidad:

**Por medio del validador registrado**
```php
$request->validate([
    'rut' => 'required|string|rut',
]);
```
**Por medio de reglas (RUT obligatorio)**
```php
use ManiacPC\ChileRut\Rules\Rut;

$request->validate([
    'rut' => ['required', 'string', new Rut()],
]);
```
**Por medio de reglas (RUT puede ser nulo)**
```php
use ManiacPC\ChileRut\Rules\Rut;

$request->validate([
    'rut' => ['string', (new Rut())->nullable()],
]);
```


> Ref: [Laravel: Custom Validation Rules](https://laravel.com/docs/validation#custom-validation-rules)

### Calcular dígito verificador

En caso de que tengamos un rut sin digito verificador y necesitemos calcularlo, se usa: RUT::digitoVerificador($rut). Ej:
```php
    $digitoVerificador = RUT::digitoVerificador($rut);
```
> OBS: considerando el caso en que el dígito verificador sea 'K', se
> determinó que esta función siempre devuelve un string para ser
> consistentes con su uso y poder realizar comparaciones con mayor
> control.

## Formatos de RUT soportados

Si tenemos un rut de la forma: x.xxx.xxx-x son soportados los siguientes formatos para trabajar con él:
|Formato|Descripción  |
|--|--|
|x.xxx.xxx-z  | con separador de miles y con guión  |
|xxxxxxx-z    | sin separador de miles y con guión  |
|xxxxxxx      | sin separador de miles y sin guión / dígito verificador  |

> Nota: Cualquiera sea el formato podrá comenzar con cero(s). Ej: 0x.xxx.xxx-z está soportado.


## Licencia

Esta librería se distribuye con licencia MIT, favor leer el archivo LICENSE para mayor referencia.
