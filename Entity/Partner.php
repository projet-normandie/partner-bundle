<?php

namespace ProjetNormandie\PartnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * Partner
 *
 * @ORM\Table(name="partner", indexes={@ORM\Index(name="idxIdPartner", columns={"idPartner"})})
 * @ORM\Entity(repositoryClass="ProjetNormandie\PartnerBundle\Repository\PartnerRepository")
 */
class Partner
{
    use Timestampable;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const STATUS_CANCELED = 'CANCELED';


    /**
     * @var integer
     *
     * @ORM\Column(name="idPartner", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPartner;


    /**
     * @var string
     *
     * @Assert\Length(max="50")
     * @ORM\Column(name="libPartner", type="string", nullable=false)
     */
    private $libPartner;


    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", nullable=false)
     */
    private $url;


    /**
     * @var string
     *
     * @Assert\Email
     * @ORM\Column(name="contact", type="string", nullable=false)
     */
    private $contact;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = self::STATUS_INACTIVE;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;


    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    private $comment;

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('Partner [%s]', $this->idPartner);
    }


    /**
     * Set idPartner
     *
     * @param integer $idPartner
     * @return $this
     */
    public function setIdPartner($idPartner)
    {
        $this->idPartner = $idPartner;

        return $this;
    }

    /**
     * Get idPartner
     *
     * @return integer
     */
    public function getIdPartner()
    {
        return $this->idPartner;
    }


    /**
     * Set libPartner
     *
     * @param string $libPartner
     * @return $this
     */
    public function setLibPartner($libPartner)
    {
        $this->libPartner = $libPartner;
        return $this;
    }

    /**
     * Get libPartner
     *
     * @return string
     */
    public function getLibPartner()
    {
        return $this->libPartner;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return $this
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return array
     */
    public static function getStatusChoices()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE,
            self::STATUS_CANCELED => self::STATUS_CANCELED,
        ];
    }
}
