<?php

class Logout extends Basic{
    
    public function logout(){
        unset($_SESSION['logged_in']);
        unset($_SESSION['userid']);
    }
  

}
