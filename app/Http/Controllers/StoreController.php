<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Store[]|Collection
     */
    public function index(): array|Collection
    {
        return Store::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Store
     */
    public function store(Request $request): Store
    {
        $request->validate(
            [
                'platform' => 'required'
            ]
        );

        return Store::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     *
     * @return Store
     */
    public function show(int|string $id): array|Store
    {
        return Store::find($id) ?? [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request    $request
     * @param int|string $id
     *
     * @return Store
     */
    public function update(Request $request, int|string $id): Store
    {
        $store = Store::find($id);
        $store->update($request->all());

        return $store;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     *
     * @return int
     */
    public function destroy(int|string $id): int
    {
        return Store::destroy($id);
    }
}
