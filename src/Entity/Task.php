<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table]
class Task
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'Vous devez saisir un titre.')]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Vous devez saisir du contenu.')]
    private ?string $content = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isDone;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?User $user = null;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isDone = false;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }


    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }


    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }


    public function isDone(): bool
    {
        return $this->isDone;
    }


    public function toggle(bool $flag): self
    {
        $this->isDone = $flag;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}