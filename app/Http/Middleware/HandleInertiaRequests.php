<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Role;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = auth()->user();

        return array_merge(parent::share($request), [
            'user' => $user,
            'error' => fn () => $request->session()->get('error'),
            'success' => fn () => $request->session()->get('success'),
            'can' => fn () => [
                'users' => [
                    'viewAny' => $user?->can('viewAny', User::class),
                    'create' => $user?->can('create', User::class),
                    'update' => $user?->can('update', User::class),
                    'delete' => $user?->can('delete', User::class),
                ],
                'roles' => [
                    'viewAny' => $user?->can('viewAny', Role::class),
                    'create' => $user?->can('create', Role::class),
                    'update' => $user?->can('update', Role::class),
                    'delete' => $user?->can('delete', Role::class),
                ],
            ],
        ]);
    }
}
