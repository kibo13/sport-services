<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.pages.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user): RedirectResponse
    {
        $userData = $request->validated();

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        $user->update($userData);

        return redirect()
            ->route('profile.index')
            ->with('success', __('_record.updated'));
    }

    public function updatePhoto(Request $request): JsonResponse
    {
        $photo = $request->file('photo');

        if ($photo) {
            $user = auth()->user();

            $this->deletePreviousPhoto($user);

            $path = $this->storePhoto($photo);

            $this->updateUserPhoto($user, $path);

            return response()->json(['photo' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'Файл не найден'], 400);
    }

    private function deletePreviousPhoto(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
    }

    private function storePhoto($file)
    {
        return $file->store('profile', 'public');
    }

    private function updateUserPhoto(User $user, $path)
    {
        $user->update(['photo' => $path]);
    }
}
