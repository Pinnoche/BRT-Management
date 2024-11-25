<?php

namespace App\Http\Controllers;

use App\Models\Brt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrtController extends Controller
{
    protected function generateBrtCode(): string
    {
        return 'BRT-' . Str::uuid();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reserved_amount' => 'required|numeric|min:0',
        ]);
        $brt = Brt::create([
            'user_id' => auth()->id(),
            'brt_code' => $this->generateBrtCode(),
            'reserved_amount' => $validated['reserved_amount'],
            'status' => 'active',
        ]);

        return response()->json(['message' => 'BRT created successfully', 'data' => $brt], 201);
    }

    public function index()
    {
        $userId = auth()->id();
        $brts = Brt::where('user_id', $userId)->get();

        return response()->json(['Your Brts data' => $brts], 200);

    }

    public function show(Brt $brt)
    {
        return response()->json(['BRTs:' => $brt], 200);
    }

    public function edit(Brt $brt)
    {
        return response()->json(['BRTs:' => $brt], 200);
    }

    public function update(Brt $brt, Request $request)
    {
        $brt->update([
            'reserved_amount' => $request->reserved_amount,
        ]);

        return response()->json([
            'message' => 'Your Brt has been updated successfully',
            'BRT:' => $brt
        ], 200);
    }

    public function destroy(Request $request, Brt $brt)
    {
        $brt->delete();

        return response()->json([
            'message' => 'This Brt has been deleted successfully'
        ], 200);

    }
}
