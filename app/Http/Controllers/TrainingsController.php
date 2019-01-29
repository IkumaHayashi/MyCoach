<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
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

    public function show($trainingId){
        $training = Training::find($trainingId);

        Log::debug($training);

        return view('trainings/show', [
            'training' => $training
        ]);
    }

    public function edit($trainingId){
        $training = Training::find($trainingId);
        return view('trainings/edit', [
            'training' => $training
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
        $training->update();
        return redirect('/');
    }

    public function create(){
        $tags = Tag::all();
        $training = Training::find(1);
        return view('trainings/new',[
            'training' => $training
            , 'tags' => $tags
        ]);
    }
    public function add(Request $request){
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
        return redirect('/');

    }

    public function delete(Training $training){
        $training->delete();
        return redirect('/');
    }


}
