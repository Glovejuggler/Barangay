<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Resident;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\RegisterResidentRequest;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Residents/Index', [
            'residents' => Resident::query()
                                        ->filter($request->only(['search', 'status']))
                                        ->paginate(10)
                                        ->withQueryString(),
            'barangays' => Barangay::all(),
            'filters' => $request->only(['search', 'status'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Residents/Register', [
            'barangays' => Barangay::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResidentRequest $request)
    {
        Resident::create($request->validated());

        return redirect()->back();
    }

    /**
     * Stores a non-verified resident
     */
    public function register(RegisterResidentRequest $request)
    {
        Resident::create($request->validated());

        return redirect()->back();
    }

    /**
     * Verify a resident
     */
    public function verify(Resident $resident)
    {
        $resident->update([
            'verified' => true,
            'resident_number' => Resident::verified()->orderBy('resident_number', 'desc')->first()?->resident_number + 1
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident)
    {
        // dd($request, $resident);
        $resident->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'barangay_id' => $request->barangay_id,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resident $resident)
    {
        // dd($resident);
        $resident->delete();

        return redirect()->back();
    }

    /**
     * Returns the PDf
     */
    public function pdf(Resident $resident)
    {
        $pdf = Pdf::loadView('pdf.resident', [
            'resident' => $resident
        ]);

        return $pdf->stream();
    }
}
