<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\Quota;

class ReservationController extends Controller
{
    // ---------------------------------------------------------------------------
    // Gestion des reservations
    // ---------------------------------------------------------------------------
    public function list($dateGet = null)
    {
        $page = 'reservations';

        // TYPES
        $enumsStatus     = ['pending', 'confirmed'];
        $enumsSources    = ['phone', 'web'];
        
        // RESERVATIONS CONFIRMEES
        $reservations['confirmed'] = empty($dateGet) ? Reservation::where('status', 'confirmed')->whereDate('reserved_at', today())->orderBy('reserved_at', 'asc')->get() : Reservation::where('status', 'confirmed')->whereDate('reserved_at', $dateGet)->orderBy('reserved_at', 'asc')->get();
        
        // RESERVATIONS A VALIDER
        $reservations['pending'] = Reservation::where('status', 'pending')->orderBy('reserved_at', 'asc')->get();
        
        $reservations['all'] = $reservations['confirmed']->merge($reservations['pending']);

        // STATISTIQUES
        $stats['total']  = 0;
        // PAR STATUT
        foreach($enumsStatus as $status) {
            $stats[$status] = empty($dateGet) ? 
                Reservation::where('status', $status)->whereDate('reserved_at', today())->count() : 
                Reservation::where('status', $status)->whereDate('reserved_at', $dateGet)->count();
        }
        // PAR SOURCES
        foreach($enumsSources as $sources) {
            $stats[$sources] = empty($dateGet) ? Reservation::where('source', $sources)->where('status', 'confirmed')->whereDate('reserved_at', today())->count() : Reservation::where('source', $sources)->where('status', 'confirmed')->whereDate('reserved_at', $dateGet)->count();
            $stats['total'] += $stats[$sources];
        }            
        
        $oQuota          = Quota::all()->first();
        $allTables       = Table::where('active', true)->orderBy('name')->get();

        return view('admin.reservations', compact('reservations', 'stats', 'dateGet', 'page', 'oQuota', 'allTables'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reservations', [
            'page' => 'reservations',
            'headerbg' => "/images/bg/03.jpg"
        ]);
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
    public function store(StoreReservationRequest $request)
    {
        $mode = !empty($request->id) ? 'update' : 'create';
        try {
            // 1. Validation : on s'assure que les noms correspondent à ce que le JS envoie
            $validated = $request->validate([
                'name'   => 'required|string|max:255',
                'date'   => 'required|date',
                'heure'  => 'required|string',
                'nb'     => 'required|integer|min:1',
                'tel'    => 'nullable|string',
                'email'   => 'nullable|string',
                'emp'    => 'nullable|string', // Non présent en DB, mais utile pour la logique
                'rq'     => 'nullable|string',
                'source' => 'required|string'
            ]);

            // 2. Création de l'objet et mapping colonnes
            $reservation              = $mode === 'update' ? Reservation::findOrFail($request->id) : new Reservation();
            $reservation->nom         = $validated['name'];
            $reservation->reserved_at = $validated['date'] . ' ' . $validated['heure'] . ':00';
            $reservation->guest_count = $validated['nb'];
            $reservation->phone       = $validated['tel'];
            $reservation->mail        = $request->mail ?? null;
            $reservation->remarque    = $validated['rq'];
            $reservation->status      = $mode === 'create' 
                ? ($validated['source'] === 'phone' ? 'confirmed' : 'pending') 
                : $reservation->status;
            $reservation->source      = $validated['source'];
            $reservation->dateresa    = $validated['date']; 
            $reservation->heure       = $validated['heure'];
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => !empty($request->id) ? 'Reservation modifié' : 'Reservation enregistré',
                'table'      => $reservation
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error("Erreur résa : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Erreur SQL : " . $e->getMessage()
            ], 500);
        }
    }

    // ---------------------------------------------------------------------------
    // Modifier statut d'une une reservation
    // ---------------------------------------------------------------------------
    public function updateReservationStatus(UpdateReservationRequest $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'action' => 'required|string'
        ]);
        try {
            $table = Reservation::findOrFail($request->id);
            $table->status = $validated["action"] === 'cancel' ? 'cancelled' : 'confirmed';
            $table->save();
            return response()->json(['success' => true, 'table' => $table]);
        } catch (\Exception $e) {
            // Renvoie l'erreur SQL réelle pour comprendre le blocage
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
