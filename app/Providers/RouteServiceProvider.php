<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        //PARA LOS METODOS RESOURCE ESPECIFICAR EL NOMBRE DEL CONTROLADOR
        Route::bind('medico', function($id) {
            return \Hashids::decode($id)[0];
        });
        ///////////////////////////////////////////


        Route::bind('ex_id', function($ex_id, $route)
            {
                return \Hashids::decode($ex_id)[0];
            });

        Route::bind('app_id', function($app_id, $route)
            {
                return \Hashids::decode($app_id)[0];
            });

            Route::bind('id', function($id, $route)
                {
                    return \Hashids::decode($id)[0];
                });

            Route::bind('m_id', function($m_id, $route)
                {
                    return \Hashids::decode($m_id)[0];
                });

            Route::bind('p_id', function($p_id, $route)
                {
                    return \Hashids::decode($p_id)[0];
                });

            Route::bind('P_id', function($P_id, $route)
                {
                    return \Hashids::decode($P_id)[0];
                });

            Route::bind('n_id', function($n_id, $route)
                {
                    return \Hashids::decode($n_id)[0];
                });



        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
