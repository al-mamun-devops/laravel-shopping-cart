<?php
if ($quantity <= 0) {
unset($cart[$key]);
} else {
$cart[$key]['quantity'] = (int) $quantity;
}
$this->storage->put($cart);
}


return $cart;
}


public function remove($idOrKey)
{
$cart = $this->storage->get();
$key = $this->resolveKey($idOrKey, $cart);


if ($key && isset($cart[$key])) {
unset($cart[$key]);
$this->storage->put($cart);
}


return $cart;
}


public function clear()
{
$this->storage->put([]);
}


public function all()
{
return $this->storage->get();
}


public function total()
{
$cart = $this->storage->get();
return collect($cart)->reduce(function ($carry, $item) {
return $carry + ($item['price'] * $item['quantity']);
}, 0);
}


public function count()
{
$cart = $this->storage->get();
return collect($cart)->sum('quantity');
}


protected function makeKey($id, $attributes)
{
if (empty($attributes)) {
return (string) $id;
}


ksort($attributes);
return $id . ':' . md5(json_encode($attributes));
}


protected function resolveKey($idOrKey, $cart)
{
// If a direct key exists, return it
if (isset($cart[$idOrKey])) {
return $idOrKey;
}


// Otherwise try to find by item id
foreach ($cart as $key => $item) {
if ((string)$item['id'] === (string)$idOrKey) {
return $key;
}
}


return null;
}
}