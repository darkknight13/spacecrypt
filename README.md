# SpaceCrypt
Hide text in plain sight using zero-width secret space characters.

##
Encrypt any Text -
```php
$spaceCrypt = new SpaceCrypt("We're not the same text, even though we look the same.");
echo $spaceCrypt->encrypt("This is a Hidden Message.");
```
this will generate the message -
` This ‌​‌​‌‌‌⁠‌‌​​‌​‌⁠‌​​‌‌‌⁠‌‌‌​​‌​⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌​‌‌‌​⁠‌‌​‌‌‌‌⁠‌‌‌​‌​​⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​‌​​​⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌‌​​‌‌⁠‌‌​​​​‌⁠‌‌​‌‌​‌⁠‌‌​​‌​‌⁠‌‌‌​​​‌​⁠‌​​​​​​​⁠‌​​​‌​‌‌⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​​‌​‌⁠‌‌‌‌​​​⁠‌‌‌​‌​​⁠‌​‌‌​​⁠‌​​​​​⁠‌‌​​‌​‌⁠‌‌‌​‌‌​⁠‌‌​​‌​‌⁠‌‌​‌‌‌​⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​‌​​​⁠‌‌​‌‌‌‌⁠‌‌‌​‌​‌⁠‌‌​​‌‌‌⁠‌‌​‌​​​⁠‌​​​​​⁠‌‌‌​‌‌‌⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌​‌‌​​⁠‌‌​‌‌‌‌⁠‌‌​‌‌‌‌⁠‌‌​‌​‌‌⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​‌​​​⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌‌​​‌‌⁠‌‌​​​​‌⁠‌‌​‌‌​‌⁠‌‌​​‌​‌⁠‌​‌‌‌​is a Hidden Message.`

Now, Decrypt the Hidden Text -
```php
$spaceCrypt = new SpaceCrypt("This ‌​‌​‌‌‌⁠‌‌​​‌​‌⁠‌​​‌‌‌⁠‌‌‌​​‌​⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌​‌‌‌​⁠‌‌​‌‌‌‌⁠‌‌‌​‌​​⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​‌​​​⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌‌​​‌‌⁠‌‌​​​​‌⁠‌‌​‌‌​‌⁠‌‌​​‌​‌⁠‌‌‌​​​‌​⁠‌​​​​​​​⁠‌​​​‌​‌‌⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​​‌​‌⁠‌‌‌‌​​​⁠‌‌‌​‌​​⁠‌​‌‌​​⁠‌​​​​​⁠‌‌​​‌​‌⁠‌‌‌​‌‌​⁠‌‌​​‌​‌⁠‌‌​‌‌‌​⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​‌​​​⁠‌‌​‌‌‌‌⁠‌‌‌​‌​‌⁠‌‌​​‌‌‌⁠‌‌​‌​​​⁠‌​​​​​⁠‌‌‌​‌‌‌⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌​‌‌​​⁠‌‌​‌‌‌‌⁠‌‌​‌‌‌‌⁠‌‌​‌​‌‌⁠‌​​​​​⁠‌‌‌​‌​​⁠‌‌​‌​​​⁠‌‌​​‌​‌⁠‌​​​​​⁠‌‌‌​​‌‌⁠‌‌​​​​‌⁠‌‌​‌‌​‌⁠‌‌​​‌​‌⁠‌​‌‌‌​is a Hidden Message.");
echo $spaceCrypt->decrypt();
```
this will reveal the actual message - 
`We're not the same text, even though we look the same.`
## How This Works ##
SpaceCrypt works by converting your private message into binary data, and then converting that binary data into zero-width characters (which can then be hidden in your public message). These characters are used:

Unicode Character 'WORD JOINER' (U+2060)  
Unicode Character 'ZERO WIDTH SPACE' (U+200B)  
Unicode Character 'ZERO WIDTH NON-JOINER' (U+200C)  

## Tests ##
:white_check_mark: Slack  
:white_check_mark: Twitter  
:white_check_mark: WhatsApp  
:white_check_mark: Telegram  
:white_check_mark: Keybase  
:white_check_mark: iMessage  
:white_check_mark: MacOS general copy/paste  
:white_check_mark: Hangouts  

##

Inspired from a Article by [Zach Aysan](https://www.zachaysan.com/writing/2017-12-30-zero-width-characters)  
