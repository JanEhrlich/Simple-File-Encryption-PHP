<?php
/**
 * MIT License
 * Copyright(c) 2021 Jan Ehrlich
 * 
 * This is a simple file encryptor. It can encrypt any file content.
 * It's compatible with text files, images, videos, pdf, etc.
 * Just specify the path to the file and the key and the script will do the rest.
 * 
 * With AES-256-CBC the script is using one of the best symmetric encryption algorithms available in 2021.
 * 
 * Use the same key for de- and encryption!
 */
require_once "crypto.php";

//Specify the path to the file which should be decrypted. The file must be encrypted with the file-encryptor script, otherwise data can't be restored. 
$file_path = "example/text.txt";

//Specify the key which is used for the encryption. The key doesn't need to be extremely long because it will be hashed anyways.
$key = "KeyOfArbitraryLength";

function saveFile($dir, $content){
    $file = fopen($dir,"w");
    fwrite($file, $content);
    fclose($file);
}

function decryptFile($dir){
    global $key;

    $pltxt = "";
    $encryptedText = "";

    if (file_exists($dir)) {
        $file = fopen($dir,"r");

        if (filesize($dir) == 0){
            echo "Erro: File is Empty</br>";
        }

        if (filesize($dir) > 0){
            $encryptedText = fread($file, filesize($dir));
            $pltxt = decrypt($encryptedText, $key);
            saveFile($dir,$pltxt);
            echo "File decrypted successfully";
        }
        
        fclose($file);
    }

    return $pltxt;
}

decryptFile($file_path);

?>