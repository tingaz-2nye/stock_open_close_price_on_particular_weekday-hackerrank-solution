<?php


/*
 * Complete the 'test' function below.
 *
 * The function accepts following parameters:
 *  1. STRING firstDate
 *  2. STRING secondDate
 *  3. STRING dayOfWeek
 */

function test($firstDate, $secondDate, $dayOfWeek) {
    file_get_contents('https://jsonmock.hackerrank.com/api/stocks');

    $theResponse = file_get_contents('https://jsonmock.hackerrank.com/api/stocks');  
    
    $response = json_decode($theResponse,true);
    $total_pages = $response['total_pages'];
    $firstDay = strtotime($firstDate);
    $lastDay = strtotime($secondDate);
    $output = [];
    

    for($i = 1; $i <= $total_pages; $i++){
        $topPageResponse = json_decode(file_get_contents('https://jsonmock.hackerrank.com/api/stocks/?page='.$i.''), true);

        for($j = 0; $j < count($topPageResponse['data']); $j++){
            $foundDate = strtotime($topPageResponse['data'][$j]['date']);
            $dayOW = date("l", strtotime($topPageResponse['data'][$j]['date']));
            if( $foundDate >= $firstDay && $foundDate <= $lastDay && $dayOW == $dayOfWeek){
                $output[] = ' '.$topPageResponse['data'][$j]['date'].' '
                .$topPageResponse['data'][$j]['open'] .' '
                .$topPageResponse['data'][$j]['close'] .'';
            }
        }

    }

    foreach($output as $item){
        echo "$item\r\n";
    };
}


?>