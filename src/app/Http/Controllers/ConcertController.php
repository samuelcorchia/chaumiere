<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class ConcertController extends Controller
{
    // ---------------------------------------------------------------------------
    // Gestion des concerts
    // ---------------------------------------------------------------------------
    public function list($dateGet = null)
    {
        $page = 'concerts';

        $concerts = Concert::all();

        return view('admin.concerts', compact('page', 'concerts'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerts = Concert::where('active', true)->orderBy('date_event', 'asc')->get();

        return view('concerts', [
            'page' => 'concerts',
            'headerbg' => "/images/bg/06.jpg", 
            'concerts' => $concerts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mode = !empty($request->id_event) ? 'update' : 'create';
        try {
            // 1. Validation : on s'assure que les noms correspondent à ce que le JS envoie
            $validated = $request->validate([
                'name_event' => 'required|string|max:255',
                'date_event' => 'required|date',
                'link_event' => 'required|string|max:255',
                'type_event' => 'required|string|max:255',
            ]);

            // 2. Création de l'objet et mapping colonnes
            $concert             = $mode === 'update' ? Concert::findOrFail($request->id_event) : new Concert();
            $concert->name_event = $validated['name_event'];
            $concert->date_event = $validated['date_event'] . ' 21:00:00';
            $concert->link_event = $validated['link_event'];
            $concert->type_event = $validated['type_event'];
            $concert->active     = $mode === 'create' ? false : $concert->active;
            $concert->save();

            return response()->json([
                'success' => true,
                'message' => !empty($request->id) ? 'Concert modifié' : 'Concert enregistré',
                'table'      => $concert
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error("Erreur : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Erreur SQL : " . $e->getMessage()
            ], 500);
        }
    }

    // ---------------------------------------------------------------------------
    // Modifier statut d'un concert
    // ---------------------------------------------------------------------------
    public function updateConcertStatus(Request $request)
    {
        $validated = $request->validate([
            'id'     => 'required|integer',
            'action' => 'required|string|max:255'
        ]);
        try {
            $table = Concert::findOrFail($validated['id']);
            $table->active = $validated['action'] === 'confirm' ? true : false;
            $table->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
    
                ], 500);
        }
    }
}
