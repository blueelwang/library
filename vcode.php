<?php
/**
 * @param  $intNumber
 * @author blueelwang
 * @brief  根据数字生成六位随机码, 起始数位1亿，确保生产6位，共可生成大于10亿个数字
 * @return string
 */
function generateRandStr($intNumber) {
    //不允许大于10亿
    if($intNumber > 1000000000){
        return false;
    }
    //异或随机基数, 10 - 21 亿之间的数字
    $arrBase = array(
        1708953375,
        2103273952,
        1035869304,
        1583659620,
    );
    //计算基数取值
    $intIndex = $intNumber % count($arrBase);
    $intBase = $arrBase[$intIndex];
    //转换为36进制
    $intRet = base_convert($intBase ^ $intNumber, 10, 36);

    return $intRet;
}


//test
for($i=1; $i< 50000; $i++){
    $intRand = $i; //rand(1, 1000000000);
    $strRand = generateRandStr($intRand);
    if(strlen($strRand) != 6) {
        echo $intRand . "==" . $strRand . "\n";
    }
    file_put_contents('num.log', $intRand . "==" . $strRand . "\n",  FILE_APPEND);
}

