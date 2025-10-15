<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Description;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request, $descriptionId)
    {
        $description = Description::findOrFail($descriptionId);

        $validated = $request->validate([
            'cep' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'number' => 'nullable|integer',
            'district' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
        ]);

        $address = $description->address()->create($validated);

        return response()->json($address, 201);
    }

    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'cep' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'number' => 'nullable|integer',
            'district' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
        ]);

        $address->update($validated);

        return response()->json($address, 200);
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return response()->json(null, 204);
    }
}
