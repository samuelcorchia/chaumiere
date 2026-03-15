<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->active = false;
        $table->save(); 
        
        return response()->json(['success' => true, 'table' => $id]);
    }
}
