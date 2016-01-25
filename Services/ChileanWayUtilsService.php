<?php

namespace SebaThomson\ChileanWay\Service;

/**
 * @author Sebastián Thomson <[seba.thomsongmail.com]>
 * @github https://github.com/sebathomson
 */
class ChileanWayUtilsService
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function getRutFormatted($strRut)
    {
        $strRut = str_replace('.', '', $strRut);
        
        $arrExp = explode( "-", $strRut );
        if ( COUNT( $arrExp ) != 2 ) {
            $strRut = str_replace('-', '', $strRut);
            $SplRut = str_split( $strRut );
            $lenRut = count($SplRut);
            $auxRut = '';
            foreach ($SplRut as $pos => $char) {
                $auxRut = $auxRut.$char;
                if ($pos == ($lenRut - 2)) {
                    $auxRut = $auxRut.'-';
                }
            }
            $strRut = $auxRut;
        }
        $arrRut = explode( "-", $strRut );
        return number_format( $arrRut[0], 0, "", ".") . '-' . $arrRut[1];
    }

    public function getDateFormatted($oDate)
    {
        if (is_object($oDate)) {
            return $oDate->format('d-m-Y');
        }
    }

    public function getDateTimeFormatted($oDateTime)
    {
        if (is_object($oDateTime)) {
            return $oDateTime->format('d-m-Y H:i');
        }
    }

    public function getTimeFormatted($oTime)
    {
        if (is_object($oTime)) {
            return $oTime->format('H:i');
        }
    }

    public function isObject($parameter)
    {
        return is_object($parameter);
    }

    public function getParameter($parameterName = '')
    {
        if ($this->container->hasParameter($parameterName)) {
            return $this->container->getParameter($parameterName);
        }

        return null;
    }

    /**
     * A esta función le falta el translate
     */
    public function getAge($bidthday)
    {
        $today = new \DateTime();

        if (is_null($bidthday)) {
            return null;
        }

        if (!is_object($bidthday)) {
            try {
                $bidthday = new \DateTime($bidthday);
            } catch (Exception $e) {
                return null;
            }
        }

        $interval  = date_diff( date_create($bidthday->format('Y-m-d')) , date_create($today->format('Y-m-d')) );

        $out       = $interval->format("Years:%Y,Months:%M,Days:%d");

        $a_out     = array();
        $arrData  = explode(',',$out);

        for($i=0;$i<count($arrData);$i++)
        {
            $data = explode(':',$arrData[$i]);
            $a_out[$data[0]] = $data[1];
        }

        $stringAge = '';

        if ($a_out["Years"] == 1) {
            $stringAge .= $a_out["Years"] . ' Año, ';
        } else {
            $stringAge .= $a_out["Years"] . ' Años, ';
        }

        if ($a_out["Months"] == 1) {
            $stringAge .= $a_out["Months"] . ' Mes y ';
        } else {
            $stringAge .= $a_out["Months"] . ' Meses y ';
        }

        if ($a_out["Days"] == 1) {
            $stringAge .= $a_out["Days"] . ' Día';
        } else {
            $stringAge .= $a_out["Days"] . ' Días';
        }

        return $stringAge;
    }
}
?>