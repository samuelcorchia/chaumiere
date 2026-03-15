<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Models\Quota;
use App\Models\Table;

class QuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page      = 'quotas';
        $quota     = Quota::all()->first();
        $iNbTables = Table::where('active', true)->count();

        return view('admin.quotas', compact('page', 'quota', 'iNbTables'));
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
    public function store(StoreQuotaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quota $quota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quota $quota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuotaRequest $request, Quota $quota)
    {
        $request->validate(['nb' => 'required|integer|min:0']);

        $quota = Quota::first();
        if ($quota) {
            $quota->update(['nb' => $request->nb]);
        } else {
            Quota::create(['nb' => $request->nb]);
        }
        return response()->json(['success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quota $quota)
    {
        //
    }
}
