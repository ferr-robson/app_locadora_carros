<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarroRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Carro $carro): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carro $carro): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarroRequest $request, Carro $carro): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carro $carro): RedirectResponse
    {
        //
    }
}
