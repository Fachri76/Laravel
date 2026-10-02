<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $sortDirection =
            $request->input('sort') === 'oldest'
                ? 'asc'
                : 'desc';

        $activities = Activity::query()
            ->with('category')
            ->search($request->input('search'))
            ->filterCategory($request->input('category_id'))
            ->filterStatus($request->input('status'))
            ->orderBy('start_at', $sortDirection)
            ->paginate(10)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view(
            'activities.index',
            compact(
                'activities',
                'categories'
            )
        );
    }

    public function create(): View
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view(
            'activities.create',
            compact('categories')
        );
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ): RedirectResponse {
        $activity = $service->create(
            $request->validated()
        );

        return to_route(
            'activities.show',
            $activity
        )->with(
            'success',
            'Activity berhasil dibuat.'
        );
    }

    public function show(Activity $activity): View
    {
        $activity->load([
            'category',
            'registrations',
        ]);

        return view(
            'activities.show',
            compact('activity')
        );
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view(
            'activities.edit',
            compact(
                'activity',
                'categories'
            )
        );
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        $service->update(
            $activity,
            $request->validated()
        );

        return to_route(
            'activities.show',
            $activity
        )->with(
            'success',
            'Activity berhasil diperbarui.'
        );
    }

    public function destroy(
        Activity $activity
    ): RedirectResponse {
        $activity->delete();

        return to_route(
            'activities.index'
        )->with(
            'success',
            'Activity berhasil dihapus.'
        );
    }

    public function publish(
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        $service->publish($activity);

        return back()->with(
            'success',
            'Activity berhasil dipublikasikan.'
        );
    }

    public function complete(
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        $service->complete($activity);

        return back()->with(
            'success',
            'Activity berhasil diselesaikan.'
        );
    }

    public function trash(): View
    {
        $activities = Activity::onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->paginate(10);

        return view(
            'activities.trash',
            compact('activities')
        );
    }

    public function restore(int $id): RedirectResponse
    {
        $activity = Activity::onlyTrashed()
            ->findOrFail($id);

        $activity->restore();

        return to_route(
            'activities.trash'
        )->with(
            'success',
            'Activity berhasil direstore.'
        );
    }
}