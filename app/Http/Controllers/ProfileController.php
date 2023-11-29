<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('photo')){
            // $file = $request->photo->extension();
            $types= $request->photo->extension();
             $name = (string)auth()->user()->id.'.'.$types;
          //  $name =(string) $request->photo->getClientOriginalName();
        $user = User::find(auth()->user()->id);
        
        if ($request->user()->photo != 'avatar.png' ){
            Storage::disk('public')->delete($request->user()->photo);
        }

            $path = $request->file('photo')->storeAs(
                'users-images',
                $name,
                // (string)$user->id,
                'public'
            );

            // $request->user()->update(['photo' =>$path]);
            // // dd($request->user());
            // $request->user()->save();//sd
            // $user->photo = $path ?? 'avatar.png';
            // $user->save();
            // $reques->user()->photo= $path ?? 'avater.png';
            // $request->user()->save();
            // //dd((string) $user->id);
             // dd($name);
            //  dd(session('name'));

        }
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->photo = $path ?? "avatar.png"; // brezee da path shu yerga qo'yiladi
        $request->user()->save();
        //dd($request->user());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
