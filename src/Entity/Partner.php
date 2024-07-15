<?php

declare(strict_types=1);

namespace ProjetNormandie\PartnerBundle\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\PartnerBundle\Repository\PartnerRepository;
use ProjetNormandie\PartnerBundle\ValueObject\PartnerStatus;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name:'pnp_partner')]
#[ORM\Entity(repositoryClass: PartnerRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ],
    normalizationContext: ['groups' => ['partner:read']]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'status' => 'exact',
    ]
)]
class Partner implements TimestampableInterface
{
    use TimestampableTrait;

    #[Groups(['partner:read'])]
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[Groups(['partner:read'])]
    #[ORM\Column(length: 50, nullable: false)]
    private string $name;

    #[Groups(['partner:read'])]
    #[ORM\Column(length: 255, nullable: false)]
    private string $url;

    #[Assert\Email]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact = null;

    #[ORM\Column(length: 30, nullable: false)]
    private string $status = PartnerStatus::INACTIVE;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment;

    public function __toString()
    {
        return sprintf('Partner [%s]', $this->id);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setContact(string $contact): void
    {
        $this->contact = $contact;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setStatus(string $status): void
    {
        $value = new PartnerStatus($status);
        $this->status = $value->getValue();
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPartnerStatus(): PartnerStatus
    {
        return new PartnerStatus($this->status);
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
