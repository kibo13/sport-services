<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Place;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Group\GroupRepositoryInterface;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(ActivityRepositoryInterface $activityRepository, GroupRepositoryInterface $groupRepository)
    {
        $user = auth()->user();
        $isTrainer = $user->role_id == Role::INSTRUCTOR;
        $activities = $activityRepository->getAll();

        if ($isTrainer) {
            $groups = $groupRepository->getGroupsByTrainer($user->id);
        } else {
            $groups = $groupRepository->getAll();
        }

        return view('admin.pages.groups.index', [
            'activities' => $activities,
            'groups' => $groups,
        ]);
    }

    public function create(ActivityRepositoryInterface $activityRepository, TrainerRepositoryInterface $trainerRepository)
    {
        $activities = $activityRepository->getAll();
        $trainers = $trainerRepository->getAll();

        return view('admin.pages.groups.form', [
            'activities' => $activities,
            'trainers' => $trainers,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Group::query()->create($request->all());

        return redirect()
            ->route('groups.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Group $group, ActivityRepositoryInterface $activityRepository, TrainerRepositoryInterface $trainerRepository)
    {
        $activities = $activityRepository->getAll();
        $trainers = $trainerRepository->getAll();

        return view('admin.pages.groups.form', [
            'group' => $group,
            'activities' => $activities,
            'trainers' => $trainers,
        ]);
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        $group->update($request->all());

        return redirect()
            ->route('groups.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()
            ->route('groups.index')
            ->with('success', __('_record.deleted'));
    }

    public function bindPlace(Request $request): RedirectResponse
    {
        $place = Place::query()->find($request['place_id']);
        $place->update([
            'client_id' => $request['client_id'],
            'is_busy' => true
        ]);

        return redirect()->route('groups.index');
    }

    public function unbindPlace(Request $request): RedirectResponse
    {
        $place = Place::query()->find($request['place_id']);
        $place->update([
            'client_id' => null,
            'is_busy' => false
        ]);

        return redirect()->route('groups.index');
    }
}
