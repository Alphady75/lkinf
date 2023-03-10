<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
/**
* @UniqueEntity(fields={"email"}, message="Cette adresse email est déjà utilisée pour un autre compte")
* @Vich\Uploadable
*/
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $genre;

    /**
     * @Vich\UploadableField(mapping="users_avatars", fileNameProperty="avatar")
     * @var File|null
     * @Assert\Image(maxSize="10M", maxSizeMessage="Image trop volumineuse maximum 10Mb")
     * @Assert\Image(mimeTypes = {"image/jpeg", "image/jpg", "image/png"}, mimeTypesMessage = "Mauvais format d'image (jpeg, jpg et png)")
    **/
    private $imageFile;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatar;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $compte;

    #[ORM\Column(type: 'text', nullable: true)]
    private $apropos;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameUrl;

    #[ORM\OneToMany(mappedBy: 'vendeur', targetEntity: Microservice::class)]
    private $microservices;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $pays;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ville;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telephone;

    #[ORM\OneToOne(mappedBy: 'vendeur', targetEntity: Portefeuille::class, cascade: ['persist', 'remove'])]
    private $portefeuille;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Abonnement::class, cascade: ['persist', 'remove'])]
    private $abonnement;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Avis::class)]
    private $avis;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Favoris::class)]
    private $favoris;

    #[ORM\OneToMany(mappedBy: 'vendeur', targetEntity: Suivis::class)]
    private $suivis;

    #[ORM\OneToMany(mappedBy: 'user1', targetEntity: Conversation::class)]
    private $conversations;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: Message::class)]
    private $messages;

    #[ORM\OneToMany(mappedBy: 'sendeur', targetEntity: Conversation::class)]
    private $senderconversations;

    #[ORM\OneToMany(mappedBy: 'destinataire', targetEntity: Commande::class)]
    private $destinatairesCommandes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CommandeMessage::class)]
    private $commandeMessages;

    public function __construct()
    {
        $this->microservices = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->suivis = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->senderconversations = new ArrayCollection();
        $this->destinatairesCommandes = new ArrayCollection();
        $this->commandeMessages = new ArrayCollection();
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getApropos(): ?string
    {
        return $this->apropos;
    }

    public function setApropos(?string $apropos): self
    {
        $this->apropos = $apropos;

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdated(new \DateTimeImmutable());
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function serialize() {

        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));

    }

    public function unserialize($serialized) {

        list (
            $this->id,
            $this->email,
            $this->password,
        ) = unserialize($serialized);
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getCompte(): ?string
    {
        return $this->compte;
    }

    public function setCompte(string $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getNameUrl(): ?string
    {
        return $this->nameUrl;
    }

    public function setNameUrl(string $nameUrl): self
    {
        $this->nameUrl = $nameUrl;

        return $this;
    }

    /**
     * @return Collection|Microservice[]
     */
    public function getMicroservices(): Collection
    {
        return $this->microservices;
    }

    public function addMicroservice(Microservice $microservice): self
    {
        if (!$this->microservices->contains($microservice)) {
            $this->microservices[] = $microservice;
            $microservice->setVendeur($this);
        }

        return $this;
    }

    public function removeMicroservice(Microservice $microservice): self
    {
        if ($this->microservices->removeElement($microservice)) {
            // set the owning side to null (unless already changed)
            if ($microservice->getVendeur() === $this) {
                $microservice->setVendeur(null);
            }
        }

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPortefeuille(): ?Portefeuille
    {
        return $this->portefeuille;
    }

    public function setPortefeuille(?Portefeuille $portefeuille): self
    {
        // unset the owning side of the relation if necessary
        if ($portefeuille === null && $this->portefeuille !== null) {
            $this->portefeuille->setVendeur(null);
        }

        // set the owning side of the relation if necessary
        if ($portefeuille !== null && $portefeuille->getVendeur() !== $this) {
            $portefeuille->setVendeur($this);
        }

        $this->portefeuille = $portefeuille;

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        // unset the owning side of the relation if necessary
        if ($abonnement === null && $this->abonnement !== null) {
            $this->abonnement->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($abonnement !== null && $abonnement->getUser() !== $this) {
            $abonnement->setUser($this);
        }

        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setClient($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getClient() === $this) {
                $avi->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Favoris[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->setClient($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getClient() === $this) {
                $favori->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Suivis[]
     */
    public function getSuivis(): Collection
    {
        return $this->suivis;
    }

    public function addSuivi(Suivis $suivi): self
    {
        if (!$this->suivis->contains($suivi)) {
            $this->suivis[] = $suivi;
            $suivi->setVendeur($this);
        }

        return $this;
    }

    public function removeSuivi(Suivis $suivi): self
    {
        if ($this->suivis->removeElement($suivi)) {
            // set the owning side to null (unless already changed)
            if ($suivi->getVendeur() === $this) {
                $suivi->setVendeur(null);
            }
        }

        return $this;
    }

    /**
     * Permet de savoir si l'utilisateur suis déjà ce vendeur
     *
     * @param User $user
     * @return boolean
     */
    public function isFollowed(User $user){
        foreach($this->suivis as $suivi){
            if($suivi->getClient() === $user) return true;
        }

        return false;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
            $conversation->setUser1($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            // set the owning side to null (unless already changed)
            if ($conversation->getUser1() === $this) {
                $conversation->setUser1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setAuteur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getAuteur() === $this) {
                $message->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getSenderconversations(): Collection
    {
        return $this->senderconversations;
    }

    public function addSenderconversation(Conversation $senderconversation): self
    {
        if (!$this->senderconversations->contains($senderconversation)) {
            $this->senderconversations[] = $senderconversation;
            $senderconversation->setSender($this);
        }

        return $this;
    }

    public function removeSenderconversation(Conversation $senderconversation): self
    {
        if ($this->senderconversations->removeElement($senderconversation)) {
            // set the owning side to null (unless already changed)
            if ($senderconversation->getSender() === $this) {
                $senderconversation->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getDestinatairesCommandes(): Collection
    {
        return $this->destinatairesCommandes;
    }

    public function addDestinatairesCommandes(Commande $destinatairesCommandes): self
    {
        if (!$this->destinatairesCommandes->contains($destinatairesCommandes)) {
            $this->destinatairesCommandes[] = $destinatairesCommandes;
            $destinatairesCommandes->setDestinataire($this);
        }

        return $this;
    }

    public function removeDestinatairesCommandes(Commande $destinatairesCommandes): self
    {
        if ($this->destinatairesCommandes->removeElement($destinatairesCommandes)) {
            // set the owning side to null (unless already changed)
            if ($destinatairesCommandes->getDestinataire() === $this) {
                $destinatairesCommandes->setDestinataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeMessage[]
     */
    public function getCommandeMessages(): Collection
    {
        return $this->commandeMessages;
    }

    public function addCommandeMessage(CommandeMessage $commandeMessage): self
    {
        if (!$this->commandeMessages->contains($commandeMessage)) {
            $this->commandeMessages[] = $commandeMessage;
            $commandeMessage->setUser($this);
        }

        return $this;
    }

    public function removeCommandeMessage(CommandeMessage $commandeMessage): self
    {
        if ($this->commandeMessages->removeElement($commandeMessage)) {
            // set the owning side to null (unless already changed)
            if ($commandeMessage->getUser() === $this) {
                $commandeMessage->setUser(null);
            }
        }

        return $this;
    }
}
