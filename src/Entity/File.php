<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $content;

    #[ORM\Column(length: 255)]
    private ?string $file_name = null;

    #[ORM\Column]
    private ?int $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(string $file_name): static
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getOwner(): ?int
    {
        return $this->owner;
    }

    public function setOwner(int $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
