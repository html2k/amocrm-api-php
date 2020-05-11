<?php

namespace AmoCRM\Models;

use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

class RoleModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    const USERS = 'users';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     * //TODO collection when users api will be available
     */
    protected $users;

    /**
     * @var array
     * //TODO rights model
     */
    protected $rights;

    /**
     * @var null|int
     */
    protected $requestId;

    /**
     * @param array $role
     *
     * @return self
     */
    public static function fromArray(array $role): self
    {
        if (empty($role['id'])) {
            throw new InvalidArgumentException('Role id is empty in ' . json_encode($role));
        }

        $roleModel = new self();

        $roleModel
            ->setId($role['id'])
            ->setName($role['name'])
            ->setRights($role['rights']);

        if (!empty($role['users'])) {
            $roleModel->setUsers($role['users']);
        }

        return $roleModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'right' => $this->getRights(),
            'users' => $this->getUsers(),
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RoleModel
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
     * @return RoleModel
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|array
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }

    /**
     * @param array $users
     * @return RoleModel
     */
    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * @param array $rights
     * @return RoleModel
     */
    public function setRights(array $rights): self
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi(?string $requestId = null): array
    {
        $result = [];

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getRights())) {
            $result['rights'] = $this->getRights();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }

    public static function getAvailableWith(): array
    {
        return [
            self::USERS,
        ];
    }
}
