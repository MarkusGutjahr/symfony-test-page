<?php

namespace App\Entity;


use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[Assert\NotBlank]
    #[Assert\Length(max:255)]
    #[ORM\Column(type: 'string')]
    private string $name;
    #[Assert\Email]
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $email;

    #[Assert\NotBlank]
    #[Assert\Length(max: 15)]
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $phone;


    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private string $body;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}