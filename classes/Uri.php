<?php


/**
 * Class Uri
 */
class Uri implements UriBuilder {
    /**
     * @var Account
     */
    protected Account $uri;

    /**
     * Uri constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     *
     */
    public function reset(){
        $this->uri = new Account();
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriUser(Account $account) : Account
    {
        if($account->getUser() != null)
            $this->uri->setUser("&user=".$account->getUser());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriUsername(Account $account) : Account
    {
        if($account->getUser() != null)
            $this->uri->setUser("&username=".$account->getUser());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriPass(Account $account) : Account
    {
        if($account->getPwd() != null)
            $this->uri->setPwd("&password=".$account->getPwd());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriDomain(Account $account) : Account
    {
        if($account->getDomain() != null)
            $this->uri->setDomain("&domain=".$account->getDomain());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriPlan(Account $account) : Account
    {
        if($account->getPlan() != null)
            $this->uri->setPlan("&plan=".$account->getPlan());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriPkg(Account $account) : Account
    {
        if($account->getPlan() != null)
            $this->uri->setPlan("&pkg=".$account->getPlan());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getUriEmail(Account $account) : Account
    {
        if($account->getEmail() != null)
            $this->uri->setEmail("&contactemail=".$account->getEmail());
        return $this->uri;
    }

    /**
     * @param string $function
     * @return string
     */
    public function getUri(string $function) {
        $result = $function.'?api.version=1'.$this->uri;
        $this->reset();

        return $result;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getSearchType(Account $account)
    {
        if($account->getSearchType() != null)
            $this->uri->setSearchType("&searchtype=".$account->getSearchType());
        return $this->uri;
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function getSearch(Account $account)
    {
        if($account->getSearch() != null)
            $this->uri->setSearch("&search=".$account->getSearch());
        return $this->uri;
    }
}
