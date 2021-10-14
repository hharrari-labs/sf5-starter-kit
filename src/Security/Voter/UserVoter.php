<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Security\SecurityTrait;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    use SecurityTrait;

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [
            'USER_LIST',
            'USER_ADD',
            'USER_EDIT',
            'USER_DELETE',
            'USER_PROFIL',
            'USER_ADMIN'
        ]) && ($subject instanceof User || $subject === null);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'USER_LIST':
                return $this->isAdminSecurity();
                break;
            case 'USER_ADD':
                return $this->isAdminSecurity();
                break;
            case 'USER_EDIT':
                return $this->isAdminSecurity();
                break;
            case 'USER_DELETE':
                return $this->isAdminSecurity();
                break;
            case 'USER_ADMIN':
                return $this->isAdminSecurity();
                break;
            case 'USER_PROFIL':
                return $this->isAdminSecurity() && $user == $subject;
                break;
        }

        return false;
    }
}
