<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FocusPaysRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=FocusPaysRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class FocusPays
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $introduction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageCover;

    /**
     * @ORM\OneToMany(targetEntity=FocusVille::class, mappedBy="focusPays", orphanRemoval=true)
     */
    private $focusVilles;

    /**
     * @ORM\OneToOne(targetEntity=MarkerPays::class, mappedBy="focusPays", cascade={"persist", "remove"})
     */
    private $markerPays;

      /**
     * Permet d'initialiser le slug
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug() {
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }


    public function __construct()
    {
        $this->focusVilles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImageCover(): ?string
    {
        return $this->imageCover;
    }

    public function setImageCover(string $imageCover): self
    {
        $this->imageCover = $imageCover;

        return $this;
    }

    /**
     * @return Collection|FocusVille[]
     */
    public function getFocusVilles(): Collection
    {
        return $this->focusVilles;
    }

    public function addFocusVille(FocusVille $focusVille): self
    {
        if (!$this->focusVilles->contains($focusVille)) {
            $this->focusVilles[] = $focusVille;
            $focusVille->setFocusPays($this);
        }

        return $this;
    }

    public function removeFocusVille(FocusVille $focusVille): self
    {
        if ($this->focusVilles->contains($focusVille)) {
            $this->focusVilles->removeElement($focusVille);
            // set the owning side to null (unless already changed)
            if ($focusVille->getFocusPays() === $this) {
                $focusVille->setFocusPays(null);
            }
        }

        return $this;
    }

    public function getMarkerPays(): ?MarkerPays
    {
        return $this->markerPays;
    }

    public function setMarkerPays(MarkerPays $markerPays): self
    {
        $this->markerPays = $markerPays;

        // set the owning side of the relation if necessary
        if ($markerPays->getFocusPays() !== $this) {
            $markerPays->setFocusPays($this);
        }

        return $this;
    }
}
