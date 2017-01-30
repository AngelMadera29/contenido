<?php

// generate a preview image from an FLV file on-the-fly, or to save
// Will - 10-16-07
// call with: ffmpeg_image.php?file=video.flv&time=00:00:05&browser=true
// call with: ffmpeg_image.php?file=video.flv&percent=75.3&browser=true
// no time defaults to "00:00:00" (first frame), no browser defaults to "true"

$videofile = (isset($_GET['file'])) ? strval($_GET['file']) : 'video.flv';
$image = substr($videofile, 0, strlen($videofile) - 4);

// debug ("    File: ", $videofile);
// debug ("   Image: ", $image);

$time = (isset($_GET['time'])) ? strval($_GET['time']) : '00:00:00';

// check time format
if (!preg_match('/\d\d:\d\d:\d\d/', $time))
{
  $time = "00:00:00";
}

// debug ("    Time: ", $time);

if (isset($_GET['percent']))
{
  $percent = $_GET['percent'];

 
// debug (" Percent: ", $percent);

 
ob_start();
  passthru("ffmpeg -i \"". $videofile . "\" 2>&1");
  $duration = ob_get_contents();
  ob_end_clean();

 
// debug ("Duration: ", $duration);

 
preg_match('/Duration: (.*?),/', $duration, $matches);
  $duration = $matches[1];

 
// debug ("Duration: ", $duration);

 
$duration_array = split(':', $duration);
  $duration = $duration_array[0] * 3600 + $duration_array[1] * 60 + $duration_array[2];
  $time = $duration * $percent / 100;

 
// debug ("    Time: ", $time);

 
$time = intval($time/3600) . ":" . intval(($time-(intval($time/3600)*3600))/60) . ":" . sprintf("%01.3f", ($time-(intval($time/60)*60)));

 
// debug ("    Time: ", $time);

}

$browser = (isset($_GET['browser'])) ? strval($_GET['browser']) : 'true';

// debug (" Browser: ", $browser);

if ($browser == "true")
{
  header('Content-Type: image/png');
  passthru("ffmpeg -vcodec png -i \"" . $videofile . "\" -ss " . $time . " -vframes 1 -f image2 -");
}
else
{
  passthru("ffmpeg -vcodec png -i \"" . $videofile . "\" -ss " . $time . " -vframes 1 -f image2 \"" . $image . "\"%d.png");
}

function
debug($text1, $text2)
{
  print "<pre>\n";
  print $text1 . $text2 . "\n";
  print "</pre>\n";
}

?>
