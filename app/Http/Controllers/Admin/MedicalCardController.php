<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\MedicalCard;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MedicalCardController extends Controller
{
    public function edit(User $client, MedicalCard $medicalCard)
    {
        return view('admin.pages.clients.medical-card', [
            'client' => $client,
            'medicalCard' => $medicalCard
        ]);
    }

    public function update(Request $request, MedicalCard $medicalCard): RedirectResponse
    {
        $medicalCard->update($request->all());

        return redirect()->back();
    }
}
