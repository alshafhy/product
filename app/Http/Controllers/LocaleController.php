<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        // Validate
        abort_if(! in_array($locale, ['ar', 'en']), 404);

        // Derive direction
        $direction = $locale === 'ar' ? 'rtl' : 'ltr';

        // Persist in session
        session([
            'locale'    => $locale,
            'direction' => $direction,
        ]);

        return redirect()->back()->withHeaders([
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }
}
