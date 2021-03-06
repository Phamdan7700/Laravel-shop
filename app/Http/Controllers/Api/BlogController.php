<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postList =  $this->blogService->getActive(10);
        return PostResource::collection($postList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  $this->blogService->findById($id);
        $post->update([
            'view' => $post->view + 1
        ]);
        return new PostResource($post);
    }

    public function getRelativePost($id)
    {
        $post =  $this->blogService->getRelativePost($id);
        return PostResource::collection($post);
    }
}
