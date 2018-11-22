<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        if (!session ()->has ('locale')) {
//            session (['locale' => $request->getPreferredLanguage (config ('app.locales'))]);
//        }
//        $locale = session ('locale');
//        app ()->setLocale ($locale);
//        setlocale (LC_TIME, app()->environment('local') ? $locale : config('locale.languages')[$locale][1]);

        if ( \Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));

            // You also can set the Carbon locale
            Carbon::setLocale(\Session::get('locale'));
        }
        return $next ($request);

    }
}
