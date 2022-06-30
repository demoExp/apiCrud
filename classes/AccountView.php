<?php


/**
 * Class AccountView
 */
class AccountView
{
    /**
     * @var Account
     */
    private Account $account;
    /**
     * @var AccountContr
     */
    private AccountContr $contr;

    /**
     * AccountView constructor.
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->contr = new AccountContr();
    }


    /**
     * @param $content
     * @return string
     */
    public function index($content){
        return "
            <div class='container'>
                <div class='row'>
                    <div class='col-md-6 offset-md-3' style='background: white; padding: 20px; box-shadow: 10px 10px 5px #888888; margin-top: 100px; margin-bottom: 100px;'>
                        <h1><a href='index.php'>Panel</a></h1>
                        <p style='font-style: italic;'></p>
                        <hr>
                        ".$content."
                    </div>
                </div>
            </div>
        
        ";
    }

    /**
     * @return string
     */
    public function panel(){
        return "
            <form action='' method='get'>
                <div class='alert alert-success'>
                    <button class='btn' type='submit' name='panel' value='create'><strong>Create Account</strong></button>
                </div>
            </form>
            <form action='' method='get'>
                <div class='alert alert-info'>
                    <button class='btn' type='submit' name='panel' value='list'><strong>List Account</strong></button>
                </div>
            </form>
            <form action='' method='get'>
                <div class='alert alert-warning'>
                    <button class='btn' type='submit' name='panel' value='modify'><strong>Modify Account</strong></button>
                </div>
            </form>
            <form action='' method='get'>
                <div class='alert alert-danger'>
                    <button class='btn' type='submit' name='panel' value='del'><strong>Delete Account!</strong></button>
                </div>
            </form>
            ";
    }

    /**
     * @param Account $account
     * @return string
     */
    public function createAccount(Account $account){
        return "
            <div>
                <form action='' method='post'>
                    <div class='modal-body'>
                        <div class='form-group'>
                            *required<input type='text' name='username' class='form-control' placeholder='username' required>
                        </div>
                        <div class='form-group'>
                            *required<input type='text' name='domain' class='form-control' placeholder='exampledomain.com' required>
                        </div>
                        <div class='form-group'>
                            <input type='password' name='passwd' class='form-control' placeholder='password'>
                        </div>
                        <div class='form-group'>
                            <input type='password' name='passwd2' class='form-control' placeholder='re-type password'>
                        </div>
                        <div class='form-group'>
                            <input type='email' name='mail' class='form-control' placeholder='your@email.com'>
                        </div>
                        <div class='form-group'>
                            <input type='text' name='plan' class='form-control' placeholder='default_plan'>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-danger'>Reset</button>
                        <button type='submit' class='btn btn-success' name='function' value='create' >Submit</button>
                    </div>
                </form>
            </div>
            ".$this->contr->createAccount($account);
    }

    /**
     * @param Account $account
     * @return string
     */
    public function modifyAccount(Account $account){
        return "
            <div>
                <form action='' method='post'>
                    <div class='modal-body'>
                        <div class='form-group'>
                            *required<input type='text' name='username' class='form-control' placeholder='username' required>
                        </div>
                        </div>
                        <div class='form-group'>
                            <input type='email' name='mail' class='form-control' placeholder='your@email.com'>
                        </div>
                        <div class='form-group'>
                            <input type='text' name='plan' class='form-control' placeholder='default_plan'>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-danger'>Reset</button>
                        <button type='submit' class='btn btn-success' name='function' value='modify' >Submit</button>
                    </div>
                </form>
            </div>
            ".$this->contr->modifyAccount($account);
    }

    /**
     * @param Account $account
     * @return string
     */
    public function deleteAccount(Account $account){
        return "
            <div>
                <form action='' method='post'>
                    <div class='modal-body'>
                        <div class='form-group'>
                            *required<input type='text' name='username' class='form-control' placeholder='username' required>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-danger'>Reset</button>
                        <button type='submit' class='btn btn-success' name='function' value='del'>Submit</button>
                    </div>
                </form>
            </div>
            ".$this->contr->deleteAccount($account);
    }

    /**
     * @param Account $account
     * @return string
     */
    public function listAccount(Account $account){
        return "
            <div>
                <form action='' method='post'>
                    <div class='modal-body'>
                        <div class='form-group'>
                            <input type='text' name='searchtype' class='form-control' placeholder='search for (i.e: user or domain or package)'>
                        </div>
                        <div class='form-group'>
                            <input type='text' name='search' class='form-control' placeholder='search'>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='reset' class='btn btn-danger'>Reset</button>
                        <button type='submit' class='btn btn-success' name='function' value='list'>Submit</button>
                    </div>
                </form>
            </div>
            ".$this->contr->listAccount($account);
    }
}