<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AiFeedback;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use PDF; //facade

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = AiFeedback::where('user_id', Auth::id())->orderBy('week_start_date', 'desc')->get();
        //habits = Habit::where('user_id', Auth::id())->get();
        return view('report.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = auth()->id();

        $feedback = AiFeedback::where('user_id', $userId)
            ->findOrFail($id);

         // logsを該当週の期間で絞る
        $startDate = Carbon::parse($feedback->week_start_date);
        $endDate = $startDate->copy()->addDays(6);

        $logs = Log::where('user_id', $userId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get();

        return view('report.preview', compact('feedback', 'logs'));
        
        
        // $feedback = AiFeedback::with('user')->findOrFail($id);
        // // PDF生成処理もここで行うか、別メソッドを作ってもOK
        // return view('report.preview', compact('feedback'));
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

    //PDF出力用メソッド（exportPdf）
    public function exportPdf($id)
    {

        $feedback = AiFeedback::findOrFail($id);

        $weekStartDate = Carbon::parse($feedback->week_start_date);
        $weekEndDate = $weekStartDate->copy()->addDays(6)->endOfDay();

        $logs = Log::whereBetween('start_time', [$weekStartDate, $weekEndDate])->get();

        // BladeでPDF生成
        $pdf = PDF::loadView('report.preview', compact('feedback', 'logs'))
            ->setPaper('a4')
            ->setOption('defaultFont', 'ipaexg');  // フォント名は適宜
        return $pdf->stream('report.pdf');

        // return view('report.preview', compact('feedback', 'logs'));
        return $pdf->download('report_' . $weekStartDate->format('Ymd') . 'pdf');
    }
}
