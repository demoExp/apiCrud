<?php


/**
 * Interface UriBuilder
 */
interface UriBuilder
{
    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriUser(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriUsername(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriPass(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriDomain(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriPlan(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriPkg(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getUriEmail(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getSearchType(Account $account);

    /**
     * @param Account $account
     * @return mixed
     */
    public function getSearch(Account $account);
}