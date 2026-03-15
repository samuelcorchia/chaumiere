<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page        = 'tables';
        $aTablesList = Table::where('active', true)->orderBy('name')->get();

        return view('admin.tables', compact('page', 'aTablesList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        // valider les données
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer'
        ]);
        $table = Table::create([
            'name' => $request->name, 
            'capacity' => $request->capacity
        ]);

        return response()->json(['success' => true, 'table' => $table], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $table = Table::findOrFail($id);
        $table->active = false;
        $table->save(); 
        
        return response()->json(['success' => true, 'table' => $table]);
    }
}
