<?php


/**
 * Class AccountContr
 */
class AccountContr
{

    /**
     * @param Account $account
     * @return string
     */
    public function createAccount(Account $account){
        if(isset($_POST['function']) && $_POST['function'] == 'create') {
            $account = $this->setAccount($account);
            $uri = $this->buildUri($account);

            $conn = new Connection($uri->getUri("createacct"));
            return $conn->json();
        }
        unset($_POST['function']);
    }

    /**
     * @param Account $account
     * @return string
     */
    public function modifyAccount(Account $account){
        if(isset($_POST['function']) && $_POST['function'] == 'modify') {
            $account = $this->setAccount($account);
            $uri = $this->buildUri($account);
            $uri->getUriPkg($account);
            $uri2 = $this->buildUri($account);
            $uri2->getUriEmail($account);

            $conn = new Connection($uri->getUri("changepackage"));
            $conn2 = new Connection($uri2->getUri("modifyacct"));

            $result = $conn2->json();
            $result .= "\n<br>".$conn->json();
            return $result;
        }
        unset($_POST['function']);
    }

    /**
     * @param Account $account
     * @return string
     */
    public function deleteAccount(Account $account){
        if(isset($_POST['function']) && $_POST['function'] == 'del') {
            $account = $this->setAccount($account);
            $uri = $this->buildUri($account);

            $conn = new Connection($uri->getUri("removeacct"));
            return $conn->json();
        }
        unset($_POST['function']);
    }

    /**
     * @param Account $account
     * @return string
     */
    public function listAccount(Account $account){
        if(isset($_POST['function']) && $_POST['function'] == 'list') {
            $account = $this->setAccount($account);
            $uri = $this->buildUri($account);

            $conn = new Connection($uri->getUri("listaccts"));
            return $conn->json();
        }
        unset($_POST['function']);
    }

    /**
     * @param Account $account
     * @return Account|string
     */
    private function setAccount(Account $account){
        if($_POST['function'] == 'create') {
            if (isset($_POST['passwd2'])) {
                try {
                    if ($_POST['passwd'] != $_POST['passwd2']) throw new Exception("passwords not equal");
                } catch (Exception $e) {
                    return "Error: " . $e->getMessage();
                }
            }
            $account->setPwd($_POST['passwd']);
            if($_POST['mail'] != '')
                $account->setEmail($this->sanitizeEmail($_POST['mail']));
            $account->setUser($this->sanitizeString($_POST['username']));
            $account->setPlan($this->sanitizeString($_POST['plan']));
            $account->setDomain($this->sanitizeString($_POST['domain']));
        }
        if($_POST['function'] == 'modify') {
            if($_POST['mail'] != '')
                $account->setEmail($this->sanitizeEmail($_POST['mail']));
            $account->setUser($this->sanitizeString($_POST['username']));
            $account->setPlan($this->sanitizeString($_POST['plan']));
        }
        if($_POST['function'] == 'list'){
            $account->setSearchType($_POST['searchtype']);
            $account->setSearch($_POST['search']);
        }
        if($_POST['function'] == 'del')
            $account->setUser($this->sanitizeString($_POST['username']));
        return $account;
    }

    /**
     * @param Account $account
     * @return Uri
     */
    private function buildUri(Account $account){
        $uri = new Uri();

        if($_POST['function'] == 'create') {
            $uri->getUriUsername($account);
            $uri->getUriDomain($account);
            $uri->getUriPass($account);
            $uri->getUriEmail($account);
            $uri->getUriPlan($account);
        }
        if($_POST['function'] == 'modify'){
            $uri->getUriUser($account);
        }

        if($_POST['function'] == 'list'){
            $uri->getSearchType($account);
            $uri->getSearch($account);
        }

        if($_POST['function'] == 'del') {
            $uri->getUriUsername($account);
        }

        return $uri;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function sanitizeString($string){
        return filter_var($string,FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /**
     * @param $string
     * @return mixed|string
     */
    private function sanitizeEmail($string){
        $string1 = filter_var($string,FILTER_SANITIZE_EMAIL);
        try {
            if(filter_var($string1,FILTER_VALIDATE_EMAIL))
                return $string1;
            else throw new Exception("wrong email adress");
        }catch (Exception $e){
            return "Error: ". $e->getMessage();
        }
    }
}