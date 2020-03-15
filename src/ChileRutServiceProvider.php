<?php
namespace ManiacPC\ChileRut;

use Illuminate\Support\ServiceProvider;
use ManiacPC\ChileRut\Validators\RutValidator;
use Validator;
use ReflectionClass;

class ChileRutServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('libchilerut', function(){
            return new ChileRut;
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerValidator();

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/chileRut'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'chileRut');
    }

    /**
     * Register the "rut" validator.
     */
    protected function registerValidator()
    {
        $this->app->validator->resolver(function($translator, $data, $rules, $messages) {
            return new RutValidator($translator, $data, $rules, $messages);
        });
    }

}
