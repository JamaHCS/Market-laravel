<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        $photo = '';

        // dd('hola');
        try {
            $user = Socialite::driver('facebook')->stateless()->user();

            $photo = $user->avatar_original;
            // dd($photo);

            $isUser = User::where('fb_id', $user->id)->first();

            // dd(Socialite::driver('facebook')->randomShit($user->id));
            if ($isUser) {
                Auth::login($isUser);
                return redirect('/dashboard');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'fb_token' => $user->token,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('acceso.jama'),
                    'profile_photo_path' => $photo
                ]);

                Auth::login($createUser);
                return redirect('/dashboard');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


    public function gettingUserProfilePhoto($id)
    {
        return 'https://graph.facebook.com/v3.3/'.$id.'/picture?width=1920';
    }
}
