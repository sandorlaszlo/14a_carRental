<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use DateTime;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Rental::all();
        return Rental::with('car')->get();
    }

    public function rentalsByDate($date)
    {
        // $date = DateTime::createFromFormat('Y.m.d', $date);
        // return $date;
        return Rental::with('car')
            ->where('fromDate', '=', $date)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = DateTime::createFromFormat('Y.m.d', $request->fromDate);
        $today = new DateTime();
        if ($date < $today)
        {
            return response()->json(['message' => 'Hibás dátum.'], 422);
        }
        $rental = Rental::create($request->all());
        return response($rental, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        return $rental;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
         $rental->update($request->all());
         return response($rental);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $rental->delete();
        return response()->noContent();
    }
}
