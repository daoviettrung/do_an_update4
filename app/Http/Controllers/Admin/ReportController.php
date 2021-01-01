<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller{
    public function viewReport(){
        $report=Report::all();
        return view('dashboard.pages.admin.report.view',['report'=>$report]);
    }
    public function viewPost($id)
    {
        $i=0;
        $id_cmt_cut=[];
        $id_cmt=explode("_",$id);
        unset($id_cmt[0]);
        foreach ($id_cmt as $ic){
            $id_cmt_cut[$i]=$ic;
            $i+=1;
        }
        $id_cmt_cut=implode("_",$id_cmt_cut);
        var_dump($id_cmt_cut);
    }
    public function getMonth(Request $request){
        $report=Report::select('tbl_report.*')
            ->whereMonth('created_at','=',$request->month)
            ->whereDay('created_at','=',$request->day)
            ->get();
        return view('dashboard.pages.admin.report.view',['report'=>$report]);
    }
}
