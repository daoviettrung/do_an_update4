<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Report;

class ReportController extends Controller{
    public function viewReport(){
        $report=Report::all();
        return view('dashboard.pages.admin.report.view',['report'=>$report]);
    }
    public function viewPost($id)
    {
        $post_id = explode("_", $id);
        $j = 0;
        $id_cmt=[];
        for($i=1;$i<= count($post_id);$i++){
            $id_cmt[$j]=$post_id[$i];
            $j+=1;
        }
        var_dump($id_cmt);
    }
}
