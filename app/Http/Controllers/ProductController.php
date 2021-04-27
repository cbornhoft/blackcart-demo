<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Product[]
     */
    public function index(int|string $storeId): array|Collection
    {
        return Product::where(['store_id' => $storeId])->get(['id', 'name', 'prices', 'inventory', 'variations', 'weight']);
    }
}
