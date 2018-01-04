class SpaceCrypt
{

    protected $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function encrypt($public)
    {
        $public = explode(' ', $public);
        if (count($public) == 1) {
            $public[1] = '';
        } else {
            $str = $this->str2bin($this->string);
            $private = $this->bin2hidden($str);
            $msg_start = $public[0].' '.$private;
            unset($public[0]);
            return $msg_start. implode(' ', $public);
        }
    }

    public function decrypt()
    {
        return $this->bin2str($this->hidden2bin($this->string));
    }

    // Convert a string into binary data
    protected function str2bin($text)
    {
        $bin = array();
        for ($i = 0; strlen($text) > $i; $i ++)
            $bin[] = decbin(ord($text[$i]));
        return implode(' ', $bin);
    }

    // Convert binary data to a string
    protected function bin2str($bin)
    {
        $text = array();
        $bin = explode(' ', $bin);
        for ($i = 0; count($bin) > $i; $i ++)
            $text[] = chr(bindec($bin[$i]));
        return implode($text);
    }

    // Convert the ones, zeros, and spaces of the hidden binary data to their respective zero-width characters
    protected function bin2hidden($str)
    {
        $str = str_replace(' ', "\xE2\x81\xA0", $str); // Unicode Character 'WORD JOINER' (U+2060) 0xE2 0x81 0xA0
        $str = str_replace('0', "\xE2\x80\x8B", $str); // Unicode Character 'ZERO WIDTH SPACE' (U+200B) 0xE2 0x80 0x8B
        $str = str_replace('1', "\xE2\x80\x8C", $str); // Unicode Character 'ZERO WIDTH NON-JOINER' (U+200C) 0xE2 0x80 0x8C
        return $str;
    }

    // Convert zero-width characters to hidden binary data
    protected function hidden2bin($str)
    {
        $str = str_replace("\xE2\x81\xA0", ' ', $str); // Unicode Character 'WORD JOINER' (U+2060) 0xE2 0x81 0xA0
        $str = str_replace("\xE2\x80\x8B", '0', $str); // Unicode Character 'ZERO WIDTH SPACE' (U+200B) 0xE2 0x80 0x8B
        $str = str_replace("\xE2\x80\x8C", '1', $str); // Unicode Character 'ZERO WIDTH NON-JOINER' (U+200C) 0xE2 0x80
        return $str;
    }
}
