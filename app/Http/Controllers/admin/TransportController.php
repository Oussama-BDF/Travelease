<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transports = Transport::all();
        return view('pages.admin.transport.index', compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.transport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Transport::create($request->validate([
            'name' => 'required|max:20',
        ]));
        return to_route('admin.transports.index')->with('success', 'Your <strong>Transport</strong> Added Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $transport_uuid)
    {
        $transport = Transport::where('uuid', $transport_uuid)->firstOrFail();

        $transport->fill($request->validate([
            'name' => 'required|max:20',
        ]));
        if ($transport->isDirty()) {
            $transport->save();
            return to_route('admin.transports.index')->with('success', 'Your <strong>Transport</strong> Updated Successfully');
        } else {
            return to_route('admin.transports.index')->with('warning', 'No changes were made to the Transport');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($transport_uuid)
    {
        $transport = Transport::where('uuid', $transport_uuid)->firstOrFail();

        $transport->delete();
        return to_route('admin.transports.index')->with('success', 'Your <strong>Transport</strong> Deleted Successfully');
    }
}
