<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\OneToMany(targetEntity: Signalement::class, mappedBy: 'utilisateur')]
    private Collection $signalements;

    /**
     * @var Collection<int, PointFidelite>
     */
    #[ORM\OneToMany(targetEntity: PointFidelite::class, mappedBy: 'utilisateur')]
    private Collection $pointFidelites;

    public function __construct()
    {
        $this->signalements = new ArrayCollection();
        $this->pointFidelites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Signalement>
     */
    public function getSignalements(): Collection
    {
        return $this->signalements;
    }

    public function addSignalement(Signalement $signalement): static
    {
        if (!$this->signalements->contains($signalement)) {
            $this->signalements->add($signalement);
            $signalement->setUtilisateur($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): static
    {
        if ($this->signalements->removeElement($signalement)) {
            // set the owning side to null (unless already changed)
            if ($signalement->getUtilisateur() === $this) {
                $signalement->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PointFidelite>
     */
    public function getPointFidelites(): Collection
    {
        return $this->pointFidelites;
    }

    public function addPointFidelite(PointFidelite $pointFidelite): static
    {
        if (!$this->pointFidelites->contains($pointFidelite)) {
            $this->pointFidelites->add($pointFidelite);
            $pointFidelite->setUtilisateur($this);
        }

        return $this;
    }

    public function removePointFidelite(PointFidelite $pointFidelite): static
    {
        if ($this->pointFidelites->removeElement($pointFidelite)) {
            // set the owning side to null (unless already changed)
            if ($pointFidelite->getUtilisateur() === $this) {
                $pointFidelite->setUtilisateur(null);
            }
        }

        return $this;
    }
}
