<?php

require_once "../vendor/autoload.php";

use codeace\validator\validator;

$valid = new validator();

if(!empty($_POST)){ // form submit
    try{
        extract($_POST);
        if(!$valid->is_valid_host()){ // prevent hack
            throw new Exception("Please don't use tricks.");
        }elseif(empty($email)){
            throw new Exception("Please enter email address");
        }elseif($valid->is_valid_email($email) === false) {
            throw new Exception("Please enter valid email address.");
        }else{
                throw new Exception("Valid email submitted.");
            }
    }catch(Exception $e){
       echo $e->getMessage();
    }
}
?>
<form id="" name="signin" method="post">
    <section class="login-form">
        <section>
            <input type="text" tabindex="1" placeholder="Email address" name="email" id="email" class="input">
        </section>
        <section>
            <input type="submit" value="submit">
        </section>
    </section>
</form>
