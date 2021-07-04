<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\UpdateBlogRequest;
use App\Http\Requests\Backend\Blog\StoreBlogRequest;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

/**
 * Class BlogController.
 */
class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepository;

    /**
     * BlogController constructor.
     *
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.blog.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.blog.create');
    }

    /**
     * @param StoreBlogRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreBlogRequest $request)
    {
        $this->blogRepository->create(
            $request->only(
                'name',
                'slug',
                'description',
                'data'
            ),
            $request->has('image') ? $request->file('image') : false
        );

        return redirect()->route('admin.blog.index')->withFlashSuccess(__('alerts.backend.blog.created'));
    }

    /**
     * @param  Request  $request
     * @param  Blog $blog
     *
     * @return mixed
     */
    public function edit(Request $request, Blog $blog)
    {
        return view('backend.blog.edit')
            ->withBlog($blog);
    }

    /**
     * @param  UpdateBlogRequest  $request
     * @param  Blog $blog
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $this->blogRepository->update(
            $blog,
            $request->only(
                'name',
                'slug',
                'description',
                'data'
            ),
            $request->has('image') ? $request->file('image') : false
        );

        return redirect()->route('admin.blog.index')->withFlashSuccess(__('The blog was successfully updated.'));

//        return redirect()->route('admin.blog.show', $blog)->withFlashSuccess(__('The blog was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Blog $blog
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Request $request, Blog $blog)
    {
        $this->blogRepository->delete($blog);

        return redirect()->route('admin.blog.deleted')->withFlashSuccess(__('The blog was successfully deleted.'));
    }

    /**
     * @param $deletedBlogId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedBlogId)
    {
        abort_unless(config('boilerplate.access.user.permanently_delete'), 404);
        $deletedBlog= Blog::withTrashed()->findOrFail($deletedBlogId);
        $this->blogRepository->destroy($deletedBlog);

        return redirect()->route('admin.blog.deleted')->withFlashSuccess(__('The blog was permanently deleted.'));
    }

    public function deleted()
    {
        return view('backend.blog.deleted');
    }

    /**
     * @param $deletedBlogId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore($deletedBlogId)
    {
        $deletedBlog= Blog::withTrashed()->findOrFail($deletedBlogId);
        $this->blogRepository->restore($deletedBlog);

        return redirect()->route('admin.blog.index')->withFlashSuccess(__('The blog was successfully restored.'));
    }
}
