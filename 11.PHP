<?php
	/**
     * 验证邮件地地址
     *
     * @param string $str
     * @return boolean
     */
    function checkEmail($str) {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str); ##
    }

    /**
     * 验证URL地址
     *
     * @param string $str
     * @return boolean
     */
    function checkUrl($str) {
        return preg_match("|^http://[_=&///?\.a-zA-Z0-9-]+$|i", $str); ##
    }

    /**
     * 全英文字母
     *
     * @param string $str
     * @param integer $len
     * @return boolean
     */
    function checkAlpha($str, $len = 0) {
        if (is_int($len) && ($len > 0)) {
            return preg_match("/^([a-z]{" . $len . "})$/i", $str);
        } else {
            return preg_match("/^([a-z])+$/i", $str);
        }
    }

    /**
     * 全数字
     *
     * @param string $str
     * @param integer $len
     * @return boolean
     */
    function checkNumber($str, $len = 0) {
        if (is_int($len) && ($len > 0)) {
            return preg_match("/^([0-9]{" . $len . "})$/", $str);
        } else {
            return preg_match("/^([0-9])+$/", $str);
        }
    }

    /**
     * 数字或字母
     *
     * @param string $str
     * @param integer $len
     * @return boolean
     */
    function checkNumAlpha($str, $len = 0) {
        if (is_int($len) && ($len > 0)) {
            return preg_match("/^([a-z0-9]{" . $len . "})$/i", $str);
        } else {
            return preg_match("/^([a-z0-9])+$/i", $str);
        }
    }

    /**
     * 数字和字母的组合
     *
     * @param string $str
     * @param integer $len
     * @return boolean
     */
    function checkBlend($str, $len = 0, $maxLen = 0) {
        if (is_int($maxLen) && ($maxLen > 0)) {
            if (!$this->checkLen($str, $len, $maxLen)) {
                return FALSE;
                exit;
            }

        } elseif (is_int($len) && ($len > 0) && !$maxLen) {
            if (strlen($str) > $len) {
                return FALSE;
                exit;
            }
        }
        return preg_match("/^(((\d+[a-z]+)|([a-z]+\d+))[0-9a-z]*)$/i", $str);
    }

    /**
     * 数字和字母或上划???,下划???
     *
     * @param string $str
     * @param integer $len
     * @return boolean
     */
    function checkDash($str, $len = 0) {
        if (is_int($len) && ($len > 0)) {
            return preg_match("/^([_a-z0-9-]{" . $len . "})$/i", $str);
        } else {
            return preg_match("/^([_a-z0-9-])+$/i", $str);
        }
    }

    /**
     * 浮点数
     *
     * @param string $str
     * @return boolean
     */
    function checkFloat($str) {
        return preg_match("/^[0-9]+\.[0-9]+$/", $str);
    }

    /**
     * 超过长度
     *
     * @param string $str
     * @param integer $length
     * @return boolean
     */
    function checkMax($str, $length) {
        return (@strlen($str) <= $length);
    }

    /**
     * 小于长度
     *
     * @param string $str
     * @param integer $length
     * @return boolean
     */
    function checkMin($str, $length) {
        return (@strlen($str) >= $length);
    }

    /**
     * 判断是否一致
     *
     * @param string $strA
     * @param strint $strB
     * @return boolean
     */
    function checkSame($strA, $strB) {
        return ($strA == $strB) ? TRUE : FALSE;

    }

    /**
     * 指定长度
     *
     * @param string $str
     * @param integer $minLen
     * @param integer $maxLen
     * @return boolean
     */
    function checkLen($str, $minLen, $maxLen) {
        $strLen = @strlen($str);
        if (($strLen >= $minLen) && ($strLen <= $maxLen)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * ??????
     *
     * @param string $str
     * @param integer $len
     * @return boolean
     */
    function checkChinese($str, $len = 0) {
        if (is_int($len) && ($len > 0)) {
            $len = $len * 2;
            return preg_match("/^[" . chr(0xa1) . "-" . chr(0xff) . "]{" . $len . "}$/", $str);
        } else {
            return preg_match("/^[" . chr(0xa1) . "-" . chr(0xff) . "]+$/", $str);
        }
    }

    /**
     * IP地址验证
     *
     * @param string $str
     * @return boolean
     */
    function checkIp($str) {
        $exp = array();
        if ($exp = explode('.', $str)) {
            foreach ($exp as $val) {
                if ($val > 255) {
                    return FALSE;
                    exit;
                }
            }
        }
        return preg_match("/^[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}$/", $str);
    }

    /**
     * 日期格式验证
     *
     * @param string $str
     * @return boolean
     */
    function checkIsDate($str) {
        $exp = array();
        if ($exp = explode('/', $str)) {
            if (count($exp) == 3) {
                $str = implode('-', $exp);
            }
        }
        if ($exp = explode('-', $str)) {
            if (count($exp) != 3 || $exp[1] > 12 || $exp[2] > 31) {
                return FALSE;
                exit;
            }
        }
        return preg_match("/^([1-9][\d])?[\d][\d][-|\/][\d]{1,2}[-|\/][\d]{1,2}$/", $str);
    }

    /**
     *  时间格式验证
     *
     * @param string $str
     * @return boolean
     */
    function checkIsTime($str) {
        $exp = array();
        if ($exp = explode(':', $str)) {
            if (count($exp) != 3 || $exp[0] > 23 || $exp[1] > 59 || $exp[2] > 59) {
                return FALSE;
                exit;
            }
        }
        return preg_match("/^[\d]{1,2}:[\d]{1,2}:[\d]{1,2}$/", $str);
    }

    /**
     * 电话号码
     *
     * @param string $str
     * @return boolean
     */
    function checkPhone($str) {
        return preg_match("/^(\d{3,4}-)?(\d{7,8})$/", $str);
    }

    /**
     * 手机号码
     *
     * @param string $str
     * @return boolean
     */
    function checkMobile($str) {
//        return preg_match("/^[0]?([13|15]+)(\d{9})$/", $str);
        return preg_match("/^(86(-)?)?1[3456789][0-9]{9}$/", $str);
    }

    /**
     * 身份证简单校验法
     *
     * @param string $str
     * @return boolean
     */
    function checkCardNo($str) {
        //  return preg_match("/^[0]?([13|15]+)(\d{9})$/", $str);
        return preg_match("/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/", $str);
    }

    /**
     * 政编验证
     *
     * @param string $str
     * @return boolean
     */
    function checkZip($str) {
        return preg_match("/^[1-9]\d{5}$/", $str);
    }
   
?>
