<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActorRepository::class)
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $born_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dead_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $born_place;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class)
     */
    private $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBornDate(): ?\DateTimeInterface
    {
        return $this->born_date;
    }

    public function setBornDate(\DateTimeInterface $born_date): self
    {
        $this->born_date = $born_date;

        return $this;
    }

    public function getDeadDate(): ?\DateTimeInterface
    {
        return $this->dead_date;
    }

    public function setDeadDate(\DateTimeInterface $dead_date): self
    {
        $this->dead_date = $dead_date;

        return $this;
    }

    public function getBornPlace(): ?string
    {
        return $this->born_place;
    }

    public function setBornPlace(?string $born_place): self
    {
        $this->born_place = $born_place;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        $this->films->removeElement($film);

        return $this;
    }
}
