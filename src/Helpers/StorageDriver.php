<?php


namespace AlMamunDevOps\ShoppingCart\Helpers;


use Illuminate\Support\Facades\Session;


class StorageDriver
{
    protected $driver;
    protected $filePath;
    protected $sessionKey;


    public function __construct(array $config)
    {
        $this->driver = $config['storage'] ?? 'session';
        $this->filePath = $config['file_path'] ?? storage_path('app/shopping_cart.json');
        $this->sessionKey = $config['session_key'] ?? 'shopping_cart';
    }


    public function get()
    {
        if ($this->driver === 'file') {
            if (!file_exists($this->filePath)) {
                return [];
            }
            $contents = file_get_contents($this->filePath);
            return json_decode($contents, true) ?? [];
        }


        return Session::get($this->sessionKey, []);
    }


    public function put($data)
    {
        if ($this->driver === 'file') {
            // ensure directory exists
            $dir = dirname($this->filePath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
        } else {
            Session::put($this->sessionKey, $data);
        }
    }
}