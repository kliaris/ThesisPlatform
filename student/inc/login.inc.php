<?php

/**
* Simple Login System class
*/
class SimpleLoginSystem {

    // variables
    var $bLoggedIn;

    /**
    * constructor
    */
    function SimpleLoginSystem() {
        $this->bLoggedIn = false;
        if ($_COOKIE['member_name'] ) {
            if ($this->check_login($_COOKIE['member_name'], true)) {
                $this->bLoggedIn = true;
            }
        }
        $GLOBALS['bLoggedIn'] = $this->bLoggedIn;
    }

    function getLoginBox() {
        ob_start();
        include('templates/login_form.html');
        $sLoginForm = ob_get_clean();

        $sLogoutForm = '<a href="'.$_SERVER['PHP_SELF'].'?logout=1">Logout</a><hr />';

        if ((int)$_REQUEST['logout'] == 1) {
            $this->simple_logout();
            header("Location: chat_room.php"); exit;
        }

        if ($_REQUEST['username'] ) {
            if ($this->check_login($_REQUEST['username'])) {
                $this->simple_login($_REQUEST['username']);

                header("Location: chat_room.php"); exit;
            } else {
                return 'Username is incorrect' . $sLoginForm;
            }
        } else {
            if ($_COOKIE['member_name']) {
                if ($this->check_login($_COOKIE['member_name'])) {
                    return 'Hello ' . $_COOKIE['member_name'] . '! ' . $sLogoutForm;
                }
            }
            return $sLoginForm;
        }
    }

    function simple_login($sName) {
        $this->simple_logout();

      
        $iCookieTime = time() + 24*60*60*30;
        setcookie("member_name", $sName, $iCookieTime, '/');
        $_COOKIE['member_name'] = $sName;
        
    }

    function simple_logout() { 
        setcookie('member_name', '', time() - 96 * 3600, '/');
      
        unset($_COOKIE['member_name']);
      
    }

    function check_login($sName, $bSetGlobals = false) {
        $sNameSafe = $GLOBALS['MySQL']->process_db_input($sName, A_TAGS_STRIP);
        
        $sSQL = "SELECT `id` FROM `s_members` WHERE `name`='{$sNameSafe}' ";
        $iID = (int)$GLOBALS['MySQL']->getOne($sSQL);

        if ($bSetGlobals) {
            $this->setLoggedMemberInfo($iID);
        }

        return ($iID > 0);
    }

    function setLoggedMemberInfo($iMemberID) {
        $sSQL = "SELECT * FROM `s_members` WHERE `id`='{$iMemberID}'";
        $aMemberInfos = $GLOBALS['MySQL']->getAll($sSQL);
        $GLOBALS['aLMemInfo'] = $aMemberInfos[0];
    }
}

$GLOBALS['oSimpleLoginSystem'] = new SimpleLoginSystem();

?>