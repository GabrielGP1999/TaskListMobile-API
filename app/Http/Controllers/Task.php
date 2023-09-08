<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Controller
{
    public function saveTask(Request $request) {
        $data = $request->all();
        $results = DB::select('select * from task_users where user_id = :id', ['id' => $data['userID']]);
        if($results) {
            DB::update('update task_users set resource = ? where user_id = ?', [json_encode($data['taskItems']) , $data['userID']]);
        }else {
            DB::insert('insert into task_users (user_id, resource, created_at, updated_at) values (?, ?, ?, ?)', [$data['userID'], json_encode($data['taskItems']), now(), now()]);
        }

        return response("Tarefas do dia salvas !", 200);
    }

    public function getTasks(Request $request) {
        $data = $request->all();
        $results = DB::select('select * from task_users where user_id = :id', ['id' => $data['userID']]);

        return response([
            'tasks' => $results[0]->resource
        ]);
    }

}
