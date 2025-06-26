<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default session "driver" that will be utilized
    | by Lumen. By default, we support a variety of drivers. Of course, you
    | may specify your own custom drivers.
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that the session should be
    | allowed to remain idle before it expires. If you want them to
    | expire immediately when the browser is closed, set the "expire_on_close"
    | option to true.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session
    | data should be encrypted before being stored. All encryption
    | will be performed automatically by Lumen and all you need
    | to do is set this option to true.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | When using the "file" session driver, we need a location where files
    | should be stored. A default has been provided at the storage directory.
    | You are free to change this to any directory you wish.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    |
    | When using the "database" or "redis" session drivers, you may specify a
    | connection that should be used to store your sessions. When this
    | option is null, the default database connection will be used.
    |
    */

    'connection' => env('SESSION_CONNECTION', null),

    /*
    |--------------------------------------------------------------------------
    | Session Table
    |--------------------------------------------------------------------------
    |
    | When using the "database" session driver, you may specify the table
    | that should be used to store your sessions. Of course, a sensible
    | default has been set for you, but you are free to change this.
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | When using the "apc" or "memcached" session drivers, you may specify a
    | cache store that should be used for these sessions. This provides
    | more flexibility for applications which use multiple cache drivers.
    |
    */

    'store' => env('SESSION_STORE', null),

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Some session drivers must manually sweep their expired sessions.
    | These are the chances (in percentage) for the sweep to happen
    | on any given request. By default, the session should be cleaned
    | up 2% of the time, so you may adjust the values as needed.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Here you may change the name of the cookie used to maintain your
    | session ID. The name specified here will get used every time a
    | new session cookie is created by the framework for every driver.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        // Use a fallback for str_slug if not available
        env('APP_NAME', 'lumen') ? strtolower(preg_replace('/[^a-z0-9]+/i', '_', env('APP_NAME', 'lumen'))) . '_session' : 'lumen_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application but you are free to change this when necessary.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | Here you may change the domain of the cookie used to identify a session
    | in your application. This will most likely be set to null since
    | a sensible default is provided by the framework to just work.
    |
    */

    'domain' => env('SESSION_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | By default, Lumen will only send session cookies over HTTPS when
    | the `secure` option is set to true. This will prevent the cookie from
    | being sent over unencrypted connections and will improve security.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | HTTP Only Cookies
    |--------------------------------------------------------------------------
    |
    | By default, Lumen will set the "HTTPOnly" flag on the session
    | cookie. This flag will prevent JavaScript from accessing the cookie
    | value and will reduce the risk of cross-site scripting attacks.
    |
    */

    'httponly' => true,

    /*
    |--------------------------------------------------------------------------
    | Same-Site Session Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | are made. "Lax" is a sensible default and offers good protection while
    | still allowing your UI to be driven from third-party links.
    |
    | Supported: "lax", "strict", "none"
    |
    */

    'samesite' => 'lax',
];