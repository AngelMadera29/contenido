<?php

include('GIFEncoder.class.php');
function replace_extension($filename, $new_extension) {
    return preg_replace('/\..+$/', '.' . $new_extension, $filename);
}
function round_nearest($no,$near)
{
    return round($no/$near)*$near;
}

#
# Esta función comprueba si existe el preview de la película y si no existe lo crea.
# 
#=================================================================================

function comprobar_previsualizacion($pelicula,$carpeta_previsualizaciones,$solo_thumb)
{


$anchura_param=212;
$altura_param=120;
$cuadros=10;
$segundos=1;

$array_path=array_reverse(explode('/',$pelicula));
$nombre_pelicula=$array_path[0];
$fichero_gif=$carpeta_previsualizaciones.'/'.replace_extension($nombre_pelicula,'gif');


if ($solo_thumb==1)
{
	if (file_exists($fichero_gif))
		return;
	$cuadros=2;
	file_put_contents($fichero_gif,"");
}

$FfmpegMovie = new ffmpeg_movie($pelicula);
/*
$FfmpegMovie->getDuration();
$FfmpegMovie->getFrameRate();
$FfmpegMovie->getFilename();
$FfmpegMovie->getComment();
$FfmpegMovie->getTitle();
$FfmpegMovie->getFrameHeight();
$FfmpegMovie->getFrameWidth();
$FfmpegMovie->getAudioBitRate();
$FfmpegMovie->getFrameNumber();
$FfmpegMovie->getVideoCodec();
$FfmpegMovie->getAudioCodec();
$FfmpegMovie->getAudioChannels();
*/

$fotogramas=$FfmpegMovie->getFrameCount();
if ($fotogramas<$cuadros)
	$cuadros=$fotogramas;
if ($fotogramas==0)
	return;
for ($i=1;$i<=$cuadros;$i++)
{
	if ($solo_thumb=="1")
		$Fotograma[$i]=$FfmpegMovie->getNextKeyFrame();
	else
	{
		$Fotograma[$i]=$FfmpegMovie->getFrame(floor($fotogramas*$i/$cuadros));
		//$Fotograma[$i]=$FfmpegMovie->getNextKeyFrame();
		//echo $Fotograma[$i];
		if ($Fotograma[$i]==false)
			$Fotograma[$i]=$Fotograma[$i-1];
		if (!isset($Fotograma[$i])||($Fotograma[$i]==false))
			return;
	}
}
//$Frame1=$FfmpegMovie->getFrame(floor($fotogramas/5));
//$Frame2=$FfmpegMovie->getFrame(floor($fotogramas*2/5));
//$Frame3=$FfmpegMovie->getFrame(floor($fotogramas*3/5));
//$Frame4=$FfmpegMovie->getFrame(floor($fotogramas*4/5));
//$Frame5=$FfmpegMovie->getFrame($fotogramas);

$anchura=$Fotograma[1]->getWidth();
$altura=$Fotograma[1]->getHeight();


if ($anchura>=$altura)
{
	$anchura_final=250;
	$altura_final=round_nearest($altura/($anchura/250),2);
}
else
{
	$altura_final=140;
	$anchura_final=round_nearest($anchura/($altura/140),2);
}
for ($i=1;$i<$cuadros;$i++)
{
	$Fotograma[$i]->resize($anchura_final, $altura_final);
	$gd_imagen[$i]=$Fotograma[$i]->toGDImage();
	ob_start();
	imagegif($gd_imagen[$i]);
	$frames[]=ob_get_contents();
	$framed[]=$segundos*100;
	ob_end_clean();
}

/*

$Frame1->resize($anchura_final, $altura_final);
$Frame2->resize($anchura_final, $altura_final);
$Frame3->resize($anchura_final, $altura_final);
$Frame4->resize($anchura_final, $altura_final);
//$Frame5->resize($anchura_final, $altura_final);

$gd_image1=$Frame1->toGDImage();
$gd_image2=$Frame2->toGDImage();
$gd_image3=$Frame3->toGDImage();
$gd_image4=$Frame4->toGDImage();
//$gd_image5=$Frame5->toGDImage();


ob_start();
imagegif($gd_image1);
$frames[]=ob_get_contents();
$framed[]=200; // Delay in the animation.
ob_end_clean();

ob_start();
imagegif($gd_image2);
$frames[]=ob_get_contents();
$framed[]=200; // Delay in the animation.
ob_end_clean();

ob_start();
imagegif($gd_image3);
$frames[]=ob_get_contents();
$framed[]=200; // Delay in the animation.
ob_end_clean();

ob_start();
imagegif($gd_image4);
$frames[]=ob_get_contents();
$framed[]=200; // Delay in the animation.
ob_end_clean();

*/

// Generate the animated gif and output to screen.
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
//echo $gif->GetAnimation();

$fp = fopen($fichero_gif, 'w');
fwrite($fp, $gif->GetAnimation());
fclose($fp);


if ($solo_thumb==1)
{
	comprobar_previsualizacion($pelicula,$carpeta_previsualizaciones,"0");
}

}


?>

