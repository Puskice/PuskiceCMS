<?php
class Puskice {

	public static function add3dots($string, $length=20){
		if(strlen($string) > $length+2){
			$space_pos = strrpos(substr($string, 0, $length), " ");
			$string = substr($string, 0, $space_pos);
			$string .= "...";
		}
		return $string;
	}

	public static function stripURLquery($url){
		return preg_replace('/\?.*/', '', $url);
	}

	public static function url_slug($str, $options = array()) {
			// Make sure string is in UTF-8 and strip invalid UTF-8 characters
			$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
			
			$defaults = array(
				'delimiter' => '-',
				'limit' => null,
				'lowercase' => true,
				'replacements' => array(),
				'transliterate' => true,
			);
			
			// Merge options
			$options = array_merge($defaults, $options);
			
			$char_map = array(
				// Latin
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
				'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
				'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
				'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
				'ß' => 'ss', 
				'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
				'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
				'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
				'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
				'ÿ' => 'y',
		 
				// Latin symbols
				'©' => '(c)',
		 
				// Greek
				'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
				'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
				'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
				'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
				'Ϋ' => 'Y',
				'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
				'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
				'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
				'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
				'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
		 
				// Turkish
				'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
				'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
		 
				// Russian
				'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Z',
				'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
				'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
				'Ч' => 'C', 'Ш' => 'S', 'Щ' => 'S', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
				'Я' => 'Ya',
				'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'z',
				'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
				'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
				'ч' => 'c', 'ш' => 's', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
				'я' => 'ya', 'Ђ' => 'Dj', 'ђ' => 'dj', 'Љ' => 'Lj', 'љ' => 'lj', 'Њ' => 'Nj', 'њ' => 'nj',
				'Ћ' => 'c', 'ћ' => 'c', 'Џ' => 'Dz', 'џ' => 'dz',
		 
				// Ukrainian
				'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
				'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
		 
				// Czech
				'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
				'Ž' => 'Z', 
				'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
				'ž' => 'z', 'đ' => 'dj', 'Đ' => 'dj',
		 
				// Polish
				'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
				'Ż' => 'Z', 
				'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
				'ż' => 'z', 'ј' => 'j', 'Ј' => 'J',
		 
				// Latvian
				'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
				'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
				'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
				'š' => 's', 'ū' => 'u', 'ž' => 'z'
			);
			
			// Make custom replacements
			$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
			
			// Transliterate characters to ASCII
			if ($options['transliterate']) {
				$str = str_replace(array_keys($char_map), $char_map, $str);
			}
			
			// Replace non-alphanumeric characters with our delimiter
			$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
			
			// Remove duplicate delimiters
			$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
			
			// Truncate slug to max. characters
			$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
			
			// Remove delimiter from ends
			$str = trim($str, $options['delimiter']);
			
			return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
		}


	public static function getPostTypeBadge($post_type){
		switch ($post_type) {
			case '1': // news
				return '<span class="label label-info">News</span> ';
				break;
			case '2': //pages
				return '<span class="label">Page</span> ';
				break;
			case '3': //subjects
				return '<span class="label label-important">Subject</span> ';
				break;

			default:
				# code...
				break;
		}
	}

	public static function getIP() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	        $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	 
	    return $ipaddress;
	}

	public static function userLevel($int){
		switch ($int) {
			case ($int < 10):
				return "Regular user";
				break;
			case ($int >= 10):
				return "Administrator";
				break;

			default:
				return "Unknown";
				break;
		}
	}

	public static function dateToUrl($date){
		$url = substr($date, 8, 2);
		$url .= substr($date, 5, 2);
		$url .= substr($date, 0, 4);
		return $url;
	}

	public static function urlToDate($url){
		$date = substr($url, 4, 4);
		$date .= "-".substr($url, 2, 2);
		$date .= "-".substr($url, 0, 2);
		return $date;
	}

	public static function getYear($int){
		switch ($int) {
			case '1':
			case '2':
				return 'prva';
				break;
			case '3':
			case '4':
				return 'druga';
				break;
			case '5':
			case '6':
				return 'treca';
				break;
			case '7':
			case '8':
				return 'cetvrta';
				break;
			
			default:
				return false;
				break;
		}
	}

	public static function getDepartment($int){
		switch ($int) {
			case 0:
				return "zajednicke-osnove";
				break;
			case 1:
				return "informacioni-sistemi-i-tehnologije";
				break;
			case 2:
				return "menadzment";
				break;
			case 3:
				return "operacioni-menadzment";
				break;
			case 4:
				return "upravljanje-kvalitetom";
				break;
			default:
				return false;
				break;
		}
	}

	public static function magazineBadges($int){
		switch ($int) {
			case 2:
				return "it";
				break;
			case 3:
				return "biz";
				break;
			case 23:
				return "fun";
				break;
			default:
				return "mag";
				break;
		}
	}

	public static function firstImage($post, $thumb=false) {
		$protocol = isset($_SERVER['HTTPS']) ? 'https:' : 'http:';
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->long_content, $matches);
		if($post->featured_image != ""){
			$first_img = $post->featured_image;
		}
		elseif(isset($matches[1][0])){
			$first_img = $matches [1] [0];	
		}
		else{
			$first_img = Request::root()."/puskice2.png";
			return $first_img;
		}
		if($thumb){
			$fi = explode("/", $first_img);
			$fi[5] = ".thumbs/".$fi[5];
			$fihelp = $fi;
			unset($fihelp[0]); unset($fihelp[1]); unset($fihelp[2]);
			if(file_exists(PUBLIC_DIR.implode("/", $fihelp))){
				$first_img = implode("/", $fi);	
			}
		}
		if(!strstr($first_img, "puskice.org")){
			$first_img = $protocol."//www.puskice.org/".$first_img;
		}
		if(!strstr($first_img, "http:") && !strstr($first_img, "https:")){
			$first_img = $protocol.$first_img;
		}

		return $first_img;
	}

	public static function firstContactImage($post) {
		$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https:' : 'http:';
		$first_img = '';
		ob_start();
		ob_end_clean();
		if($post->image != "") return $post->image;
		
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->description, $matches);
		if(isset($matches[1][0])){
			$first_img = $matches [1] [0];	
			if(!strstr($first_img, "puskice.org")){
				$first_img = "//www.puskice.org/".$first_img;
			}
		}
		else{
			$first_img = Request::root()."/puskice2.png";
		}

		return $first_img;
	}


	/*
	 * Method to strip tags globally.
	 */
	public static function globalXssClean()
	{
	    // Recursive cleaning for array [] inputs, not just strings.
	    $sanitized = static::arrayStripTags(Input::get());
	    Input::merge($sanitized);
	}
	 
	public static function arrayStripTags($array)
	{
	    $result = array();
	 	
	    foreach ($array as $key => $value) {
	    	//if($key == "long_content" || $key == "short_content" || $key=="category") continue;
	        // Don't allow tags on key either, maybe useful for dynamic forms.
	        $key = strip_tags(htmlspecialchars($key));
	 
	        // If the value is an array, we will just recurse back into the
	        // function to keep stripping the tags out of the array,
	        // otherwise we will set the stripped value.
	        if (is_array($value)) {
	            $result[$key] = static::arrayStripTags($value);
	        } else {
	            // I am using strip_tags(), you may use htmlentities(),
	            // also I am doing trim() here, you may remove it, if you wish.
	            $result[$key] = trim(strip_tags(htmlspecialchars($value)));
	        }
	    }
	 
	    return $result;
	}

	public static function getThumb($image){
		$fi = explode("/", $image);
		$fi[5] = ".thumbs/".$fi[5];
		$fihelp = $fi;
		unset($fihelp[0]); unset($fihelp[1]); unset($fihelp[2]);
		if(file_exists(PUBLIC_DIR.implode("/", $fihelp))){
			$image = implode("/", $fi);	
		}
		var_dump($image);
		return $image;
	}
}

	