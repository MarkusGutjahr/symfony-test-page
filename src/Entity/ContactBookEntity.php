<?php
 namespace App\Entity;

 //Entity → gleiche wie Modell
 //Objekt fürs Speichern in der DB
 //braucht dieselben Werte wie das Formular

 use Symfony\Component\Validator\Constraints as Assert;
 use Doctrine\ORM\Mapping as ORM;

 #[ORM\Entity]
 class ContactBookEntity
 {
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column(type: 'integer')]
     private ?int $id;

     #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
     private \DateTimeImmutable $createdAt;

     #[Assert\NotBlank]
     #[Assert\Length(max:255)]
     #[ORM\Column(type: 'string')]
     private string $username;
     #[Assert\Email]
     #[ORM\Column(type: 'string', nullable: true)]
     private ?string $email;
     #[Assert\NotBlank]
     #[Assert\Length(max:255)]
     #[ORM\Column(type: 'string')]
     private string $subtitle;
     #[Assert\NotBlank]
     #[ORM\Column(type: 'text')]
     private string $body;


    public function __construct(){
        $this->createdAt = new \DateTimeImmutable();
    }

     public function getCreatedAt(): \DateTimeImmutable
     {
         return $this->createdAt;
     }

     public function setCreatedAt(\DateTimeImmutable $createdAt): void
     {
         $this->createdAt = $createdAt;
     }

     public function getUsername(): string
     {
         return $this->username;
     }

     public function setUsername(string $username): void
     {
         $this->username = $username;
     }

     public function getEmail(): string
     {
         return $this->email;
     }

     public function setEmail(string $email): void
     {
         $this->email = $email;
     }

     public function getSubtitle(): string
     {
         return $this->subtitle;
     }

     public function setSubtitle(string $subtitle): void
     {
         $this->subtitle = $subtitle;
     }

     public function getBody(): string
     {
         return $this->body;
     }

     public function setBody(string $body): void
     {
         $this->body = $body;
     }



 }
