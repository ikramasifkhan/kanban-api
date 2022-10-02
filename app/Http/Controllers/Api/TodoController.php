<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function getInitialList(){
        try {
            $todos = Todo::where(['status'=>'initial'])->orderBy('sort', 'ASC')->get();
            $data = TodoResource::collection($todos);
            return response()->sendSuccess($data, 'Todo list');
        }catch (\Exception $exception){
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    public function getInProgressList(){
        try {
            $inProgress = Todo::where(['status'=>'in_progress'])->orderBy('sort', 'ASC')->get();
            $data = TodoResource::collection($inProgress);
            return response()->sendSuccess($data, 'Todo in-progress list');
        }catch (\Exception $exception){
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    public function getDoneList(){
        try {
            $doneList = Todo::where(['status'=>'done'])->orderBy('sort', 'ASC')->get();
            $data = TodoResource::collection($doneList);
            return response()->sendSuccess($data, 'Todo done list');
        }catch (\Exception $exception){
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    public function store(TodoRequest $request){
        try {
            $data['sort']= 1;
            $data = $request->validated();

            $todos = Todo::where(['status'=>'initial'])->get();
            if($todos){
                $data['sort']= 1;
                foreach($todos as $todo){
                    $todo->update(['sort'=>$todo->sort+1]);
                }
            }else{
                $data['sort']= 1;
            }

            $todoData = Todo::create($data);
            $todo = new TodoResource($todoData);
            return response()->sendSuccess($todo, 'Todo Created Successfully');
        }catch (\Exception $exception){
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    public function changeStatus(Request $request){
        try {
            $dragInfo = $request->dragInfo;
            $sortingElements = $dragInfo['sortingElements'];
            $status = $dragInfo['status'];
            $element = Todo::findOrFail($dragInfo['elementId']);

            $todos = Todo::select('id', 'sort', 'status')->get();

            foreach($todos as $todo){
                foreach($sortingElements as $element){
                    if($todo->id === $element['id']){
                        $todo->update([
                            'sort'=> $element['sort'],
                            'status'=>$status,
                        ]);
                    }
                }
            };
            return response()->sendSuccess($element, 'Status Changed Successfully');
        }catch (\Exception $exception){
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }
}
