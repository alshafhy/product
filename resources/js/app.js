import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

/**
 * Apply stored locale/direction immediately on page load
 * to prevent flash of wrong direction before session loads.
 * Reads from <html> tag attributes set by Blade/middleware.
 */
(function () {
    const html = document.documentElement;
    const dir  = html.getAttribute('dir') || 'rtl';
    const lang = html.getAttribute('lang') || 'ar';

    // Ensure class matches dir attribute
    html.classList.remove('rtl', 'ltr');
    html.classList.add(dir);

    // Store in localStorage as fast fallback
    localStorage.setItem('cashpos_dir',  dir);
    localStorage.setItem('cashpos_lang', lang);
})();
