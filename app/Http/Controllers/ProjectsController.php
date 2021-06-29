<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project; 

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
        $projects = Project::all();

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
         $project = new Project;

        // メッセージ作成ビューを表示
        return view('projects.create', [
            'project' => $project,
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
        $project->content = $request->content;
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

        // 案件編集ビューでそれを表示
        return view('projects.edit', [
            'project' => $project,
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
        $project->content = $request->content;
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
}
