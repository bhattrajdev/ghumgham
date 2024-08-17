<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\Location;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use App\Traits\DatatableTrait;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BlogController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::select(['id', 'title', 'publish_date', 'phase', 'status'])->get();

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
        return view('admin.blog.index', [
            'columns' => ['image', 'title', 'publish_date', 'phase'],
        ]);
    }


    public function create()
    {
        return view('admin.blog.create', ['location' => Location::acceptedAndActive()->pluck("title", "id")]);
    }

    
    public function store(BlogRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        $blog = $request->safe()->except('image', 'cover');
        $blog = Blog::create($blog);
        if ($request->hasFile('image')) {
            $blog->storeFeatureImage($blog->title, $request->file('image'));
        }

        if ($request->hasFile('cover')) {
            $blog->storeCoverImage($blog->title, $request->file('cover'));
        }
        DB::commit();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Created Successfully!');
    }


    public function show(Blog $blog): View
    {
        $blog = Blog::with('user', 'location')->find($blog->id);
        $location = $blog->location;
        return view('admin.blog.show', compact('blog', 'location'));
    }



    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(BlogUpdateRequest $request, Blog $blog): RedirectResponse
    {
        $blog->update($request->safe()->except('image', 'cover'));

        if ($request->hasFile('image')) {
            $blog->updateFeatureImage($blog->title, $request->file('image'));
        }

        if ($request->hasFile('cover')) {
            $blog->updateCoverImage($blog->title, $request->file('cover'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Updated Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Blog', $request->id, $request->status);
    }
}
