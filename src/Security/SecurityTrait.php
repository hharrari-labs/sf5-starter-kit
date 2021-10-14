<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait SecurityTrait
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorageInterface;

    public function __construct(TokenStorageInterface $tokenStorageInterface)
    {
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    /**
     * If a user is allowed to access admin system
     *
     * @return boolean
     */
    public function isAdminSecurity(): bool
    {
        $roles = $this->tokenStorageInterface->getToken()->getUser()->getRoles();

        return in_array(User::ADMIN, $roles) || in_array(User::DEV, $roles);
    }
}
