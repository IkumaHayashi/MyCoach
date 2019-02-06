<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Training;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }


    public function store(Request $request){
        Log::debug('---FacoritesController@store---');
        Log::debug($request);
        //モデルを作成

        $favorite = Favorite::where('training_id', $request->training_id)
                            ->where('user_id', Auth::user()->id)
                            ->first();
        if($favorite !== null)
        {
            return response()->json([
                        'message' => 'already exists'
                    ]);
        }

        $favorite = new Favorite;
        $favorite->training_id = $request->training_id;
        $favorite->user_id = $request->user()->id;
        $favorite->save();
        return response()->json([
                    'message' => 'success!'
                ]);

    }


    public function delete(Request $request){

        Log::debug('---FacoritesController@delete---');
        Log::debug($request);
        Log::debug(Auth::user()->id);
        try{
            $favorite = Favorite::where([['training_id', $request->training_id], ['user_id', Auth::user()->id]])
                    ->first();
            Log::debug($favorite);
            $favorite->delete();
        }catch(\Exception $e){

            return response()->json([
                'message' => 'error!'
            ]);
        }
        return response()->json([
                    'message' => 'success!'
                ]);
    }

    public function show($training_id){

        Log::debug('---FacoritesController@show---');
        $user_id = Auth::user()->id;
        $response_value;

        if(!Auth::guest()){
            Log::debug('$training_id = '.$training_id.' $user_id = '.$user_id);
            $favorite = Favorite::where([['training_id',$training_id], ['user_id', $user_id]])
                                  ->first();
            $sql = Favorite::where([['training_id',$training_id], ['user_id', $user_id]])
                    ->toSql();
            Log::debug($sql);

            if(is_null($favorite))
            {
                $response_value = false;
            }else{
                $response_value = true;
            }


        }else{
            $response_value= null;
        }

        return response()->json([
            'isFavorite' => $response_value
        ]);
    }


}
