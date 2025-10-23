# 🛒 Laravel Shopping Cart

A lightweight and reusable **shopping cart package** for **Laravel 12+**, designed for developers who want to add cart functionality without needing a database. This package uses **Session** or **File Storage** for managing cart data.

---

## 🚀 Features

- ✅ Works with **Laravel 12+**  
- 🧠 No database required  
- 🗃️ Storage options: **Session** or **File system**  
- 🔧 Simple API for adding, updating, removing, and clearing items  
- 💰 Automatic cart total and item count calculation  
- 📦 Easy to install and integrate into any Laravel project

---

## 📦 Installation

### 1. Add the package via Composer (local or from GitHub)


```bash
composer require al-mamun-devops/laravel-shopping-cart
```

### 2. Publish configuration file

```bash
php artisan vendor:publish --tag=config --provider="AlMamunDevOps\ShoppingCart\ShoppingCartServiceProvider"
```

This will publish `config/shoppingcart.php` where you can choose storage type:

```php
return [
    'storage' => env('SHOPPINGCART_STORAGE', 'session'), // or 'file'
    'file_path' => storage_path('app/shopping_cart.json'),
];
```

---

## ⚙️ Configuration

You can choose between **Session** and **File Storage**:

| Option | Description |
|--------|-------------|
| `session` | Stores cart data in the Laravel session. Default option. |
| `file` | Persists cart data in a JSON file under `storage/app/shopping_cart.json`. |

Set your preferred option in the `.env` file:

```env
SHOPPINGCART_STORAGE=session
```

---

## 🧰 Usage

Use the Cart Facade to manage cart operations:

```php
use Cart;

// Add products
Cart::add(1, 'Laptop', 1000, 2);
Cart::add(2, 'Mouse', 300, 1);

// Update quantity
Cart::update(1, 5);

// Remove item
Cart::remove(2);

// Get all items
$items = Cart::all();

// Get total amount
$total = Cart::total();

// Get total count
$count = Cart::count();

// Clear cart
Cart::clear();
```

---

## 🧩 Example Controller

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        return response()->json(Cart::all());
    }

    public function add(Request $request)
    {
        Cart::add(
            $request->id,
            $request->name,
            $request->price,
            $request->quantity
        );

        return response()->json(['message' => 'Item added successfully']);
    }

    public function clear()
    {
        Cart::clear();
        return response()->json(['message' => 'Cart cleared']);
    }
}
```

---

## 🧱 Folder Structure

```
packages/
└── al-mamun-devops/
    └── laravel-shopping-cart/
        ├── composer.json
        ├── src/
        │   ├── ShoppingCartServiceProvider.php
        │   ├── Facades/
        │   │   └── Cart.php
        │   ├── Services/
        │   │   └── CartManager.php
        │   └── Helpers/
        │       └── StorageDriver.php
        ├── config/
        │   └── shoppingcart.php
        └── README.md
```

---

## 🧠 Methods Summary

| Method | Description |
|--------|-------------|
| `add($id, $name, $price, $quantity = 1, $attributes = [])` | Add an item to the cart |
| `update($id, $quantity)` | Update the quantity of an item |
| `remove($id)` | Remove an item from the cart |
| `clear()` | Clear all items from the cart |
| `all()` | Retrieve all cart items |
| `total()` | Calculate total price |
| `count()` | Count total number of items |

---

## 🧑‍💻 Development Setup

If you are developing this package locally within a Laravel app:

1. Place the package inside `packages/al-mamun-devops/laravel-shopping-cart`
2. Add this to your main app’s `composer.json`:

```json
"repositories": [
    {
        "type": "path",
        "url": "packages/al-mamun-devops/laravel-shopping-cart"
    }
]
```

3. Run:
```bash
composer require al-mamun-devops/laravel-shopping-cart:dev-main
```

4. Test it in your app!

---

## 🪪 License

This package is open-sourced software licensed under the **MIT license**.

---

## 👨‍💻 Author

**Md Al Mamun**  
[GitHub: al-mamun-devops](https://github.com/al-mamun-devops)

---

## 💡 Contributing

Pull requests are welcome! If you’d like to enhance the package (e.g. add Redis, Cookie storage, or tests), feel free to open an issue or PR.

---

### ⭐ Star the Repo
If you find this package helpful, please give it a ⭐ on GitHub to support future development!

