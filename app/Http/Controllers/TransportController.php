<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Requests\TransportRequest;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transports = Transport::all();
        return view('pages.transport.index', compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.transport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportRequest $request)
    {
        Transport::create($request->validated());
            return to_route('transports.index')->with('success', 'Your <strong>Transport</strong> Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        // ! to fix
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        return view('pages.transport.edit', compact('transport'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportRequest $request, Transport $transport)
    {
        $transport->fill($request->validated());
        if ($transport->isDirty()) {
            $transport->save();
            return to_route('transports.index')->with('success', 'Your <strong>Transport</strong> Updated Successfully');
        } else {
            return to_route('transports.index')->with('warning', 'No changes were made to the Transport');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();
        return to_route('transports.index')->with('success', 'Your <strong>Transport</strong> Deleted Successfully');
    }
}
