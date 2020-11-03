<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Application;

class LocalizationLanguage
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $this->app->config->get('app.locale');
        $newLocale = str_replace('_', '-', $locale);
        $lang = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));
        if ($lang[0] == $newLocale) {
            $this->app->setLocale($locale);
        } else {
            $this->app->setLocale('en');
        }
        return $next($request);
    }
}
