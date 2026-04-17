<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        if (!in_array($locale, config('app.available_locales', ['ar', 'en']))) {
            abort(400);
        }

        session(['locale' => $locale]);

        return redirect()->back();
    }
}
