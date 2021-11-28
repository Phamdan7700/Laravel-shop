<?php

namespace App\Services;

use App\Models\Post;

/**
 * Class BlogService
 * @package App\Services
 */
class BlogService
{
    /* Get all */
    public function getAll()
    {
        return Post::paginate();
    }
    /* Get active */
    public function getActive($limit = 15)
    {
        return Post::active()->paginate($limit);
    }
    /* Find by id */
    public function findById($id)
    {
        return Post::findOrFail($id);
    }
    /* Create */
    public function store(array $attr)
    {
        Post::create($attr);
    }
    /* Update */
    public function update($id, array $attr)
    {
        $post = $this->findById($id);
        $post->update($attr);
    }
    /* Delete */
    public function destroy($id)
    {
        $post = $this->findById($id);
        $post->delete();
    }
}
