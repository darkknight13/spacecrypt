<?php

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
            $msg_start = $public[0] . ' ' . $private;
            unset($public[0]);
            return $msg_start . implode(' ', $public);
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

$public = isset($_REQUEST['public']) ? $_REQUEST['public'] : null;
$private = isset($_REQUEST['private']) ? $_REQUEST['private'] : null;
$encoded = isset($_REQUEST['encoded']) ? $_REQUEST['encoded'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta property="og:title" content="Spacecrypt">
<meta property="og:url" content="https://ornot.in/spacecrypt/">
<meta property="og:description"
	content="Hide text in plain sight using secret zero-width characters. Digital spacecrypt made simple.">
<title>Spacecrypt</title>
<link rel="stylesheet" type="text/css" href="style">
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</head>
<body>

	<header>
		<nav>
			<a href="/"><span class="title">Ornot</span></a>
		</nav>
	</header>

	<main>

	<h1>Spacecrypt</h1>

	<p>
		Hide text in plain sight using secret zero-width characters. It's
		digital steganography made simple. Inspired by <a
			href="https://www.zachaysan.com/writing/2017-12-30-zero-width-characters">Zach
			Aysan</a>.
	</p>

	<p>
		Enter a public message, then a private message, and then click the
		button to hide your private message within your public message.
	</p>

	<form action="?" method="post">
		<div class="col">
			<h2>Public Message</h2>
			<textarea name="public"><?php echo $public; ?></textarea>
		</div>
		<div class="col">
			<h2>Private Message</h2>
			<textarea name="private"><?php echo $private; ?></textarea>
		</div>
		<p>
			<input type="submit" value="Encode">
		</p>
	</form>

<?php

if (isset($_REQUEST['public']) && isset($_REQUEST['private'])) {
    $spaceCrypt = new SpaceCrypt($_REQUEST['private']);
    echo '<hr><div class="col"><h2>Spacecrypt Message</h2>';
    echo '<textarea>';
    echo $spaceCrypt->encrypt($_REQUEST['public']);
    echo '</textarea>';
    echo '<br><small style="color: green;">Copy this text your private message will come along for the ride.</small>';
    echo '</div>';
}

?>

<hr>

	<div class="col">
		<form action="?" method="post">
			<h2>Reveal Private Message</h2>
			<textarea name="encoded"><?php echo $encoded; ?></textarea>
			<p>
				<input type="submit" value="Decode">
			</p>
		</form>
	</div>

<?php

if (isset($_REQUEST['encoded'])) {
    $spaceCrypt = new SpaceCrypt($_REQUEST['encoded']);
    $message = $spaceCrypt->decrypt();
    
    echo '<div class="col"><h2>Private Message</h2>';
    if (strlen($message) < 2) {
        echo '<span style="color: #993300; font-weight: bold;">No hidden message was found. :-(</span></div>';
    } else {
        echo '<span style="color: #009900; font-weight: bold;">' . $message . '</span></div>';
    }
}

?>

<hr>


	<p>
		<!-- Place this tag where you want the button to render. -->
		<a class="github-button"
			href="https://github.com/darkknight13/spacecrypt" data-size="large"
			data-show-count="true"
			aria-label="Star darkknight13/spacecrypt on GitHub">Star</a>
	</p>


	</main>
</body>
</html>
