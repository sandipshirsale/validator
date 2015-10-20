<?php
/***********************************************************************************/
## Class Name - Validator (Contains all the validation functions )
## Created By - Codeace (14/07/2014)
/***********************************************************************************/

namespace codeace\validator;

class validator
{
    
    private $exp_email 		  = FILTER_VALIDATE_EMAIL;
    private $exp_float 		  = FILTER_VALIDATE_FLOAT;
    private $exp_int 		  = FILTER_VALIDATE_INT;
    private $exp_ip 		  = FILTER_VALIDATE_IP;
    private $exp_regexp 	  = FILTER_VALIDATE_REGEXP;
    private $exp_url 		  = FILTER_VALIDATE_URL;
    private $exp_date 		  = "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2}\$";
    private $exp_amount 	  = "^[-]?[0-9]+\$";
    private $exp_notempty 	  = "[a-z0-9A-Z]+";
    private $exp_nospchar 	  = "/[\'^£$%&*()}{@#~?><>,|=_+¬-]/";
    private $exp_spchar 	  = "/[\'^£$%&*()}{@#~?><>,|=_+¬-]/";
    private $exp_number 	  = "^[-]?[0-9,]+\$";
    private $exp_words 		  = "^[A-Za-z]+[A-Za-z \\s]*\$";
    private $exp_phone 		  = "^[0-9]{10,11}\$";
    private $exp_zipcode 	  = "^[1-9][0-9]{3}[a-zA-Z]{2}\$";
    private $exp_plate 		  = "^([0-9a-zA-Z]{2}[-]){2}[0-9a-zA-Z]{2}\$";
    private $exp_price 		  = "[0-9.,]*(([.,][-])|([.,][0-9]{2}))?\$";
    private $exp_2digitopt 	  = "^\d+(\,\d{2})?\$";
    private $exp_2digitforce  = "^\d+\,\d\d\$";
    private $exp_anything 	  = "[\d\D]{1,}\$";
    private $country_code 	  = "US";
    private $port 	          = ":85";
    private $arrCardTypes = array(
        'Amex' => array(
            'name'		=>	'American Express',
            'active'	=> 	true,
            'iinrange' 	=> 	'34,37',
            'length'	=> 	15,
            'cvvlen'	=> 	15,
        ),
        'Discover' => array(
            'name'		=>	'Discover',
            'active'	=> 	true,
            'iinrange' 	=> 	'6011,622126-622925,644-649,65',
            'length'	=> 	16,
            'cvvlen'	=> 	15,
        ),
        'MasterCard' => array(
            'name'		=>	'MasterCard',
            'active'	=> 	true,
            'iinrange' 	=> 	'51-55',
            'length'	=> 	16,
            'cvvlen'	=> 	15,
        ),
        'Visa' => array(
            'name'		=>	'VISA',
            'active'	=> 	true,
            'iinrange' 	=> 	'4',
            'length'	=> 	16,
            'cvvlen'	=> 	15,
        )
    );
    
    ## Constructor
    function Model_Validator()
    {
       
    }
    
    ##--------- called the destructor to unset the class object ----------------##
    public function __destruct()
    {
        unset($this);
    }
    ##---------------------------- Custom function start from here -----------------#
    
    
    /**
     *	check is value not empty
     */
    function is_valid_noempty($value)
    {
        $value = trim($value);
        if (!preg_match($this->exp_notempty, $value)) {
            return false;
        } else {
            return true;
        }
    }
    
    
    /**
     *	check value is valid email
     */
    function is_valid_email($value)
    {
        if (filter_var($value, $this->exp_email) === false) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *	check value is valid URL
     */
    function is_valid_url($value)
    {
        if (filter_var($value, $this->exp_url) === false) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *	check value contain the valid domain name as per given
     */
    function is_valid_domain($value,$domain)
    {
        if (strpos($value, $domain) !== FALSE) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
     *	check value is valid Float value
     */
    function is_valid_float($value)
    {
        if (filter_var($value, $this->exp_float) === false) {
            return false;
        } else {
            return true;
        }
    }
    
    
    /**
     *	check value is valid integer value
     */
    function is_valid_int($value)
    {
        if (filter_var($value, $this->exp_int) === false) {
            return false;
        } else {
            return true;
        }
    }
    
    
    /**
     *	check value is valid integer value
     */
    function is_valid_text($value)
    {
        if (filter_var($value, $this->exp_text) === false) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *	check value is valid Ip address
     */
    function is_valid_ip($value)
    {
        if (filter_var($value, $this->exp_ip) === false) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *	check value is valid Phone Number
     */
    function is_valid_phone($value, $format = '##########')
    {
        if(ctype_digit($value)){
            if ($format) {
                $formats = array(
                    $format
                );
            } else {
                $formats = array(
                    '###-###-####',
                    '####-###-###',
                    '(###) ###-###',
                    '####-####-####',
                    '##-###-####-####',
                    '####-####',
                    '###-###-###',
                    '#####-###-###',
                    '##########',
                    '##########',
                    '# ### #####',
                    '#-### #####'
                );
            }
			
            $value = trim(preg_replace('/[0-9]/', '#', $value));
            return (in_array($value, $formats)) ? true : false;
        }else{
            return false;
        }
    }
    
    /**
     *	check value is numeric value
     */
    function is_valid_numeric($value)
    {
        if (!is_numeric($value)) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *	check value is alpha numeric value
     */
    function is_valid_alphanumeric($value)
    {
        if (!ctype_alnum($value)) {
            return false;
        } else {
            return true;
        }
    }
    
    
    /**
     *	check value is without special characters value
     */
    function is_valid_nospchars($value)
    {
        if (!preg_match($this->exp_nospchar, $value)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
     *	check value is contain special characters or not
     */
    function is_valid_spchars($value)
    {
        if (preg_match($this->exp_spchar, $value)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     *	check value is alpha bets value
     */
    function is_valid_alpha($value)
    {
        if (!ctype_alpha($value)) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *	check value is valid price
     */
    function is_valid_price($value)
    {
        if (preg_match($this->exp_price, $value)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
     *	test post is valid or not as per country ,
     *	set default country as per requirement is the constructor
     *	ZIP (POSTAL) Code Validation Regex & PHP code for 12 Countries
     */
    
    function is_valid_zip($value, $country_code = '')
    {
        
        $ZIPREG = array(
            "US" => "^\d{5}([\-]?\d{4})?$",
            "UK" => "^(GIR|[A-Z]\d[A-Z\d]??|[A-Z]{2}\d[A-Z\d]??)[ ]??(\d[A-Z]{2})$",
            "DE" => "\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b",
            "CA" => "^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$",
            "FR" => "^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$",
            "IT" => "^(V-|I-)?[0-9]{5}$",
            "AU" => "^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$",
            "NL" => "^[1-9][0-9]{3}\s?([a-zA-Z]{2})?$",
            "ES" => "^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$",
            "DK" => "^([D-d][K-k])?( |-)?[1-9]{1}[0-9]{3}$",
            "SE" => "^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$",
            "BE" => "^[1-9]{1}[0-9]{3}$"
        );
        
        if ($country_code == '') {
            $country_code = $this->country_code;
        }
        
        if (!preg_match("/" . $ZIPREG[$country_code] . "/i", $value)) {
            return false;
        } else {
            return true;
        }
        
    }
    

    /**
     *	sanitize the cross site scription
     */
    function sanitize_xss($value)
    {
        $value = addslashes(htmlentities(trim($value)));
        #$value = addslashes(htmlspecialchars(trim($value)), ENT_QUOTES); //eg
    }
    
    /**
     *	sanitize the the valid http request header with site domain
     */
    function is_valid_host()
    {
        $value = $_SERVER['HTTP_REFERER'];
        $data = parse_url($value);
        if ($data['host'].$this->port == $_SERVER['HTTP_HOST']) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     *	regenerate the new session after user login activity or as per requirement
     */
    function regenerate_session()
    {
        return  session_regenerate_id();
    }

    
    function is_valid_expiry($month,$year){
        if(!is_numeric($month)){
            return false;
        }else if(!is_numeric($year)){
            return false;
        }else{
            if (!preg_match('/^\d{1,2}$/', $month)) {return false;}
            else if (!preg_match('/^\d{4}$/', $year)) {return false;}
            else if ($year < date("Y")) {return false;}
            else if ($month < date("m") && $year == date("Y")) {return false;}
            return true;
        }
    }
    
    function is_valid_card_type($creditCardType){
        if(($creditCardType !== null) && !array_key_exists($creditCardType, $this->arrCardTypes)) {
            return false;
        }else{
            return true;
        }
    }
    
    function is_valid_cvv($cardNumber,$cvv){
           
        $firstnumber = (int) substr($cardNumber, 0, 1);
        if ($firstnumber === 3) {if (!preg_match("/^\d{4}$/", $cvv)){return false;}}
        else if (!preg_match("/^\d{3}$/", $cvv)) {return false;}
        return true;   
        
		
    }

    function pre($array , $exit = true){
        $array = (array) $array;
        echo '<pre>';
        print_r($array);
        echo '</pre>';

        if($exit){
            exit;
        }
    }

}
