<?php


/**
 * Class Account
 */
class Account {
    /**
     * @var string|null
     */
    private ?string $domain = null;
    /**
     * @var string|null
     */
    private ?string $user = null;
    /**
     * @var string|null
     */
    private ?string $pwd = null;
    /**
     * @var string|null
     */
    private ?string $plan = null;
    /**
     * @var string|null
     */
    private ?string $email = null;
    /**
     * @var string|null
     */
    private ?string $searchType = null;
    /**
     * @var string|null
     */
    private ?string $search = null;

    /**
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @return string|null
     */
    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    /**
     * @return string|null
     */
    public function getPlan(): ?string
    {
        return $this->plan;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getSearchType(): ?string
    {
        return $this->searchType;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param string|null $domain
     */
    public function setDomain(?string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @param string|null $user
     */
    public function setUser(?string $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string|null $pwd
     */
    public function setPwd(?string $pwd): void
    {
        $this->pwd = $pwd;
    }

    /**
     * @param string|null $plan
     */
    public function setPlan(?string $plan): void
    {
        $this->plan = $plan;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string|null $searchType
     */
    public function setSearchType(?string $searchType): void
    {
        $this->searchType = $searchType;
    }

    /**
     * @param string|null $search
     */
    public function setSearch(?string $search): void
    {
        $this->search = $search;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->user.$this->pwd.$this->domain.$this->email.$this->plan.$this->searchType.$this->search;
    }
}
