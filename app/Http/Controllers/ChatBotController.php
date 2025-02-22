<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{

    protected OpenAIService $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function chat(Request $request): JsonResponse
    {
        $message = $request->input('message');
        $response = $this->openAIService->chat($message);
        $assistantResponse = $response['choices'][0]['message']['content'] ?? 'Ошибка получения ответа';

        return response()->json(['response' => $assistantResponse]);
    }


    public function chat1(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Получаем контекст из базы данных
//        $programs = DB::table('programmes')->select('title', 'description', 'requirements')->get();
//        $programsContext = $programs->map(function($program) {
//            return [
//                'title' => $program->title,
//                'description' => $program->description,
////                'requirements' => $program->requirements,
//            ];
//        })->toJson();

        // Формируем системный промпт
//        $systemPrompt = "Ты - помощник по программам DAAD. Используй следующую информацию о программах для ответов: " . $programsContext;
        $systemPrompt = "Ты - помощник по программам DAAD. Используй информацию в сайте DAAD о программах";

        try {
            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $request->message],
                ],
                'temperature' => 0.7,
            ]);

            $response = $result->choices[0]->message->content;

            // Сохраняем историю чата
            ChatHistory::create([
                'user_message' => $request->message,
                'bot_response' => $response,
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => $response,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обработке запроса: ' . $e->getMessage(),
            ], 500);
        }
    }
}
