<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $key = $request->header('X-API-Key') ?? $request->query('api_key');

        if (! $key) {
            return response()->json(['error' => 'API key required'], 401);
        }

        $apiKey = ApiKey::findActive($key);

        if (! $apiKey) {
            return response()->json(['error' => 'Invalid API key'], 403);
        }

        // Обновляем last_used_at (раз в минуту, чтобы не писать на каждый запрос)
        if (! $apiKey->last_used_at || $apiKey->last_used_at->lt(now()->subMinute())) {
            $apiKey->update(['last_used_at' => now()]);
        }

        // Прокидываем ключ в request — пригодится в контроллере для логирования
        $request->attributes->set('api_key', $apiKey);

        return $next($request);
    }
}
