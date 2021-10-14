<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    const ADMIN = "ROLE_ADMIN";
    const USER = "ROLE_USER";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 3, max = 255, minMessage = "Votre prénom doit faire au minimum {{ limit }} caractères", maxMessage = "Votre prénom doit faire au maximum {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 3, max = 255, minMessage = "Votre nom doit faire au minimum {{ limit }} caractères", maxMessage = "Votre nom doit faire au maximum {{ limit }} caractères")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(message = "L'email '{{ value }}' n'est pas valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 3, max = 255, minMessage = "Votre nom d'utilisateur doit faire au minimum {{ limit }} caractères", maxMessage = "Votre nom d'utilisateur doit faire au maximum {{ limit }} caractères")
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;

    /**
     * Give the full name of user
     *
     * @return string
     */
    public function getFullName()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getRoleTitle()
    {
        if (in_array(self::ADMIN, $this->roles)) return "Administrateur";
        else return "Utilisateur";
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    public function getUsername() : ?string
    {
        return $this->username;
    }

    public function setUsername(string $username) : self
    {
        $this->username = $username;
        return $this;
    }

    public function getRoles() : ?array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles) : self
    {
        $this->roles = $roles;
        return $this;
    }

    
    public function getPassword() : ?string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getSalt()
    {}

    public function eraseCredentials()
    {}

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }
     
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }
}
