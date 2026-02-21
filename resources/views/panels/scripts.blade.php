<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
<!-- select2 Main scripts -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

<!-- for datepicker Main scripts -->
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
{{-- Form Numbers --}}
<script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
{{-- Custom File Input --}}
<script src="{{ asset(mix('vendors/js/jasny/jasny-bootstrap.min.js'))}}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif

<!-- select2 init script -->
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

<!-- datepickers init script -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
<script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
{{-- Form Numbers --}}
<script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>

<script>
    var BASE_URL = "{{ config('app.url') }}";
    var csrf_token = "{{ csrf_token() }}";
</script>

<script src="{{ asset(mix('js/scripts/crud.js')) }}"></script>
<script>
/**
 * WebAuthn Helper Class (Embedded)
 */
class WebAuthn {
    #routes = {
        registerOptions: "webauthn/register/options",
        register: "webauthn/register",
        loginOptions: "webauthn/login/options",
        login: "webauthn/login",
    }
    #headers = {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    };
    #includeCredentials = false
    constructor(routes = {}, headers = {}, includeCredentials = false, xcsrfToken = null) {
        Object.assign(this.#routes, routes);
        Object.assign(this.#headers, headers);
        this.#includeCredentials = includeCredentials;
        let xsrfToken;
        let csrfToken;
        if (xcsrfToken === null) {
            xsrfToken = WebAuthn.#XsrfToken;
            csrfToken = WebAuthn.#firstInputWithCsrfToken;
        } else {
            if (xcsrfToken.length === 40) csrfToken = xcsrfToken;
            else if (xcsrfToken.length === 224) xsrfToken = xcsrfToken;
        }
        if (xsrfToken) this.#headers["X-XSRF-TOKEN"] = xsrfToken;
        else if (csrfToken) this.#headers["X-CSRF-TOKEN"] = csrfToken;
    }
    static get #firstInputWithCsrfToken() {
        let token = Array.from(document.head.getElementsByTagName("meta")).find(el => el.name === "csrf-token");
        if (token) return token.content;
        token = Array.from(document.getElementsByTagName('input')).find(i => i.name === "_token" && i.type === "hidden");
        return token ? token.value : null;
    }
    static get #XsrfToken() {
        const cookie = document.cookie.split(";").find((row) => /^\s*(X-)?[XC]SRF-TOKEN\s*=/.test(row));
        return cookie ? cookie.split("=")[1].trim().replaceAll("%3D", "") : null;
    }
    #fetch(data, route, headers = {}) {
        const url = new URL(route, window.location.origin).href;
        return fetch(url, {
            method: "POST",
            credentials: this.#includeCredentials ? "include" : "same-origin",
            redirect: "error",
            headers: {...this.#headers, ...headers},
            body: JSON.stringify(data)
        });
    }
    static #uint8Array(input, useAtob = false) {
        if (!useAtob) input = input.replace(/-/g, "+").replace(/_/g, "/");
        const pad = input.length % 4;
        if (pad && pad !== 1) input += new Array(5 - pad).join("=");
        return Uint8Array.from(atob(input), c => c.charCodeAt(0));
    }
    static #arrayToBase64String(arrayBuffer) {
        return btoa(String.fromCharCode(...new Uint8Array(arrayBuffer)));
    }
    #parseIncomingServerOptions(publicKey) {
        publicKey.challenge = WebAuthn.#uint8Array(publicKey.challenge);
        if ('user' in publicKey) publicKey.user.id = WebAuthn.#uint8Array(publicKey.user.id);
        ["excludeCredentials", "allowCredentials"].filter(key => key in publicKey).forEach(key => {
            publicKey[key] = publicKey[key].map(data => ({...data, id: WebAuthn.#uint8Array(data.id)}));
        });
        return publicKey;
    }
    #parseOutgoingCredentials(credentials) {
        let parseCredentials = {
            id: credentials.id, type: credentials.type,
            rawId: WebAuthn.#arrayToBase64String(credentials.rawId),
            authenticatorAttachment: credentials.authenticatorAttachment,
            clientExtensionResults: credentials.getClientExtensionResults(),
            response: {},
        };
        ["clientDataJSON", "attestationObject", "authenticatorData", "signature", "userHandle"]
            .filter(key => key in credentials.response)
            .forEach(key => parseCredentials.response[key] = WebAuthn.#arrayToBase64String(credentials.response[key]));
        return parseCredentials;
    }
    static #handleResponse(response) {
        if (!response.ok) throw response;
        return response.json().catch(() => response.body);
    }
    async register(request = {}, response = {}) {
        const optionsRes = await this.#fetch(request, this.#routes.registerOptions);
        const json = await optionsRes.json();
        const publicKey = this.#parseIncomingServerOptions(json);
        const credentials = await navigator.credentials.create({publicKey});
        const publicKeyCredential = this.#parseOutgoingCredentials(credentials);
        Object.assign(publicKeyCredential, response, request);
        return await this.#fetch(publicKeyCredential, this.#routes.register).then(WebAuthn.#handleResponse);
    }
    async login(request = {}, response = {}) {
        const optionsRes = await this.#fetch(request, this.#routes.loginOptions);
        const json = await optionsRes.json();
        const publicKey = this.#parseIncomingServerOptions(json);
        const credentials = await navigator.credentials.get({publicKey});
        const publicKeyCredential = this.#parseOutgoingCredentials(credentials);
        return await this.#fetch(publicKeyCredential, this.#routes.login, response).then(WebAuthn.#handleResponse);
    }
    static supportsWebAuthn() { return typeof PublicKeyCredential != "undefined"; }
    static doesntSupportWebAuthn() { return !this.supportsWebAuthn(); }
}
</script>


<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
@stack('page-script')
<!-- END: Page JS-->