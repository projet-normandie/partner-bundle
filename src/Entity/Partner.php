<?php

namespace ProjetNormandie\PartnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="ProjetNormandie\PartnerBundle\Repository\PartnerRepository")
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *          "status": "exact",
 *     }
 * )
 */
class Partner implements TimestampableInterface
{
    use TimestampableTrait;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const STATUS_CANCELED = 'CANCELED';


    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $id = null;


    /**
     * @Assert\Length(max="50")
     * @ORM\Column(name="libPartner", type="string", nullable=false)
     */
    private string $libPartner;


    /**
     * @ORM\Column(name="url", type="string", nullable=false)
     */
    private string $url;


    /**
     * @Assert\Email
     * @ORM\Column(name="contact", type="string", nullable=true)
     */
    private ?string $contact = null;


    /**
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private string $status = self::STATUS_INACTIVE;


    /**
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private ?string $description;


    /**
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    private ?string $comment;

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('Partner [%s]', $this->id);
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Set libPartner
     *
     * @param string $libPartner
     * @return $this
     */
    public function setLibPartner(string $libPartner): self
    {
        $this->libPartner = $libPartner;
        return $this;
    }

    /**
     * Get libPartner
     *
     * @return string
     */
    public function getLibPartner(): string
    {
        return $this->libPartner;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return $this
     */
    public function setContact(string $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $comment
     * @return $this
     */
    public function setComment(?string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return array
     */
    public static function getStatusChoices(): array
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE,
            self::STATUS_CANCELED => self::STATUS_CANCELED,
        ];
    }
}
