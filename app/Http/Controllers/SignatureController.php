<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function edit()
    {
        $signature= Signature::first();
//        dd($signature);
        return view('signature.edit', compact('signature'));

    }
    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
        ]);

        // Find the signature
        $signature = Signature::findOrFail($id);

        // Update signature
        $signature->update([
            'name' => $request->name,
            'designation' => $request->designation,
        ]);

        // Redirect back with success message
        return redirect()->route('signature.edit')->with('success', 'Signature updated successfully.');
    }

}
