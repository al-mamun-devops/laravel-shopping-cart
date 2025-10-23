<?php

return [
    // 'session' or 'file'
    'storage' => env('SHOPPINGCART_STORAGE', 'session'),


    // used when 'file' driver is selected. You can change path if you want per app.
    'file_path' => storage_path('app/shopping_cart.json'),


    // key for session
    'session_key' => 'shopping_cart',
];