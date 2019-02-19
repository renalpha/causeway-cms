<?php

namespace Tests\ModelFactories;

use Domain\Entities\User\User;
use Spatie\Permission\Models\Role;

/**
 * Class UserFactory
 * @package Tests\ModelFactories
 */
class UserFactory
{
    /**
     * @var Role $role
     */
    protected $role;

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        $user = factory(User::class)->create($params);
        $user->assignRole($this->role);
        return $user;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function withRole(Role $role): self
    {
        $this->role = $role;
        return $this;
    }
}