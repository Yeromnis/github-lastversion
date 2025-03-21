<?php
/**
 * github-lastversion
 * 
 * PHP class/script to get the last version tag from a GitHub repository
 * 
 * @version 1.0 
 * @author Yeromnis
 * @link https://github.com/Yeromnis/github-lastversion
 */

class GitHub {
    
    public static function getLastRelaseVersion($repo) {   
        // initialize a cURL session
        $ch = curl_init();
        // set the repo URL
        curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/$repo/releases/latest");
        // set an arbitrary User-Agent (required by GitHub)
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13');   
        // output wanted as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // execute
        $output = curl_exec($ch);
        // if error, throw an exception
        if(curl_error($ch)) {
            throw new Exception("ERROR: ".curl_error($ch), 1);
        }
        // close the cURL session
        curl_close($ch);     
        // parse JSON
        $obj = json_decode($output);
        // if repo not found (404), return null
        if ((isset($obj->status)) && ($obj->status == "404")) {
            return null;
        }
        // read version
        $result = $obj->tag_name;
        return $result;
    }
    
}


// is the script being run from the command line?
if (isset($argv)) {
    // is the repository given as a parameter?
    if (isset($argv[1])) {
        try {
            $result = GitHub::getLastRelaseVersion($argv[1]);
            echo $result;
            ($result != null) ? exit(0) : exit(1);
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
            exit(1);
        }
    } else {
        echo "Syntax: php github-lastversion.php [githubuser]/[githubrepository]\n";
        exit(1);
    }    
}


?>
