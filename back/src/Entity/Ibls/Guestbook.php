<?php declare(strict_types=1);

namespace App\Entity\Ibls;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ibls\GuestbookRepository")
 * @ORM\Table(
 *     name="guestbook",
 *     options={"collate":"utf8mb4_unicode_ci", "charset":"utf8mb4", "engine":"InnoDB", "comment":"Гостевая книга"}
 * )
 */
class Guestbook
{

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @ORM\Column(type="bigint", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false, options={"collation":"utf8mb4_unicode_ci","comment":"Имя пользователя"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci","comment":"Email"})
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=false, options={"collation":"utf8mb4_unicode_ci","comment":"Сообщение"})
     */
    private $message;

    /**
     * @ORM\Column(type="timestamp", nullable=false, options={"comment":"Дата отправки"})
     */
    private $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Guestbook
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     * @return Guestbook
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Guestbook
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Guestbook
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

}
