<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project; 
use App\User;
use App\Client;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //案件一覧を取得
        $projects = Project::where('finish_flag', FALSE)->with('client')->orderBy('id','desc')->paginate(20);
        
        
        // 案件一覧ビューでそれを表示
        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $users = User::all();
         $clients = Client::all();
         $project = new Project;

        // メッセージ作成ビューを表示
        return view('projects.create', [
            'project' => $project,
            'users' => $users,
            'clients' => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // 案件を作成
        $project = new Project;
        $project->title = $request->title;
        // 顧客idの案件がいくつあるかカウントし+1する
        $count = Project::where('client_id',$request->client_id)->count() +1;
        $project->code = str_pad($count, 3, '0', STR_PAD_LEFT);
        $project->address = $request->address;
        $project->client_id = $request->client_id;
        $project->personnel = $request->personnel;
        $project->countact = $request->countact;
        $project->user_id = $request->user_id;
        $project->save();

        // 案件一覧へ戻る
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値で案件を検索して取得
        $project = Project::findOrFail($id);
       
        // 案件詳細ビューでそれを表示
        return view('projects.show', [
            'project' => $project,
           
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値で案件を検索して取得
        $project = Project::findOrFail($id);
         $users = User::all();
         $clients = Client::all();

        // 案件編集ビューでそれを表示
        return view('projects.edit', [
            'project' => $project,
            'users' => $users,
            'clients' => $clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idの値で案件を検索して取得
        $project = Project::findOrFail($id);
        // 案件を更新
        $project->title = $request->title;
        $project->code = $request->code;
        $project->address = $request->address;
        $project->client_id = $request->client_id;
        $project->personnel = $request->personnel;
        $project->countact = $request->countact;
        $project->user_id = $request->user_id;
        $project->save();

        // 案件一覧へ戻る
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // idの値でメッセージを検索して取得
        $project = Project::findOrFail($id);
        // メッセージを削除
        $project->delete();

        //  案件一覧へ戻る
        return redirect()->route('projects.index');
    }
     /**
     * プロジェクトを完了にするアクション
     *
     * @param  $id  プロジェクトのid
     * @return \Illuminate\Http\Response
     */
    public function finish(Request $request)
    {
    
        // リクエストからprojectを取得
        $project = Project::findOrFail($request->project_id);

        // 完了フラグの変更
        $project->finish_flag = TRUE;
        $project->save();

        //  案件一覧へ戻る
        return redirect()->route('projects.index');
    }
    
     /**
     * プロジェクトを完了から復元するアクション
     *
     * @param  $id  プロジェクトのid
     * @return \Illuminate\Http\Response
     */
    public function unfinish(Request $request)
    {
    
        // リクエストからprojectを取得
        $project = Project::findOrFail($request->project_id);

        // 完了フラグの変更
        $project->finish_flag = FALSE;
        $project->save();

        //  案件一覧へ戻る
        return redirect()->route('projects.finishIndex');
    }
    
    
    /**
     * 完了したプロジェクトを表示するアクション。
     *
     * @param  $id  プロジェクトのid
     * @return \Illuminate\Http\Response
     */
    public function finishIndex()
    {

        // 完了プロジェクトの一覧を取得
         $projects = Project::where('finish_flag', TRUE)->paginate(20);
         
        // 完了一覧ビューでそれらを表示
        return view('projects.finishIndex', [
            'projects' => $projects,
            
        ]);
    }
}
