<?php
class Util
{

    public static function curl($url, $data = '') {
        $ch = curl_init($url);
        $header = array();
        $header[0]  = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[]   = "Cache-Control: max-age=0";
        $header[]   = "Connection: keep-alive";
        $header[]   = "Keep-Alive: 300";
        $header[]   = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[]   = "Accept-Language: en-us,en;q=0.5";
        $header[]   = "Pragma: "; // browsers keep this blank.

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        if($data!=''){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);

        return curl_exec($ch);
    }
	
	/**
	* Useful for printing any type of variable 
	* 
	* @return
	*/
    public static function p()
    {
        echo'<pre>';
        $args = func_get_args();

        foreach($args as $var)
        {
            if($var==null || $var==''){
                var_dump($var);
            }elseif(is_array($var) || is_object($var)){
                print_r($var);
            }else{
                echo $var;
            }
            echo '<br>';
        }

        echo'</pre>';
    }
	/**
	* Parses string to be a friendly/seo url
	* @param string $str
	* @param array $replace
	* @param string $delimiter
	* 
	* @return string
	*/
    public static function friendly_url($str, $replace=array(), $delimiter='-') {
        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}