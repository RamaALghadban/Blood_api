<?php

namespace App\Http\Controllers;
use App\Models\donate_schedual;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonateSchedualController extends Controller
{
    public function __construct() {
        $this->middleware('blood_compare')->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all Donat Schedual
        $donate_scheduals = donate_schedual::with('user','BloodType')->get();
        return response()->json([
        "message" => "fetch data dom",
        "data" => $donate_scheduals,
        ], Response::HTTP_ACCEPTED);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store new record in database
        $request->validate([
            "user_id"=>"required|exists:users,id",
            "amount" =>"required|min:1|integer",
            "blood_type_id"=>"required|exists:blood_types,id",
            "verified"=>"nullable",
        ]);

        $donate_scheduals = donate_schedual::create([
            "user_id"=> $request->user_id,
            "amount"=> $request->amount,
            "blood_type_id"=> $request->blood_type_id,
            "verified"=> false,
        ]);

        return response()->json([
            "message" => "created succfully",
            "data" => $donate_scheduals,
            ], Response::HTTP_ACCEPTED);
    


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\donate_schedual  $donate_schedual
     * @return \Illuminate\Http\Response
     */
    public function show( $scedual_id)
    {
        // data for record in database
        $scedual= donate_schedual::where('id','=',$scedual_id)->with('user','BloodType')->get();
        return response()->json([
            "message" => "Featch data succfully",
            "data" => $scedual,
            ], Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\donate_schedual  $donate_schedual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $donate_schedual)
    {
        //update record 
        $request->validate([
            "amount" =>"required|min:1|integer",
        ]);

         donate_schedual::where('id','=',$donate_schedual)->with('user','BloodType')->update(
            [
                "amount"=>$request->amount
            ]);
        
            return response()->json([
                "message" => " Data Update succfully",
                ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\donate_schedual  $donate_schedual
     * @return \Illuminate\Http\Response
     */
    public function destroy( $donate_schedual)
    {
        // delet record 
        donate_schedual::where('id','=',$donate_schedual)->delete();
    }
}
