<?php

namespace App\Services;

use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /* Get all */
    public function getAll()
    {
        return User::paginate();
    }
    /* Get active */
    public function getActive()
    {
        return User::active()->get();
    }
    /* Find by id */
    public function findById($id)
    {
        return User::findOrFail($id);
    }
    /* Find by slug */
    public function findBySlug($slug)
    {
        return User::where('slug', $slug)->firstOrFail();
    }
    /* Create */
    public function store(array $attr)
    {
        User::create($attr);
    }
    /* Update */
    public function update($id, array $attr)
    {
        $User = $this->findById($id);
        $User->update($attr);
    }
    /* Delete */
    public function destroy($id)
    {
        $User = $this->findById($id);
        $User->delete();
    }
}
