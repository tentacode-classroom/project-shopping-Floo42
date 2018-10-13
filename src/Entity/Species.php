<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpeciesRepository")
 */
class Species
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jedi", mappedBy="species")
     */
    private $jedis;

    public function __construct()
    {
        $this->jedis = new ArrayCollection();
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

    /**
     * @return Collection|Jedi[]
     */
    public function getJedis(): Collection
    {
        return $this->jedis;
    }

    public function addJedi(Jedi $jedi): self
    {
        if (!$this->jedis->contains($jedi)) {
            $this->jedis[] = $jedi;
            $jedi->setSpecies($this);
        }

        return $this;
    }

    public function removeJedi(Jedi $jedi): self
    {
        if ($this->jedis->contains($jedi)) {
            $this->jedis->removeElement($jedi);
            // set the owning side to null (unless already changed)
            if ($jedi->getSpecies() === $this) {
                $jedi->setSpecies(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
