<?php
class TelegraphText
{
public $text,$title,$author,$slug,$published;
private function storeText()
{
$textArray = [
'title' => $this-> title,
'text' => $this-> text,
'author' => $this-> author,
'published' => $this-> published
];
/*file_put_contents($this-> slug, serialize($textArray));*/
}
private function loadText()
{
if (file_exists($this->slug)) {
$arr=(unserialize(file_get_contents($this->slug)));
return $arr['text'];
//print_r($arr);
}
}
public function __get($name)
{
if ($name == "author")
{
return $this->author;
}

if ($name == "slug")
{
return $this->slug;
}
if ($name == "published")
{
return $this-> published;
}
}
public function __set($name, $value)
{
if($name == 'author') {
if (strlen($value) > 120) {
echo "Значение автор задано некоректно" . PHP_EOL;
return;
} else {
$this->author = $value;
}
}
if($name == 'slug'){
$pattern = '/^[a-z0-9._]+$/i';
if(preg_match($pattern,$value)){
$this->slug = $value;
} else {
echo 'slug проверку не прошел' . PHP_EOL;
}
}
if($name == 'published'){
if(strtotime($value) >= strtotime(date("Y-m-d"))) {
$this-> published = $value;
} else {
echo "Дата издания некоректна" . PHP_EOL;
}
}
}
public function __call($name, $arguments)
{
if ($name = 'storeText') {
$this->storeText();
}
if ($name == 'loadText') {
$this->loadText();
}
}
}