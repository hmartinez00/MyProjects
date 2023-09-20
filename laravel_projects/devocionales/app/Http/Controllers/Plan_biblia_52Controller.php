<?php

namespace App\Http\Controllers;

use App\Models\Plan_biblia_52;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use TelegramBot\Api\BotApi;

class Plan_biblia_52Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $plan_biblia_52s = Plan_biblia_52::all();
        $headers = Schema::getColumnListing('plan_biblia_52s');
        $indices = range(0, 5);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view('plan_biblia_52.index', compact('plan_biblia_52s', 's_headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $headers = Schema::getColumnListing('plan_biblia_52s');
        $text_index = [2, 3, 4, 5];
        $datetime_local_index = [1, 6, 7];
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view('plan_biblia_52.create', compact('headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Plan_biblia_52::create($request->all());
        return redirect()->route('plan_biblia_52.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan_biblia_52 $plan_biblia_52): View
    {
        $headers = Schema::getColumnListing('plan_biblia_52s');
        return view('plan_biblia_52.show', compact('plan_biblia_52', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_biblia_52 $plan_biblia_52): View
    {
        $headers = Schema::getColumnListing('plan_biblia_52s');
        $text_index = [2, 3, 4, 5];
        $datetime_local_index = [1, 6, 7];
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view('plan_biblia_52.edit', compact('plan_biblia_52', 'headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_biblia_52 $plan_biblia_52): RedirectResponse
    {
        $plan_biblia_52->update($request->all());
        return redirect()->route('plan_biblia_52.show', $plan_biblia_52->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_biblia_52 $plan_biblia_52): RedirectResponse
    {
        $plan_biblia_52->delete();
        return redirect()->route('plan_biblia_52.index');
    }


    public function sendTelegramMessage(Plan_biblia_52 $plan_biblia_52): RedirectResponse
    {

        $telegram = new BotApi("5522228971:AAE0YIZt7yCH7rhXXQEuRVsh1VsoF8I-vDA");
        $chatId = "1580008489";
        
        $text_0 = '(' . $plan_biblia_52->id . ') ' .
        'Lectura del ' . $plan_biblia_52->fecha . ": " .
        $plan_biblia_52->lectura;

        $text_1 = $text_0 . "\n\n" .
        'Bosquejo - ' . $plan_biblia_52->titulo . "\n" .
        'Conteste las siguientes preguntas:

1. Cuantos capítulos tiene el libro?
2. En cuantas partes se divide el libro y cuales son?
3. De qué trata cada parte del libro mostrada en el video?
4. Enumere 3 enseñanzas correspondientes a cada una de las partes del libro mostradas en el video.' . "\n\n" .
        $plan_biblia_52->intro;//'Hola desde Laravel!';

        $text_2 = '(' . $plan_biblia_52->id . ') ' .
        'Trivia Biblica:

Instrucciones:
        
1. Una vez entre al link contara con 30min para responder a las preguntas.
2. Si culmina antes del tiempo presiones enviar. Sus resultados apareceran en un recuadro en la parte superior de la pagina.
3. Si el tiempo se agota la pagina se congelará y sus resultados apareceran en un recuadro en la parte superior de la pagina.
4. En cualquiera de ambos casos, al finalizar, tome un screenshot de sus resultados y envielas al grupo.
        
Que el Espíritu Santo le guíe a toda verdad.
        
' . $plan_biblia_52->encuesta;

        if ($plan_biblia_52->titulo != ''){
            $text = $text_1;
        } else {
            $text = $text_0;
        }

        $telegram->sendMessage(
            $chatId,
            $text,
        );

        if ($plan_biblia_52->encuesta != ''){
            $telegram->sendMessage(
                $chatId,
                $text_2,
            );
        }

        return redirect()->route('plan_biblia_52.index');
    }

}
