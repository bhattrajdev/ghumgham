<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PhaseType;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
use App\Traits\DatatableTrait;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    use StatusTrait, DatatableTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::select(['id', 'title', 'address', 'phase', 'status'])->get();

            $actionButtons = function ($row) {
                return [
                    "view" => '<a href="#" class="btn btn-sm btn-default" title="View" data-bs-toggle="modal" data-bs-target="#viewModel" data-show-id="' . $row->id . '"><i class="bx bx-show-alt"></i></a> ',
                    "delete" => false,
                ];
            };

            $additionalColumns = [
                'image' => function ($row) {
                    return view('components.form.table_image', [
                        'url' => $row->feature_image->getPath(),
                    ])->render();
                },
                'phase' => function ($row) {
                    $status = $row->phase;
                    $class = '';
                    switch ($status) {
                        case 'pending':
                            $class = 'bg-label-secondary';
                            break;
                        case 'accepted':
                            $class = 'bg-label-success';
                            break;
                        case 'rejected':
                            $class = 'bg-label-danger';
                            break;
                        default:
                            $class = 'bg-label-secondary';
                            break;
                    }
                    return '<span class="badge ' . $class . '">' . ucfirst($status) . '</span>';
                },
            ];

            return $this->getDataTable($request, $data, $additionalColumns, ['image', 'phase'], true, null, $actionButtons);
        }
        return view('admin.location.index', [
            'columns' => ['image', 'title', 'address', 'phase'],
        ]);
    }

    public function create()
    {
        return view('admin.location.create');
    }

    public function store(LocationRequest $request)
    {
        DB::beginTransaction();
        $location = $request->safe()->except('image', 'cover');
        $location = Location::create($location);
        if ($request->hasFile('image')) {
            $location->storeFeatureImage($location->title, $request->file('image'));
        }

        if ($request->hasFile('cover')) {
            $location->storeCoverImage($location->title, $request->file('cover'));
        }
        DB::commit();
        return redirect()->route('admin.locations.index')->with('success', 'Location Created Successfully!');
    }

    public function show(Location $location): View
    {
        $location = Location::with('user')->find($location->id);
        return view('admin.location.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('admin.location.edit', compact('location'));
    }

    public function update(LocationUpdateRequest $request, Location $location)
    {
        $location->update($request->safe()->except('image', 'cover'));
        if ($request->hasFile('image')) {
            $location->updateFeatureImage($location->title, $request->file('image'));
        }
        if ($request->hasFile('cover')) {
            $location->updateCoverImage($location->title, $request->file('cover'));
        }

        return redirect()->route('admin.locations.index')->with('success', 'Blog Updated Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Location', $request->id, $request->status);
    }
}
