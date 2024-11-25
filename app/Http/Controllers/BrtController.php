<?php

namespace App\Http\Controllers;

use App\Models\Brt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



class BrtController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $brts = Brt::where('user_id', $userId)->get();

        return response()->json(['data' => $brts], 200);

    }
    //   Generating a universal unique code for Brts
    protected function generateBrtCode(): string
    {
        return 'BRT-' . Str::uuid();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reserved_amount' => 'required|numeric|min:0',
        ]);

        $brt = auth()->user()->brts()->create([
            'brt_code' => $this->generateBrtCode(),
            'reserved_amount' => $validated['reserved_amount'],
            'status' => 'active'
        ]);

        return response()->json(['message' => 'BRT created successfully', 'data' => $brt], 201);
    }

    public function show(Brt $brt)
    {
        return response()->json(['data' => $brt], 200);
    }

    public function edit(Brt $brt)
    {
        return response()->json(['data' => $brt], 200);
    }

    public function update(Brt $brt, Request $request)
    {
        $brt->update([
            'reserved_amount' => $request->reserved_amount,
        ]);

        return response()->json([
            'message' => 'Your BRT has been updated successfully',
            'data' => $brt
        ], 200);
    }

    public function destroy(Brt $brt)
    {
        $brt->delete();

        return response()->json([
            'message' => 'This BRT has been deleted successfully'
        ], 200);

    }
}
