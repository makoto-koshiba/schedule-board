<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Holiday;
use Yasumi\Yasumi;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
            $holidays = Holiday::all()->sortBy("date");
            
            return view('holidays.index',[
                'holidays' => $holidays
                ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $holiday = new holiday;
        
        return view('holidays.create',[
            'holiday' => $holiday
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
        $holiday = new Holiday;
        $holiday->date = $request->date;
        $holiday->content = $request->content;
        $holiday->year = intval(substr($request->date, 0, 4));
        // dd($holiday->year);
        $holiday->bulk_flag = FALSE;
        $holiday->save();
        return redirect()->route('holidays.index');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkStore(Request $request)
    {
        $year = intval($request->year);
        
        $holidays = Holiday::where('year',$year)->where('bulk_flag',true)->get();
        if(count($holidays)>0){
            return redirect()->route('holidays.index')->with('message', 'この年の休日は取得済みです'); 
        }
        
        // 日本の祝日を取得し休日にする
        $yasumis = Yasumi::create('Japan', $year , 'ja_JP');
        foreach( $yasumis as $yasumi){
                $holiday = new Holiday;
                $holiday->date = $yasumi;
                $holiday->content = '祝日';
                $holiday->year = $year;
                $holiday->bulk_flag = TRUE;
                // dd($holiday);
                $holiday->save();
        } 
        
        // 指定した年の元日と末日を設定
        $firstDay = Carbon::createFromDate($year, 1, 1);
        $lastDay = Carbon::createFromDate($year+1, 1, 1);
        
        // 元日が日曜か調べインスタンスを生成
        if ($firstDay->isSunday()){
            $this->save_weekend_day($year, $firstDay->copy()->format('Y-m-d'));
        }else{
            $firstDay = $firstDay->endOfWeek();
            $this->save_weekend_day($year, $firstDay->copy()->format('Y-m-d'));
        //   dd($holiday->date);
        }       
        // 年末まで繰り返す
        while($firstDay->lt($lastDay)){
            $firstDay->addWeek();
            if ($firstDay->gt($lastDay)) {
                break;
             }
            $this->save_weekend_day($year, $firstDay->copy()->format('Y-m-d'));
        }
        
        // dd($holidays = Holiday::where('year',$year)->where('content','公休')->get());
        
         // 第2土曜日を休日にする
         for( $i=1; $i<=12; $i++){
            $firstDay = Carbon::createFromDate($year,$i,1);
               if( $firstDay->isSaturday() ){
                   $this->save_weekend_day($year , $firstDay->addWeek()->copy()->format('Y-m-d'));
               } else {
                   $firstDay = $firstDay->endOfWeek()->subDay(1);
                   $this->save_weekend_day($year , $firstDay->addWeek()->copy()->format('Y-m-d'));
               }
            // 第4土曜日を休日にする
            $saturday4 = $firstDay->addWeek(2)->copy()->format('Y-m-d');
            $this->save_weekend_day($year , $saturday4);
         }
        return redirect()->route('holidays.index');
        
        
        
    }

    private function save_weekend_day($year, $date) {
        $holiday = new Holiday();
        $holiday->date = $date;
        $holiday->content = '公休';
        $holiday->year = $year;
        $holiday->bulk_flag = true;
        return $holiday->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
