<?php

namespace App\Http\Middleware;

use App\Data\RoleData;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Role;
use Tightenco\Ziggy\Ziggy;

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
    public function version(Request $request): ?string
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
                'user' => $request->user()?->load(['roles', 'media'])->getData(),
            ],
            'roles' => RoleData::collection(Role::all()),
            'site' => config('app.url'),
            'messages' => flash()->render([], 'array'),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
