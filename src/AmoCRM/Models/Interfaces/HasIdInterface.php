<?php

namespace AmoCRM\Models\Interfaces;

/**
 * Interface HasIdInterface
 * Необходим сущностям, у которые есть id
 *
 * @package AmoCRM\Models\Interfaces
 */
interface HasIdInterface
{
    /**
     * @return int
     */
    public function getId(): int;
}
