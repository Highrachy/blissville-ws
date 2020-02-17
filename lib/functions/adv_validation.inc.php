<?php

function whole_number($value){
	if (PHP_VERSION >= 5.2)
		return filter_var($value, FILTER_VALIDATE_INT);
	else return is_int($value);

}

function decimal_number($value){
	if (PHP_VERSION >= 5.2)
		return filter_var($value, FILTER_VALIDATE_FLOAT);
	else return is_float($value);

}


function email_exist($email){
        $email_error = false;
        $Email = htmlspecialchars(stripslashes(strip_tags(trim($email))));
        if ($Email == '') { $email_error = true; }
        elseif (!eregi('^([a-zA-Z0-9._-])+@([a-zA-Z0-9._-])+\.([a-zA-Z0-9._-])([a-zA-Z0-9._-])+', $Email)) {
			 $email_error = true; }
        else {
        list($Email, $domain) = split('@', $Email, 2);
                if (!checkdnsrr($domain, 'MX')) { $email_error = true; }
                else {
                $array = array($Email, $domain);
                $Email = implode('@', $array);
                }
        }

        if ($email_error) { return false; } else{return true;}
}



function is_valid_colour($color){
        #CCC
        #CCCCC
        #FFFFF
        return preg_match('/^#(?:(?:[a-f0-9]{3}){1,2})$/i', $color);
}

function is_valid_ip($ip)
{
	if (PHP_VERSION >= 5.2)
	  return filter_var($ip, FILTER_VALIDATE_IP);
	  else return preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$ip);
}

function is_valid_url($url)
{
  return filter_var($url, FILTER_VALIDATE_URL);
}

function url_exist($url)
{
		$url = @parse_url($url);

		if (!$url)
		{
				return false;
		}

		$url = array_map('trim', $url);
		$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
		$path = (isset($url['path'])) ? $url['path'] : '';

		if ($path == '')
		{
				$path = '/';
		}

		$path .= (isset($url['query'])) ? '?$url[query]' : '';

		if (isset($url['host']) AND $url['host'] != @gethostbyname($url['host']))
		{
				if (PHP_VERSION >= 5)
				{
						$headers = @get_headers('$url[scheme]://$url[host]:$url[port]$path');
				}
				else
				{
						$fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);

						if (!$fp)
						{
								return false;
						}
						fputs($fp, 'HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n');
						$headers = fread($fp, 4096);
						fclose($fp);
				}
				$headers = (is_array($headers)) ? implode('\n', $headers) : $headers;
				return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
		}
		return false;
}


?>