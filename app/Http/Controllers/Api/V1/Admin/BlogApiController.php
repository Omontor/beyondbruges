<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\Admin\BlogResource;
use App\Models\Blog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogResource(Blog::all());
    }

    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());

        if ($request->input('thumb_image', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
        }

        if ($request->input('banner_image', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_image'))))->toMediaCollection('banner_image');
        }

        if ($request->input('gallery', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery'))))->toMediaCollection('gallery');
        }

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Blog $blog)
    {
        abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogResource($blog);
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());

        if ($request->input('thumb_image', false)) {
            if (!$blog->thumb_image || $request->input('thumb_image') !== $blog->thumb_image->file_name) {
                if ($blog->thumb_image) {
                    $blog->thumb_image->delete();
                }
                $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
            }
        } elseif ($blog->thumb_image) {
            $blog->thumb_image->delete();
        }

        if ($request->input('banner_image', false)) {
            if (!$blog->banner_image || $request->input('banner_image') !== $blog->banner_image->file_name) {
                if ($blog->banner_image) {
                    $blog->banner_image->delete();
                }
                $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_image'))))->toMediaCollection('banner_image');
            }
        } elseif ($blog->banner_image) {
            $blog->banner_image->delete();
        }

        if ($request->input('gallery', false)) {
            if (!$blog->gallery || $request->input('gallery') !== $blog->gallery->file_name) {
                if ($blog->gallery) {
                    $blog->gallery->delete();
                }
                $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery'))))->toMediaCollection('gallery');
            }
        } elseif ($blog->gallery) {
            $blog->gallery->delete();
        }

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
