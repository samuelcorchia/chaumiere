<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
}
