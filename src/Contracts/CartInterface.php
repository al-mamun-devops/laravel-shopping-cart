<?php


namespace AlMamunDevOps\ShoppingCart\Contracts;

interface CartInterface
{
    public function add($id, $name, $price, $quantity = 1, array $attributes = []);
    public function update($id, $quantity);
    public function remove($id);
    public function clear();
    public function all();
    public function total();
    public function count();
}