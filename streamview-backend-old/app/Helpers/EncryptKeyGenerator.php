<?php 

namespace App\Helpers;

class EncryptKeyGenerator {

public static function updateKeyInfoFile(string $keu_info_path, string $key_path, string $url, int $length = 16): void {
    if (!extension_loaded('openssl')) {
        throw new \Exception('OpenSSL is not installed.');
    }
    file_put_contents($key_path, openssl_random_pseudo_bytes($length));
    
    file_put_contents($keu_info_path, implode(PHP_EOL, [$url, $key_path, bin2hex(openssl_random_pseudo_bytes($length))]));
}

public static function check($keyinfo, $key, $keypath) {

	$i = 1;

	while(true) {

	    $keu_info_path = sys_get_temp_dir().DIRECTORY_SEPARATOR.$keyinfo;
	    
	    $key_path = $key . "-" . $i . ".key";
	    
	    $url = $keypath . "-" . $i . ".key";;

	    self::updateKeyInfoFile($keu_info_path, $key_path, $url);

	    $i++;

	    sleep(10);
	}

}

}
