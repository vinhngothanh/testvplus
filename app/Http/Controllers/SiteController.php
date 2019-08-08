<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mtlog201712;

class SiteController extends Controller
{

    public function coban1()
    {
        $item = Mtlog201712::orderBy('id','desc')->offset(0)->limit(1000)->get();
        return view('coban1',[
            'item'=>$item
        ]);

    }

    public function coban2(Request $request)
    {
        // đếm tổng giao dịch
        $count = Mtlog201712::count();
        // đếm tổng tiền
        $totalMoney = Mtlog201712::sum('money');
        // giới hạn item 1 trang
        $limit = 100;

        $data = $request->all();
        $page = isset($data['page'])?$data['page']:1;
        $dates = isset($data['dates'])?$data['dates']:'';

        $query = Mtlog201712::orderBy('id','desc');
        if($dates != ''){
            $date = explode('-', $dates);
            if(isset($date[0]) && isset($date[1])){
            $query = $query->whereBetween('loggingTime', [date('Y-m-d 00:00:00', strtotime(trim($date[0]))), date('Y-m-d 23:59:59', strtotime(trim($date[1])))]);
            }
        }
        $countFilter = (clone $query)->count();

        $query = $query->paginate($limit);
        $pagination = $query->appends($data)->render();

        return view('coban2',[
            'item'=>$query,
            'data'=>$data,
            'page'=>$page,
            'dates'=>$dates,
            'count'=>$count,
            'totalMoney'=>$totalMoney,
            'pagination'=>$pagination,
            'countFilter'=>$countFilter,
        ]);
    }
}
