<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\AiFeedback;
use GuzzleHttp\Client;

class AiFeedbackController extends Controller
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
    public function index(Request $request)
    {
        $week = $request->input('week');
        $summary = null;
        $feedbacks = null;

        if($week) {

            //週の開始日と終了日を算出
            [$year, $weekNumber] = explode('-W', $week);
            $startDate = now()->setISODate($year, $weekNumber)->startOfWeek();
            $endDate = (clone $startDate)->endOfWeek();

            //対象期間の習慣データの集計
            $weeklyData = Log::with('habit')
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get()
            ->groupBy('habit_id')
            ->map(function($logs) {
                return[
                    'habit' => $logs->first()->habit->name ?? '不明',
                    'total_sessions' => $logs->count(),
                    'total_duration' => $logs->sum('duration'), // 分単位
                    'avg_concentration' => round($logs->avg('concentration'), 1),
                    'avg_satisfaction' => round($logs->avg('satisfaction'), 1),
                ];
            });

            //プロンプト作成
            $promptText = "以下は1週間の習慣記録データです：\n";
            foreach ($weeklyData as $data) {
                $promptText .= "{$data['habit']}：実施回数 {$data['total_sessions']}回、合計時間 {$data['total_duration']}分、集中度平均 {$data['avg_concentration']}、満足度平均 {$data['avg_satisfaction']}\n";
            }
            $promptText .= "\nこのデータを基に、1. 今週の要約  2. 改善提案 を日本語で作成してください。";

            // OpenAI API呼び出し
            $client = new Client();

            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4o-mini', // ご利用モデルに応じて変更可
                    'messages' => [
                        ['role' => 'system', 'content' => 'あなたは習慣改善アドバイザーです。'],
                        ['role' => 'user', 'content' => $promptText],
                    ],
                    'temperature' => 0.7,
                ],
            ]);

            $body = json_decode((string)$response->getBody(), true);
            $aiText = $body['choices'][0]['message']['content'] ?? '';


            // シンプルに分割（"改善提案"キーワードで分ける例）
            if (str_contains($aiText, '改善提案')) {
                [$summary, $feedbacks] = explode('改善提案', $aiText, 2);
                $feedbacks = '改善提案' . $feedbacks;
            } else {
                $summary = $aiText;
            }
        }
        return view('gpt.summary', compact('summary', 'feedbacks', 'week'));
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
        $data = $request->validate([
            'week' => 'required|string',
            'summary' => 'nullable|string',
            'feedbacks' => 'nullable|string',
        ]);

        AiFeedback::create([
            'user_id' => auth()->id(),
            'week' => $data['week'],
            'summary' => $data['summary'],
            'feedbacks' => $data['feedbacks'],
        ]);

        return redirect()->route('user.aifeedback.index')
            ->with('success', 'AIフィードバックを保存しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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