<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Quota;
use App\Models\Reservation;
use App\Models\Concert;

class AdminController extends Controller
{
    // ---------------------------------------------------------------------------
    // Gestion des concerts
    // ---------------------------------------------------------------------------
    public function concerts($dateGet = null)
    {
        $page = 'concerts';

        $concerts = Concert::all();
        /*empty($dateGet) ? 
            Concert::whereDate('reserved_at', today())->orderBy('reserved_at', 'asc')->get() : 
            Concert::whereDate('reserved_at', $dateGet)->orderBy('reserved_at', 'asc')->get();
        */
        return view('admin.concerts', compact('page', 'concerts'));
    }

    // ---------------------------------------------------------------------------
    // Ajout concert
    // ---------------------------------------------------------------------------
    public function storeConcert(Request $request)
    {
        try {
            // 1. Validation : on s'assure que les noms correspondent à ce que le JS envoie
            $validated = $request->validate([
                'name_event' => 'required|string|max:255',
                'date_event' => 'required|date',
                'link_event' => 'required|string|max:255',
                'type_event' => 'required|string|max:255',
            ]);

            // 2. Création de l'objet et mapping colonnes
            $concert             = new Concert();
            $concert->name_event = $validated['name_event'];
            $concert->date_event = $validated['date_event'] . ' 21:00:00';
            $concert->link_event = $validated['link_event'];
            $concert->type_event = $validated['type_event'];
            $concert->save();

            return response()->json([
                'success' => true,
                'message' => 'Concert enregistrée !',
                'id'      => $concert->id
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
    // Annuler un concert
    // ---------------------------------------------------------------------------
    public function cancelConcert($id)
    {
        try {
            $table = Concert::findOrFail($id); // Trouve ou génère une erreur 404
            $table->active = false;
            $table->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // ---------------------------------------------------------------------------
    // Confirmer un concert
    // ---------------------------------------------------------------------------
    public function confirmConcert($id)
    {
        try {
            $table = Concert::findOrFail($id); // Trouve ou génère une erreur 404
            $table->active = true;
            $table->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ---------------------------------------------------------------------------
    // Gestion des reservations
    // ---------------------------------------------------------------------------
    public function reservations($dateGet = null)
    {
        $page = 'reservations';

        // TYPES
        $enumsStatus     = ['pending', 'confirmed'];
        $enumsSources    = ['phone', 'web'];
        // RESERVATIONS CONFIRMEES
        $reservations['confirmed'] = empty($dateGet) ? 
            Reservation::where('status', 'confirmed')->whereDate('reserved_at', today())->orderBy('reserved_at', 'asc')->get() : 
            Reservation::where('status', 'confirmed')->whereDate('reserved_at', $dateGet)->orderBy('reserved_at', 'asc')->get();
        // RESERVATIONS A VALIDER
        $reservations['pending'] = Reservation::where('status', 'pending')->orderBy('reserved_at', 'asc')->get();
        
        $reservations['all'] = $reservations['confirmed']->merge($reservations['pending']);

        // STATS
        $stats['total']  = 0;
        foreach($enumsStatus as $status) {
            $stats[$status] = empty($dateGet) ? 
                Reservation::where('status', $status)->whereDate('reserved_at', today())->count() : 
                Reservation::where('status', $status)->whereDate('reserved_at', $dateGet)->count();
        }
        foreach($enumsSources as $sources) {
            $stats[$sources] = empty($dateGet) ? 
                Reservation::where('source', $sources)
                            ->where('status', 'confirmed')
                            ->whereDate('reserved_at', today())
                            ->count() : 
                Reservation::where('source', $sources)
                            ->where('status', 'confirmed')
                            ->whereDate('reserved_at', $dateGet)
                            ->count();
            $stats['total'] += $stats[$sources];
        }            
        
        $oQuota          = Quota::all()->first();
        $allTables       = Table::where('active', true)
                                ->orderBy('name')->get();

        return view('admin.reservations', compact('reservations', 'stats', 'dateGet', 'page', 'oQuota', 'allTables'));
    }

    // ---------------------------------------------------------------------------
    // Ajout reservation manuelle
    // ---------------------------------------------------------------------------
    public function storePhoneReservation(Request $request)
    {
        try {
            // 1. Validation : on s'assure que les noms correspondent à ce que le JS envoie
            $validated = $request->validate([
                'name'   => 'required|string|max:255',
                'date'   => 'required|date',
                'heure'  => 'required|string',
                'nb'     => 'required|integer|min:1',
                'tel'    => 'nullable|string',
                'emp'    => 'nullable|string', // Non présent en DB, mais utile pour la logique
                'rq'     => 'nullable|string',
                'tables' => 'nullable|array'
            ]);

            // 2. Création de l'objet et mapping colonnes
            $reservation              = new Reservation();
            $reservation->nom         = $validated['name'];
            $reservation->reserved_at = $validated['date'] . ' ' . $validated['heure'] . ':00';
            $reservation->guest_count = $validated['nb'];
            $reservation->phone       = $validated['tel'];
            $reservation->mail        = $request->mail ?? null;
            $reservation->remarque    = $validated['rq'];
            $reservation->tables_id   = !empty($request->tables) ? implode(',', $request->tables) : null;
            $reservation->status      = 'confirmed';
            $reservation->source      = 'phone';
            $reservation->dateresa    = $validated['date']; 
            $reservation->heure       = $validated['heure'];
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Réservation enregistrée !',
                'id'      => $reservation->id
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
    // Ajout resrevation online
    // ---------------------------------------------------------------------------
    public function storeWebReservation(Request $request)
    {
        try {
            // 1. Validation : on s'assure que les noms correspondent à ce que le JS envoie
            $validated = $request->validate([
                'name'   => 'required|string|max:255',
                'date'   => 'required|date',
                'heure'  => 'required|string',
                'nb'     => 'required|integer|min:1',
                'tel'    => 'nullable|string',
                'emp'    => 'nullable|string', // Non présent en DB, mais utile pour la logique
                'rq'     => 'nullable|string',
                'tables' => 'nullable|array'
            ]);

            // 2. Création de l'objet et mapping des colonnes
            $reservation = new Reservation();
            $reservation->nom         = $validated['name'];
            $reservation->reserved_at = $validated['date'] . ' ' . $validated['heure'] . ':00';
            $reservation->guest_count = $validated['nb'];
            $reservation->phone       = $validated['tel'];
            $reservation->mail        = $request->mail ?? null;
            $reservation->remarque    = $validated['rq'];
            $reservation->tables_id   = !empty($request->tables) ? implode(',', $request->tables) : null;
            $reservation->status      = 'confirmed';
            $reservation->source      = 'web';
            $reservation->dateresa     = $validated['date']; 
            $reservation->heure        = $validated['heure'];
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Réservation enregistrée !',
                'id'      => $reservation->id
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
    // Gestion des tables
    // ---------------------------------------------------------------------------
    public function tables()
    {
        $page        = 'tables';
        $aTablesList = $allTables = Table::where('active', true)
            ->orderBy('name')->get();
            
        $nb          = $aTablesList->count();
        $sum         = $aTablesList->sum('capacity');
        return view('admin.tables', compact('page', 'aTablesList', 'allTables', 'nb', 'sum'));
    }

    // ---------------------------------------------------------------------------
    // Ajout d'une table
    // ---------------------------------------------------------------------------
    public function storeTable(Request $request)
    {
        $table = Table::create([
            'name' => $request->name, 
            'capacity' => $request->capacity
        ]);
        
        return response()->json([
            'success' => true, 
            'table' => $table
        ]);
    }

    // ---------------------------------------------------------------------------
    // Desactivation d'une table
    // ---------------------------------------------------------------------------
    public function desactiveTable($id)
    {
        try {
            $table = Table::findOrFail($id); // Trouve ou génère une erreur 404
            $table->active = false;
            $table->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Renvoie l'erreur SQL réelle pour comprendre le blocage
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ---------------------------------------------------------------------------
    // Annuler une reservation
    // ---------------------------------------------------------------------------
    public function cancelReservation($id)
    {
        try {
            $table = Reservation::findOrFail($id); // Trouve ou génère une erreur 404
            $table->status = 'cancelled';
            $table->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Renvoie l'erreur SQL réelle pour comprendre le blocage
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // ---------------------------------------------------------------------------
    // Confirmer une reservation
    // ---------------------------------------------------------------------------
    public function confirmReservation($id)
    {
        try {
            $table = Reservation::findOrFail($id); // Trouve ou génère une erreur 404
            $table->status = 'confirmed';
            $table->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Renvoie l'erreur SQL réelle pour comprendre le blocage
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // ---------------------------------------------------------------------------
    // Gestion quotas
    // ---------------------------------------------------------------------------
    public function quotas()
    {
        $page      = 'quotas';
        $quota     = Quota::all()->first();
        $iNbTables = Table::where('active', true)->count();

        return view('admin.quotas', compact('page', 'quota', 'iNbTables'));
    }

    // ---------------------------------------------------------------------------
    // Modification quotas
    // ---------------------------------------------------------------------------
    public function updateQuota($nb)
    {
        Quota::first()->update(['nb' => $nb]); 
        
        return response()->json(['success' => true]);
    }
}
