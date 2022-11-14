<?php
class FileStorage
{
    public $slug = 'C:\xampp\htdocs\prog\index';
    function create($text)
    {
        $i=0;
        $today = date("m.d.y");
        while(file_exists($file_name = $this-> slug . "_". $today . "_" . $i . ".txt")) {
            $i++;
        }
        file_put_contents($file_name, $text);

        return serialize($file_name);

    }
    function read($text_id)
    {
        return file_get_contents($text_id);
    }
    function update($text_id, $new_text)
    {
        file_put_contents($text_id, $new_text);
    }
    function delete($slug)
    {
        $file_name = $slug;
        unlink($file_name);
    }
    function list($slug)
    {
        print_r(scandir($slug));
    }
}