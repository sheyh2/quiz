<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AbstractList.php
 *
 * @package App\Http\Resources
 * @nickname <sheyh2>
 * @author Abdurakhmon Abdusharipov <abdusharipov.sheyx@gmail.com>
 *
 * Date: 22/12/22
 */
class AbstractCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    protected $total;
    protected $perPage;
    protected $currentPage;
    protected $lastPage;

    // Setters

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @param int $lastPage
     */
    public function setLastPage(int $lastPage): void
    {
        $this->lastPage = $lastPage;
    }

    // Getters

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->lastPage;
    }
}
