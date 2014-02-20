<?php

/**
 * Make multifile array input complaint with CI_Upload.<br>
 * For use files[ ] input name you must use it method.
 * 
 * @author porquero
 * 
 * @example
 * In Controller<br>
 * $this->load->helper('upload');<br>
 * multifile_array();<br>
 * foreach ($_FILES as $file => $file_data) {<br>
 *    $this->upload->do_upload($file);
 * ...
 *
 * @link http://porquero.blogspot.com/2012/05/codeigniter-multifilearray-upload.html
 */
function multifile_array()
{
    if(count($_FILES) == 0)
        return;
    
    $files = array();
    $all_files = $_FILES['pics']['name'];
    $i = 0;
    
    foreach ((array)$all_files as $filename) {
        $files[++$i]['name'] = $filename;
        $files[$i]['type'] = current($_FILES['pics']['type']);
        next($_FILES['pics']['type']);
        $files[$i]['tmp_name'] = current($_FILES['pics']['tmp_name']);
        next($_FILES['pics']['tmp_name']);
        $files[$i]['error'] = current($_FILES['pics']['error']);
        next($_FILES['pics']['error']);
        $files[$i]['size'] = current($_FILES['pics']['size']);
        next($_FILES['pics']['size']);
    }

    $_FILES = $files;

}

