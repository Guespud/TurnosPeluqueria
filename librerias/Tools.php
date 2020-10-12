<?php

class Tools {
    /*
     * Months
     */

    static public $rcMonths = array(
        'JANUARY' => 'Enero',
        'FEBRUARY' => 'Febrero',
        'MARCH' => 'Marzo',
        'APRIL' => 'Abril',
        'MAY' => 'Mayo',
        'JUNE' => 'Junio',
        'JULY' => 'Julio',
        'AUGUST' => 'Agosto',
        'SEPTEMBER' => 'Septiembre',
        'OCTOBER' => 'Octubre',
        'NOVEMBER' => 'Noviembre',
        'DECEMBER' => 'Diciembre'
    );

    /*
     * Days
     */
    static public $rcDays = array(
        'MONDAY' => 'Lunes',
        'TUESDAY' => 'Martes',
        'WEDNESDAY' => 'Miercoles',
        'THURSDAY' => 'Jueves',
        'FRIDAY' => 'Viernes',
        'SATURDAY' => 'Sabado',
        'SUNDAY' => 'Domingo'
    );

    /**
     * Get a value from $_POST / $_GET
     * if unavailable, take a default value
     *
     * @param string $key Value key
     * @param mixed $defaultValue (optional)
     * @return mixed Value
     */
    static public function GetValue($key, $defaultValue = false) {
        if (!isset($key) OR empty($key) OR ! is_string($key))
            return false;
        $ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $defaultValue));

        if (is_string($ret) === true)
            $ret = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret)));
        return !is_string($ret) ? $ret : stripslashes($ret);
    }

    static public function GetVal($var, $defaultValue = FALSE) {
        return empty($var) || is_null($var) || !isset($var) ? $defaultValue : $var;
    }

    /*
     * Session
     */

    static public function GetSession($key) {
        if (!isset($_SESSION))
            session_start();
        if (!empty($key)) {
            return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
        } else
            return NULL;
    }

    static public function SetSession($key, $value) {
        if (!isset($_SESSION))
            session_start();
        if (!empty($key)) {
            $_SESSION[$key] = $value;
        }
    }

    static public function DestroySession($key = NULL) {
        session_start();
        if ($key === NULL) {
            session_destroy();
        } else {
            if (!empty($key)) {
                unset($_SESSION[$key]);
            }
        }
    }

    static public function StartsWith($haystack, $needle, $case = true) {
        if ($case) {
            return (strcmp(substr($haystack, 0, strlen($needle)), $needle) === 0);
        }
        return (strcasecmp(substr($haystack, 0, strlen($needle)), $needle) === 0);
    }

    static public function EndsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    static public function GetDateNow() {
        $dtNow = getdate();

        $sbMonth = (strlen($dtNow['mon']) == 1) ? '0' . $dtNow['mon'] : $dtNow['mon'];
        $sbDay = (strlen($dtNow['mday']) == 1) ? '0' . $dtNow['mday'] : $dtNow['mday'];

        return $dtNow['year'] . "-" . $sbMonth . "-" . $sbDay;
    }

    static public function GetTimeNow() {
        $tiNow = date('H:i:s');

        return $tiNow;
    }

    
    static public function GetFullDate($dtDate = NULL, $sbPatern = 'md|m|y', $sbSeparador1 = ' de ', $sbSeparador2 = ' de ') {
        global $rcDays, $rcMonths;

        $dtDate = !empty($dtDate) ? $dtDate : self::GetDateNow();
        $rcDate = explode('-', $dtDate);
        $nuTimeStam = mktime(0, 0, 0, $rcDate[1], $rcDate[2], $rcDate[0]);

        $rcDate_ = getdate($nuTimeStam);

        if ($sbPatern == 'md|m|y') {
            return $rcDate_['mday'] . $sbSeparador1 . self::$rcMonths[strtoupper($rcDate_['month'])] . $sbSeparador2 . $rcDate_['year'];
        } else if ($sbPatern == 'wd|md|m|y') {
            return self::$rcDays[strtoupper($rcDate_['weekday'])] . ", " . $rcDate_['mday'] . $sbSeparador1 . self::$rcMonths[strtoupper($rcDate_['month'])] . $sbSeparador2 . $rcDate_['year'];
        }
    }

    static public function Substr($sbString, $nuLength = 0, $nuStart = 0) {
        return substr($sbString, $nuStart, $nuLength);
    }

    static public function CapitalizeWords($sbString, $blAllWords = true) {
        return $blAllWords ? ucwords(strtolower($sbString)) : ucfirst(strtolower($sbString));
    }

    static public function NumberFormat($dbValue, $nuDecimal = CANTIDAD_DECIMALES) {
        return '$' . number_format($dbValue, (int) $nuDecimal);
    }

    static public function ThrowErrorJSON($Exception, $return = FALSE) {
        $Error = array(
            'status' => false,
            'code' => '10',
            'msg' => 'Error no controlado'
        );

        if (isset($Exception) && is_object($Exception)) {
            $Error = array(
                'status' => false,
                'code' => $Exception->getCode(),
                'msg' => $Exception->getMessage()
            );
        }

        if (!$return) {
            header('HTTP/1.0 501 Metodo no implementado');
            die(json_encode($Error));
        }

        return $Error;
    }

    static public function ThrowError($Exception, $return = FALSE) {
        $Error = array(
            'status' => false,
            'code' => '10',
            'msg' => 'Error no controlado'
        );

        if (isset($Exception) && is_object($Exception)) {
            $Error = array(
                'status' => false,
                'code' => $Exception->getCode(),
                'msg' => $Exception->getMessage()
            );
        }

        if (!$return) {
            header('HTTP/1.0 424 Ejecucion fallida');
            die(json_encode($Error));
        }

        return $Error;
    }

    static public function ExecuteREST($URL, $method = 'POST', $data = '') {
        if (!function_exists('curl_version')) {
            return NULL;
        }
        $headers = array();
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $URL);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($handle, CURLOPT_TIMEOUT, 360);

        switch ($method) {
            case 'GET':
                break;

            case 'POST':
                curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
                break;

            case 'PUT':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
                break;

            case 'DELETE':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $response = curl_exec($handle);
        //$status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        flush();
        ob_flush();
        return $response;
    }

    /**
     * * FUNCION PARA VALIDAR HORA NULA;
     * @param type $time
     * @return type
     */
    static public function ValidaHora($time) {
        if (isset($time) && $time === 'null') {
            $time = "--:--:--";
        }
        return $time;
    }

    /**
     * * FUNCION PARA FOMATO PESOS $;
     * @param type $val
     * @return type
     */
    static public function MoneyFormating($val) {
        if (isset($val)) {
            $return = '$ ' . $val;
        }
        return $return;
    }

}

?>