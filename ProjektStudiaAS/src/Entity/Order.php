<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $orderHash = null;

    #[ORM\Column(length: 255, type: 'datetime')]
    private ?\DateTimeInterface $startDatetime = null;

    #[ORM\Column(length: 255, type: 'datetime')]
    private ?\DateTimeInterface $endDatetime = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'product_id')]
    private ?Product $product = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'user_id')]
    private ?User $user = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getOrderHash(): ?string
    {
        return $this->orderHash;
    }

    /**
     * @param string|null $orderHash
     */
    public function setOrderHash(?string $orderHash): void
    {
        $this->orderHash = $orderHash;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->startDatetime;
    }

    /**
     * @param \DateTimeInterface|null $startDatetime
     */
    public function setStartDatetime(?\DateTimeInterface $startDatetime): void
    {
        $this->startDatetime = $startDatetime;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndDatetime(): ?\DateTimeInterface
    {
        return $this->endDatetime;
    }

    /**
     * @param \DateTimeInterface|null $endDatetime
     */
    public function setEndDatetime(?\DateTimeInterface $endDatetime): void
    {
        $this->endDatetime = $endDatetime;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     */
    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

}
