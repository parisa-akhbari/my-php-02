<?php
$iran_offset = 3*3600 + 30*60;
function gregorian_to_jalali($gy, $gm, $gd) {
    $g_d_m = array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy > 1600){
        $jy=979;
        $gy-=1600;
    }else{
        $jy=0;
        $gy-=621;
    }

    $gy2 = $gy + 1;
    $days = (int)(365*$gy) + (int)(($gy2+3)/4) - (int)(($gy2+99)/100) + (int)(($gy2+399)/400) - 80 + (int)$gd + (int)$g_d_m[$gm-1];

    $jy += 33 * (int)($days/12053);
    $days %= 12053;

    $jy += 4 * (int)($days/1461);
    $days %= 1461;

    if($days > 365){
        $jy += (int)(($days-1)/365);
        $days = ($days-1)%365;
    }

    if($days < 186){
        $jm = 1 + (int)($days/31);
        $jd = 1 + ($days % 31);
    } else {
        $jm = 7 + (int)(($days-186)/30);
        $jd = 1 + (($days-186) % 30);
    }

    return array($jy, $jm, $jd);
}

// تبدیل اعداد انگلیسی به فارسی
function en2fa($string) {
    $en = ['0','1','2','3','4','5','6','7','8','9'];
    $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    return str_replace($en, $fa, $string);
}

function jdate($format='Y/m/d H:i:s', $timestamp=null, $fa_numbers=true) {
    if($timestamp === null) $timestamp = time();

    $gy = (int)date('Y', $timestamp);
    $gm = (int)date('m', $timestamp);
    $gd = (int)date('d', $timestamp);
    $h = (int)date('H', $timestamp);
    $i = (int)date('i', $timestamp);
    $s = (int)date('s', $timestamp);

    list($jy, $jm, $jd) = gregorian_to_jalali($gy, $gm, $gd);

    $result = $format;
    $result = str_replace('Y', $jy, $result);
    $result = str_replace('m', str_pad($jm, 2, '0', STR_PAD_LEFT), $result);
    $result = str_replace('d', str_pad($jd, 2, '0', STR_PAD_LEFT), $result);
    $result = str_replace('H', str_pad($h, 2, '0', STR_PAD_LEFT), $result);
    $result = str_replace('i', str_pad($i, 2, '0', STR_PAD_LEFT), $result);
    $result = str_replace('s', str_pad($s, 2, '0', STR_PAD_LEFT), $result);

    if($fa_numbers) {
        $result = en2fa($result);
    }

    return $result;
}