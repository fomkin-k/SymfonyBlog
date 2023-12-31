<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\Post;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PostVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const DELETE = 'POST_DELETE';
    public const VIEW = 'POST_VIEW';

    private Security $security;
    
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT,self::DELETE, self::VIEW])
            && $subject instanceof \App\Entity\Post;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var User $user */
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (!$subject instanceof Post) {
            throw new \Exception('Wrong type somehow passed');
        }
        

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::DELETE:
                if ($this->security->isGranted('ROLE_ADMIN')) {
                    return true;
                }
                // logic to determine if the user can VIEW
                // return true or false
                return $user === $subject->getAuthor();
                break;
            case self::EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                return $user === $subject->getAuthor();
                break;
            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                break;
        }

        return false;
    }
}
