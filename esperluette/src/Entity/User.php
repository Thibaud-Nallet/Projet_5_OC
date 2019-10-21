<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 * fields = {"email"},
 * message = "L'email indiqué est déjà utilisé"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Renseignez un email valide")
     */
    private $email;

    /** 
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $firstname;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Au moins 8 caractères")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vos mots de passe doivent être identiques")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameLivraison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstNameLivraison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressFirst;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressSecond;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codeCity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $moreInfo;

    /**
     * Permet d'initialiser le slug
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function initSlug()
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->firstname);
        }
    }

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }
    
    //4 Fonctions dont UserInterface a besoin 
    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function eraseCredentials()
    { }

    public function getSalt()
    { }

    public function getRoles()
    {
        $roles= $this->userRoles->map(function($role){
            return $role->getTitle();
        })->toArray();
        $roles[]= 'ROLE_USER';
        
        return $roles;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Adress[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adress $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setIdUser($this);
        }

        return $this;
    }

    public function removeAdress(Adress $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getIdUser() === $this) {
                $adress->setIdUser(null);
            }
        }

        return $this;
    }

    public function getNameLivraison(): ?string
    {
        return $this->nameLivraison;
    }

    public function setNameLivraison(?string $nameLivraison): self
    {
        $this->nameLivraison = $nameLivraison;

        return $this;
    }

    public function getFirstNameLivraison(): ?string
    {
        return $this->firstNameLivraison;
    }

    public function setFirstNameLivraison(?string $firstNameLivraison): self
    {
        $this->firstNameLivraison = $firstNameLivraison;

        return $this;
    }

    public function getAdressFirst(): ?string
    {
        return $this->adressFirst;
    }

    public function setAdressFirst(?string $adressFirst): self
    {
        $this->adressFirst = $adressFirst;

        return $this;
    }

    public function getAdressSecond(): ?string
    {
        return $this->adressSecond;
    }

    public function setAdressSecond(?string $adressSecond): self
    {
        $this->adressSecond = $adressSecond;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCodeCity(): ?int
    {
        return $this->codeCity;
    }

    public function setCodeCity(?int $codeCity): self
    {
        $this->codeCity = $codeCity;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMoreInfo(): ?string
    {
        return $this->moreInfo;
    }

    public function setMoreInfo(?string $moreInfo): self
    {
        $this->moreInfo = $moreInfo;

        return $this;
    }

    

}
