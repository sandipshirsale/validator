<?php
/*
 * example for email validation using validator class
 */
require_once "../vendor/autoload.php";

use codeace\validator\validator;

$valid = new validator();


if(!empty($_POST)){
    try{
        extract($_POST);
        if(!$valid->is_valid_host()){ // prevent hack
            throw new Exception("Please don't use tricks.");
        }elseif(empty($numbers)){
            throw new Exception("Please enter numbers");

        }elseif($valid->is_valid_numeric($numbers) === false) {
            throw new Exception("Please enter valid numbers.");

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
            <input type="text" tabindex="1" placeholder="Only Number" name="numbers" >
        </section>

        <section>
            <input type="submit" value="submit">
        </section>
    </section>
</form>
