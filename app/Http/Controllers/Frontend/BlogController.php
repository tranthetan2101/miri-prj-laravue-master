<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepository;
    
    /**
     * BlogController constructor.
     *
     * @param  BlogRepository  $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * BlogController index.
     * 
     * @return view
     */
    public function index()
    {
        $blogs = $this->blogRepository->all();
        $newest = $this->blogRepository->first();

        return view('frontend.blogs.index', compact('blogs', 'newest'));
    }

    /**
     * BlogController detail.
     * 
     * @param $id Blog Id
     * @return view
     */
    public function detail($id)
    {
        $blog = $this->blogRepository->getById($id); // blog data
        $blogs = $this->blogRepository->all(); // list blog

        return view('frontend.blogs.detail', compact('blog', 'blogs'));
    }
}
