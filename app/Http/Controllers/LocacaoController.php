<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Http\Requests\StoreLocacaoRequest;
use App\Http\Requests\UpdateLocacaoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class LocacaoController extends Controller
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
    public function store(StoreLocacaoRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Locacao $locacao): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locacao $locacao): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocacaoRequest $request, Locacao $locacao): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locacao $locacao): RedirectResponse
    {
        //
    }
}
