<?php

use Illuminate\Support\Facades\Mail;

// $ip = $_SERVER['REMOTE_ADDR'];

// send mail helper
function SendMail($data)
{
    // mail log
    $newMail = new \App\Models\MailLog();
    $newMail->from = 'support@onninternational.com';
    $newMail->to = $data['email'];
    $newMail->subject = $data['subject'];
    $newMail->blade_file = $data['blade_file'];
    $newMail->payload = json_encode($data);
    $newMail->save();
	
    // send mail
    Mail::send($data['blade_file'], $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject($data['subject'])->from('support@onninternational.com', env('APP_NAME'));
    });
}

// multi-dimensional in_array
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) return true;
    }
    return false;
}

// number to word
function amountInWords(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

// variation colors fetch
function variationColors(int $productId, int $maxColorsToShow) {
    $relatedProductsVariationRAW = \DB::select('SELECT pc.id, pc.position, pc.color AS color_id, c.name as color_name, c.code as color_code, pc.status FROM product_color_sizes pc JOIN colors c ON pc.color = c.id WHERE pc.product_id = '.$productId.' GROUP BY pc.color ORDER BY pc.position ASC');

    $resp = '';

    if (count($relatedProductsVariationRAW) > 0) {
        $resp .= '<div class="color"><ul class="product__color">';

        $usedColros = $activeColros = 1;
        foreach($relatedProductsVariationRAW as $relatedProsVarKey => $relatedProsVarVal) {
            if($relatedProsVarVal->status == 1) {
                if($usedColros < $maxColorsToShow + 1) {
                    if ($relatedProsVarVal->color_id == 61) {
                        $resp .= '<li style="background: -webkit-linear-gradient(left,  rgba(219,2,2,1) 0%,rgba(219,2,2,1) 9%,rgba(219,2,2,1) 10%,rgba(254,191,1,1) 10%,rgba(254,191,1,1) 10%,rgba(254,191,1,1) 20%,rgba(1,52,170,1) 20%,rgba(1,52,170,1) 20%,rgba(1,52,170,1) 30%,rgba(15,0,13,1) 30%,rgba(15,0,13,1) 30%,rgba(15,0,13,1) 40%,rgba(239,77,2,1) 40%,rgba(239,77,2,1) 40%,rgba(239,77,2,1) 50%,rgba(254,191,1,1) 50%,rgba(137,137,137,1) 50%,rgba(137,137,137,1) 60%,rgba(254,191,1,1) 60%,rgba(254,191,1,1) 60%,rgba(254,191,1,1) 70%,rgba(189,232,2,1) 70%,rgba(189,232,2,1) 80%,rgba(209,2,160,1) 80%,rgba(209,2,160,1) 90%,rgba(48,45,0,1) 90%);" class="color-holder" data-bs-toggle="tooltip" data-bs-placement="top" title="Assorted"></li>';
                    } else {
                        $resp .= '<li style="background-color: '.$relatedProsVarVal->color_code.'" class="color-holder" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$relatedProsVarVal->color_name.'"></li>';
                    }
                    $usedColros++;
                }
                $activeColros++;
            }
        }

        if ($activeColros > $maxColorsToShow && $usedColros == $maxColorsToShow + 1) $resp .= '<li>+ more</li>';

        $resp .= '</ul></div>';

        return $resp;
    }
}