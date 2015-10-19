<?php

require_once "../vendor/autoload.php";

use codeace\validator\validator;

$valid = new validator();


if(!empty($_POST)){
    try{
        extract($_POST);
        if(!$valid->is_valid_host()){ // prevent hack
            throw new Exception("Please don't use tricks.");
        }elseif(empty($char_only)){
            throw new Exception("Please enter characters");

        }elseif($valid->is_valid_alpha($char_only) === false) {
            throw new Exception("Please enter only characters.");

        }else{
            throw new Exception("Valid data submitted.");
        }
    }catch(Exception $e){
       echo $e->getMessage();
    }
}
?>
<form id="" name="signin" method="post">
    <section class="login-form">

        <section>
            <input type="text" tabindex="1" placeholder="Only Characters" name="char_only" value="">
        </section>

        <section>
            <input type="submit" value="submit">
        </section>
    </section>
</form>
