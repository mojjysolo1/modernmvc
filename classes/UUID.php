<?php
class UUID extends Controller{


    public function getUUID() 
	{
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand(0, 0xffff), mt_rand(0, 0xffff),
		mt_rand(0, 0xffff),
		mt_rand(0, 0x0fff) | 0x4000,
		mt_rand(0, 0x3fff) | 0x8000,
		mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

    function uuidToHex($uuid) {
        return str_replace('-', '', $uuid);
    }

    function hexToUuid($hex) {
        $regex = '/^([\da-f]{8})([\da-f]{4})([\da-f]{4})([\da-f]{4})([\da-f]{12})$/';
        return preg_match($regex, $hex, $matches) ?
            "{$matches[1]}-{$matches[2]}-{$matches[3]}-{$matches[4]}-{$matches[5]}" :
            FALSE;
    }

     function hexToIntegers($hex) {
         $bin = pack('h*', $hex);
         return unpack('L*', $bin);
     }

     function integersToHex($integers) {
         $args = $integers; $args[0] = 'L*'; ksort($args);
           $bin = call_user_func_array('pack', $args);
           $results = unpack('h*', $bin);
           return $results[1];
       }

       function uuidToIntegerArray($uuid) {
           $hexadecimal=$this->uuidToHex($uuid);
        $integers = $this->hexToIntegers($hexadecimal);

        return $integers;

      }

}
