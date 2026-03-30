<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
  
        //Force HTTPS
        if (str_contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        //Route sildebar
        Blade::directive('sidebarActive', function ($menu) {
            return "<?php
                \$__active = false;

                \$check = function(\$item) use (&\$check, &\$__active) {
                    if (isset(\$item['route']) && request()->is(\$item['route'])) {
                        \$__active = true;
                    }

                    if (isset(\$item['submenu'])) {
                        foreach (\$item['submenu'] as \$sub) {
                            \$check(\$sub);
                        }
                    }

                    if (isset(\$item['child'])) {
                        foreach (\$item['child'] as \$child) {
                            \$check(\$child);
                        }
                    }
                };

                \$check($menu);
            ?>";
        });

        //Gerbang untuk super admin
        Gate::define('kelola-database-utama', function ($user) {
            return $user->otoritas === 'su';
        });

        //gerbang untuk admin
        Gate::define('kelola-database', function ($user) {
            return in_array($user->otoritas, ['su', 'admin']);
        });

    }
}
