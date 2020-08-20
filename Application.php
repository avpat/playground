<?php

namespace Src;

class Application 
{

    /**
     * An applicayion that you are implementing requires multiple date formatscto be transforemed into one date format
     * implemenet the function which accepts a list of strings represnting dates and returns a new list with each date in the format YYYYMMDD
     * All incoming dates will valid dates but only one of the following format: YYYY/MM/DD, DD-MM-YYYYY should be included in the return list.
     * Eg. changeDateFormat(array("2010/03/30", "15/12/2016", "11-12-2010", "20131010")); shourld return ["20100330", "20161512", "20101112"]
     *
     */
    public function changeDateFormat(array $dates) : array
    {
        //define return array
        $data = [];
        //validate the dates array
        if(is_array($dates) && !empty($dates))
        {
            foreach ($dates as $date)
            {

                //check the format.. if it is not YYYYMMDD i.e. 8
                if(!preg_match('/^d{8}/', $date))
                {
                    array_push($data, $this->transformDate($date));
                }

            }

        }
        //transform into given date format
        return $data;

    }

    /**
     * @param $date
     * @return datetime
     */
    private function transformDate($date) : string
    {
        //check if the date is valid
        $d = date("Ymd", strtotime($date));

        return $d;

    }


    /**
     * write a function thaat removes all items that are not interger frrom the array
     * the function should modify the existing array, not create a new one
     *
     * for example if the input array contains [1, 'a', 'b', 2, 3] then it should only return 1,2, 3
     */

    public function filterArray( &$givenArray) : array
    {
        $filtered = array_filter($givenArray, 'is_numeric');

        return $filtered;


    }

    /**
     * since the amount of data stored in a cookie can't exceed 4kb, modify the code so that data are stored in the session
     *
     */
   // namespace test;

    function appendRend() : void
    {

        //initialise session
        session_start();
        //unset all the session variables
        $_SESSION = [];
        //now check cookie data size
        if(isset($_COOKIE['data'])) {

            $data = $_COOKIE['data'];
            $serialise = serialize($data);
            $size = strlen($serialise) * 8/1024;
            if($size > 4)
            {
                $_SESSION['data'] = $_COOKIE['data'];
                //now unset the cookie
                unset($_COOKIE['data']);
            }
        } else {
            $data = "";
        }

        $data .= rand(0, 9);
//        $data = $_COOKIE['data'];
        $serialise = serialize($data);
        $size = strlen($serialise) * 8/1024;
        if($size > 4)
        {
            $_SESSION['data'] = $data;
            //now unset the cookie
            unset($_COOKIE['data']);
        } else{
            setcookie('data', $data);
        }

    }

    /**
     * @param array $array
     * @return array
     */
    public function prependSum(array &$array) :array
    {
        $sum = array_sum($array);

        array_unshift($array, $sum);
        return $array;
    }






    /**
     * @param $getResults
     */
    public function displayResults($getResults)
    {

        echo '<ul style="background-color: #dddddd; margin-bottom: 1em;
                padding: 12px 8px;
                width: auto;
                max-height: 600px;">';
        if(is_array($getResults)) {
            foreach ($getResults as $result) {
                echo "<li>". $result ."</li>";
            }
        } else {
            echo "<li>". $getResults ."</li>";
        }


        echo '</ul>';

//        return $output;
    }


    /**
     * CONDITIONS: username can be between 6 to 16 chars
     * no spaces allowed
     * only letters, numbers and -
     * first char must be a letter and last cannot be a -
     */

//    public function validate(string $username) : bool
//    {
//        //check the password length
//        if(strlen($username) < 6 || strlen($username) > 16)
//        {
//            return false;
//        }
//
//        //check with regex, if the username contains only letters nums and -
//        elseif(preg_match('/[A-Za-z0-9-]/', $username))
//        {
//            //check spaces
//            $str = trim($username);
//            if($username == trim($username) && strpos($username, ' '))
//            {
//                return false;
//            }
//            else {
//                //  first char must be a letter and last cannot be a -
//                //Get the first character.
//                $firstCharacter = $username[0];
//                $lastCharacter = substr($username, -1);
//                if(preg_match('/[A-Za-z]/', $firstCharacter) && preg_match('/[A-Za-z]/', $lastCharacter))
//                {
//                    return true;
//                }
//            }
//
//
//        }
//        return false;
//    }

    function validate(string $username) : bool
    {
        //check the username length
        if(strlen($username) <= 6 || strlen($username) >= 16)
        {
            return false;
        }
        elseif(preg_match('/[A-Za-z0-9-]/', $username))
        {
            //check spaces
            $str = trim($username);
            if($username == trim($username) && strpos($username, ' '))
            {
                return false;
            }
            else
            {
print_r("suvcces");
                //the username must start with a letter and must not end with a hyphen

                $firstCharacter = $username[0];
                $lastCharacter = substr($username, -1);
                if(preg_match('/[A-Za-z](?:-)? /', $firstCharacter) && preg_match('/[A-Za-z]/', $lastCharacter))
                {
                    print_r("23");
                    //  The username must contain only letters, numbers and optionally -
                    if(preg_match('/[A-Za-z][0-9]/', $username)) {
                        print_r("33");
                        return true;
                    } else {
                        return false;
                    }


                }

            }
        }

        return false;
    }



    public function numberOfItems(array $arr, $item) : int
    {
        $counter = 0;
//if arr is array then
        if(is_array($arr))
        {
            //loop through
            foreach ($arr as $val)
            {
                //if arr vaalue is not subarray then
                if(!is_array($val)) {
                    if($item == $val) {
                        $counter++;
                    }
                } else {
                    //call recursively
                    $this->numberOfItems($val, $item);
                }
            }
        }
        return $counter;

    }
    function callAPI($method, $url, $data){
        $curl = curl_init();
        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'APIKEY: 111111111111111111111',
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
     }



}