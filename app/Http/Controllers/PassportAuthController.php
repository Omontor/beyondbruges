<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use App\Models\CouponRedeem;
use App\Models\Coupon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use OneSignal;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;


        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    } 


        public function store(Request $request)
    {

        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 400); //Unprocessable Data
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        QrCode::generate(env('APP_URL').'/admin/qr-codes/create/'.$user->id, storage_path('app/public/qrcodes/'.$user->id.'.svg'));
        QrCode::format('svg');
        QrCode::size(512);


        // email data
        $email_data = array(
            'name' => $user->name,
            'email' => $user->email,
            'password' => $request->password,
            'id' => $user->id,
        );

        // send email with the template
        Mail::send('emails.welcome', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Welcome to Beyond Bruges')
                ->from('noreply@beyondbruges.be', 'Beyond Bruges App');
        });
        return response()->json($user);
    }  

        public function udid(Request $request)
    {
        $user = User::find($request->id);

        if ($request->udid){
            $user->udid = $request->udid;
        }
        $user->save();
        return $user;
    }

    public function makepurchase(Request $request){

        $user = User::find($request->id);
        $user->purchased = 1;
        $user->save();
        $purchase = new Purchase;
        $purchase->user_id = $user->id;
        $purchase->platform = $request->platform;
        $purchase->save();
        return $user;

    }

    public function usercoupons(Request $request) {

        $user = User::find($request->id);
        $coupons = CouponRedeem::where('user_id', $user->id)->get();
        return response()->json(['data' => $coupons], 200);

    }

        public function list () {

        $coupons = Coupon::all();
        return response()->json(['data' => $coupons], 200);
    }

}