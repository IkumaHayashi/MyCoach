<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use App\Models\Tag;
use Validator;

class TrainingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        $trainings = Training::orderBy('created_at', 'asc')->get();
        return view('trainings/trainings',[
            'trainings' => $trainings
        ]);
    }


    public function manage(){

        $user = Auth::user();

        $trainings = Training::where('user_id', $user->id)
                            ->orderBy('created_at', 'asc')->get();

        return view('trainings/manage',[
            'trainings' => $trainings
        ]);
    }

    public function show($trainingId){
        $training = Training::find($trainingId);

        if(!Auth::guest()){
            $favorite = $training->favorites()->where('user_id', Auth::user()->id)->first();
            Log::debug($favorite);
        }else{
            $favorite = null;
        }

        return view('trainings/show', [
            'training' => $training
            , 'favorite' => $favorite
        ]);
    }

    public function edit($trainingId){
        Log::debug('TrainingController edit');
        $training = Training::find($trainingId);
        Log::debug($training);
        foreach ($training->tags as $tag) {
            Log::debug($tag->id);
        }
        $tags = Tag::all();
        return view('trainings/edit', [
            'training' => $training
            , 'tags' => $tags
        ]);
    }

    public function update(Request $request){

        $training = Training::find($request->id);

        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|min:1',
            'duration_minutes' => 'required|max:120|min:1',
            'recomended_person_number' => 'required||min:1',
            'video_url' => 'required||url',
        ]);
        //バリデーション： エラー
        if ($validator->fails()) {
            return redirect('/trainings/new')
            ->withInput()
            ->withErrors($validator);
        }

        //Eloquentモデル
        $training->title = $request->title;
        $training->duration_minutes = $request->duration_minutes;
        $training->recomended_person_number = $request->recomended_person_number;
        $training->video_url = $request->video_url;
        $training->tags()->sync(request()->tags, false);
        $training->update();
        return redirect(action('TrainingsController@manage'));
    }

    public function create(Request $request){

        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|min:1'
        ]);

        Log::debug("TrainingsController Create");
        Log::debug($request);
        //バリデーション： エラー
        if ($validator->fails()) {
            return redirect('/trainings/manage')
            ->withInput()
            ->withErrors($validator);
        }


        //モデルを作成
        $training = new Training;
        $training->title = $request->title;
        $training->user_id = $request->user()->id;
        $training->save();

        return redirect()->route('trainings.edit', ['id'=>$training->id]);

    }

    /*
    public function create(){
        $tags = Tag::all();
        $training = Training::find(1);
        return view('trainings/new',[
            'training' => $training
            , 'tags' => $tags
        ]);
    }
    */

    public function store(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|min:1',
            'duration_minutes' => 'required|max:120|min:1',
            'recomended_person_number' => 'required||min:1',
            'video_url' => 'required||url',
        ]);

        //バリデーション： エラー
        if ($validator->fails()) {
            return redirect('/trainings/new')
            ->withInput()
            ->withErrors($validator);
        }

        //モデルを作成
        $training = new Training;
        $training->title = $request->title;
        $training->duration_minutes = $request->duration_minutes;
        $training->recomended_person_number = $request->recomended_person_number;
        $training->video_url = $request->video_url;
        $training->user_id = $request->user()->id;
        $training->save();

        $training->tags()->attach(request()->tags);

        $training->save();
        return redirect(action('TrainingsController@manage'));

    }

    public function delete(Training $training){
        $training->delete();
        return redirect(action('TrainingsController@manage'));
    }


}
