<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'address'=> $request->user()->address ?? [],
            ],
            'flash' => [
                'view' => $request->session()->get('view'), // dowiedz się po co w sumie jest ten callback??
                'payment' => fn () => $request->session()->get('payment'),
            ],
            'category' => $request->category
            
        ];
    }
}
