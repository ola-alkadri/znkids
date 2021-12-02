<?php

namespace App\Http\Controllers;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserController extends Controller
{
    
     public function login (Request $request)
     {
         $credentials = $request->only('email','password');
         $user = Auth::attempt($credentials);
         if($user)
         {
           return response()->json(Auth::user());
         }else{
            return response()->json('unexpected error please try later');
         }

     }
     public function logout (Request $request)
     {
        Auth::logout();
        return response()->json('logout done'); 
     }
     public function register (Request $request)
     {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(80),

        ]);

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->fcm_token = $request->fcm_token;
        $profile->latitude = $request->latitude;
        $profile->longitude = $request->longitude;
        $profile->save();

        return response()->json($user);
     }
     public function getUser()
     {
         return response()->json(User::where('id',Auth::id())->get());
 
     }
     public function updateUser (Request $request, $id)
     {
        $old_user = User::find($id);
        $old_user->name = $request->name;
        $old_user->email = $request->email;
        $old_user->password = $request->password;
        $old_user->save();
        return response()->json($old_user);
     }

     public function getAllUsers(){

      $users = User::with('profile')->get()->except(Auth::id());

      return response()->json($users);

  }

  public function notifyUser($userToken){

      $getTokenOwnerData = Profile::where('fcm_token',$userToken)->with('user')->first();

      $SERVER_API_KEY = 'AAAAMCrY6K8:APA91bERx_XR1lukeLPI0JjNEOJHz74AkayCM-TzB4TN46SLHnIyBjc4Vr7l42vEjrVAKzUsf60gxjo4VLbLBpVmkzy6N8XFUFLuI2tsJwMDCK6N61h2y6pD7jEvQ14Y-gDWw1mlC7kP';

      $data = [

          "registration_ids" => [$userToken],

          "notification" => [

              "title" => "Dear ".$getTokenOwnerData->user->name." Attention",

              "body" => Auth::user()->name." Visited Your Profile",

              // "sound"=>true,

              // 'image' => $request->image_url

          ],

          "data" => [
              'click_action'=> 'FLUTTER_NOTIFICATION_CLICK',
          ],

      ];

      $dataString = json_encode($data);

      $headers = [

          'Authorization: key=' . $SERVER_API_KEY,

          'Content-Type: application/json',

      ];

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

      curl_setopt($ch, CURLOPT_POST, true);

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

      curl_exec($ch);

      return response()->json(1);
  }

}
