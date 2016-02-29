<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = ucwords(filter_input(INPUT_POST, 'name'));
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        // 2. display the name with only the first letter capitalized
        // JMP The name is made uppercase when it is pulled from the POST array
        
        $firstName = substr($name, 0, strpos($name, ' '));
        
        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        // 2. make sure the email address has at least one @ sign and one dot character
        // JMP You can use the input controls themselves to look for basics and require certain elements to be submitted.
        
        if (strpos($email, '@') == false || strpos($email, '.') == false){
            $emailMessage = 'Please enter a valid email';
        } else {
            $emailMessage = $email;
        }
        
        
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        // JMP If I'm going to format the phone number I'd like to use parenthesis.
        // JMP There are a few people out there who have written regex...es to completely format phone numbers
        // JMP HOWEVER I don't understand the internal syntax so here have something horrible.
        
        $phone = preg_replace("/[,.()-]/", "", $phone);
        
        if (strlen($phone) < 7 || strlen($phone) > 10 || strlen($phone) == 8 || strlen($phone) == 9) {
            $phoneMessage = 'Please enter a valid US phone number';
        } else if (strlen($phone) == 10) {
            $phoneMessage = "(".substr($phone, 0, 3).")".substr($phone, 3, 3)."-".substr($phone, 6, 4);
        } else {
            $phoneMessage = substr($phone, 0, 3)."-".substr($phone, 3, 4);
        }

        /*************************************************
         * Display the validation message
         ************************************************/
        $message = "Hello $firstName, \n \n".
                    "Name: $name \n" . 
                    "Email: $emailMessage  \n" . 
                    "Phone: $phoneMessage\n" ;

        break;
}
include 'string_tester.php';
?>