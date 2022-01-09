<?php

namespace App\App\Providers;

use App\Users\Domain\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        Route::bind('userEmail', function ($param) {
            return User::where('email', $param)->firstOrFail();
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
        $this->mapWebRoutes();
        // $this->mapApiRoutes();

        $this->mapGuestApiRoutes();
        $this->mapAuthApiRoutes();
        $this->mapPublicApiRoutes();
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
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapGuestApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'guest'])
            ->group(base_path('routes/api/guest.php'));
    }

    protected function mapAuthApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api'])
            ->group(base_path('routes/api/auth.php'));
    }

    protected function mapPublicApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api/public.php'));
    }
}
