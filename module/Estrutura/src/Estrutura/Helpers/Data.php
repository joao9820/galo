<?php

namespace Estrutura\Helpers;

/**
 *
 * @author ronaldo
 *
 */
class Data
{

    public static $mes = array(1 => 'janeiro',
        2 => 'fevereiro',
        3 => 'março',
        4 => 'abril',
        5 => 'maio',
        6 => 'junho',
        7 => 'julho',
        8 => 'agosto',
        9 => 'setembro',
        10 => 'outubro',
        11 => 'novembro',
        12 => 'dezembro');

    /**
     *
     * @param string $date
     */
    public static function isDate($date)
    {

        $char = (strpos($date, '/') !== false) ? '/' : '-';
        $date_array = explode($char, $date);

        if (count($date_array) != 3) {

            return false;
        }

        return true;
    }

    public static function get($date, $tipo)
    {

        if ($date) {

            $zendDate = new Zend_Date($date);
            return $zendDate->get($tipo);
        } else {

            return null;
        }
    }

    /**
     *
     * @param Zend_Date $data
     * @return boolean
     */
    public static function isValid(Zend_Date $data)
    {

        $d = $data->get(Zend_Date::DAY);
        $m = $data->get(Zend_Date::MONTH);
        $y = $data->get(Zend_Date::YEAR);

        // verifica se a data é válida!
        $res = checkdate($m, $d, $y);
        if (($res == 1) && ($y > 1900)) {

            return true;
        } else {

            return false;
        }
    }

    /**
     *
     * @param Zend_Date $data
     * @return int $dias_diferenca
     */
    public static function calculaData(Zend_Date $data)
    {

        //defino data 1
        $ano1 = $data->get(Zend_Date::YEAR);
        $mes1 = $data->get(Zend_Date::MONTH);
        $dia1 = $data->get(Zend_Date::DAY);

        //defino data 2
        $ano2 = date('Y');
        $mes2 = date('m');
        $dia2 = date('d');

        //calculo timestam das duas datas
        $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
        $timestamp2 = mktime(4, 12, 0, $mes2, $dia2, $ano2);

        //diminuo a uma data a outra
        $segundos_diferenca = $timestamp1 - $timestamp2;
        //echo $segundos_diferenca;
        //converto segundos em dias
        $dias_diferenca = $segundos_diferenca / (60 * 60 * 24);

        //obtenho o valor absoluto dos dias (tiro o possível sinal negativo)
        $dias_diferenca = abs($dias_diferenca);

        //tiro os decimais aos dias de diferenca
        $dias_diferenca = floor($dias_diferenca);

        return $dias_diferenca;
    }

    /**
     *
     * @param Zend_Date $data
     * @param string $formato => Podem ser 	1 => 25 de abril de 2012 às 10:50:58
     * 										2 => 25 de abril de 2012 às 10:50
     * 										3 => 25 de abril de 2012
     * @return string
     */
    public static function porExtenso($data, $formato = 3)
    {
        $day = date('d', strtotime( $data ) );
        $month = date('m', strtotime( $data ) );
        $year = date('Y', strtotime( $data ) );
        $week = date('w', strtotime( $data ) );
        $hour = date('H', strtotime( $data ) );
        $minute = date('i', strtotime( $data ) );
        $second = date('s', strtotime( $data ) );

        $day = intval($day);
        $month = intval($month);

        $nomeMes = self::$mes;

        switch ($formato) {

            default:
                return $data;
                break;
            case 1:
                $mes = $nomeMes[$month];
                return $day . " de $mes de $year às $hour:$minute:$second";
                break;
            case 2:
                $mes = $nomeMes[$month];
                return "$day de $mes de $year às $hour:$minute";
                break;
            case 3:
                $mes = $nomeMes[$month];
                return "$day de $mes de $year";
                break;
        }
    }

    /*     * *************************************************************************
     * Function: converteData2RM
     * Description: Converte data do formato dd/mm/YYYY para formato RM (timestamp)  \/DATA(12312313123)\/
     * Parameters: $dataRM (string) - dd/mm/YYYY HH:i:s
     *           
     * ************************************************************************ */

    public static function converteData2RM($dataRM)
    {
        //$dataRM='03/11/2011 15:46:23';
        $data = substr($dataRM, 0, 10);
        $hora = substr($dataRM, 11, 19);
        $dataSplit = explode("/", $data);
        $horaSplit = explode(":", $hora);
        $d = $dataSplit[0];
        $m = $dataSplit[1];
        $a = $dataSplit[2];
        $h = $horaSplit[0];
        $i = $horaSplit[1];
        $s = $horaSplit[2];
        $date = $a . '/' . $m . '/' . $d . ' ' . $h . ':' . $i . ':' . $s;
        //echo $date." - ";
        //$dataRM=gmmktime($h,$i,$s,$m,$d,$a)."486";
        @$dataRM = '\/Date(' . gmmktime($h, $i, $s, $m, $d, $a) . "486" . ')\/';
        //echo $dataRM;
        //$params.= ', "data_inicio_planejado_qsocial": "\/Date('.gmmktime(0,0,0,substr($d,3,2),substr($d,0,2),substr($d,6,4))."486".')\/"';
        //$dataRM=strtotime($date);
        //$dataRM=$dataRM*100;
        //	echo $dataRM."<br />";
        return $dataRM; //   \/DATA(12312313123)\/
        //return $dataRM;
    }

    /*     * *************************************************************************
     * Function: converteData
     * Description: Converte data do formato do RM (timestamp) para dd/mm/YYYY
     * Parameters: $dataRM (string) - \/DATA(12312313123)\/
     *            $formato (int) - parametros aceitaveis 0,1,2,3
     * 
     * 3 Somente campo DATA dentro do RM
     * ************************************************************************ */

    public static function converteData($dataRM, $formato = NULL, $tipo = NULL)
    {
        if ($tipo == 'simples') {
            $data = substr($dataRM, 7, 13);
        } else {
            $data = substr(preg_replace('/\/Date\((.*)-[0-9]*\)\//i', '$1', $dataRM), 0, 10);
            $GMT3 = substr(preg_replace('/\/Date\((.*)\)\//i', '$1', $dataRM), 15, -2);
            $GMT3 = -$GMT3;
        }

        //echo $data;
        switch ($formato) {
            case 1://23/12/2012|23:01:50 para dar split com o retorno
                return gmdate('d/m/Y|H:i:s', $data + 3600 * ($GMT3 + date('I')));
                break;

            case 2: //23/12/2012 23:01:50
                return gmdate('d/m/Y H:i:s', $data + 3600 * ($GMT3 + date('I')));
                break;

            case 3://SOMENTE CAMPO DATA DENTRO DO RM
                $data = substr(preg_replace('/\/Date\((.*)\)\//i', '$1', $dataRM), 0, 10);
                return @gmdate('d/m/Y', $data);

            case 4://Retorna padrao para comparaçao de datas
                $data = substr(preg_replace('/\/Date\((.*)\)\//i', '$1', $dataRM), 0, 10);
                return gmdate('Y-m-d H:i:s', $data + 3600 * ($GMT3 + date('I')));

            case 5://Retorna padrao para comparaçao de datas
                $data = substr(preg_replace('/\/Date\((.*)\)\//i', '$1', $dataRM), 0, 10);
                return gmdate('Y-m-d', $data);

            default: //23/12/2012 23:01:50
                return gmdate('d/m/Y H:i:s', $data + 3600 * ($GMT3 + date('I')));
                break;
        }
    }

    /*     * ************************************************************************
     * Function: converteDataENPT
     * Description: Converte data do formato YYYY/mm/dd HH:MM:SS para formato dd/mm/YYYY HH:MM:SS
     * Parameters: $data (string) - YYYY/mm/dd HH:MM:SS
     * Author: Roberto Ritter
     * ************************************************************************ */

    public static function converteDataENPT($dataRM)
    {
        //$data='2011/11/31 15:46:23';
        $data = substr($dataRM, 0, 10);
        $hora = substr($dataRM, 11, 19);
        $dataSplit = explode('-', $data);
        $horaSplit = explode(':', $hora);
        $d = $dataSplit[2];
        $m = $dataSplit[1];
        $a = $dataSplit[0];
        $h = $horaSplit[0];
        $i = $horaSplit[1];
        $s = $horaSplit[2];
        $date = $a . '/' . $m . '/' . $d . ' ' . $h . ':' . $i . ':' . $s;
        //echo $date.' - ';
        //$dataRM=gmmktime($h,$i,$s,$m,$d,$a).'486';
        //@$dataRM='\/Date('.gmmktime($h,$i,$s,$m,$d,$a).'486'.')\/';
        $dataRM = $d . '/' . $m . '/' . $a . ' ' . $h . ':' . $i . ':' . $s;
        //echo $dataRM;
        //$params.= ', 'data_inicio_planejado_qsocial': '\/Date('.gmmktime(0,0,0,substr($d,3,2),substr($d,0,2),substr($d,6,4)).'486'.')\/'';
        //$dataRM=strtotime($date);
        //$dataRM=$dataRM*100;
        //	echo $dataRM.'<br />';
        return $dataRM; //   \/DATA(12312313123)\/
        //return $dataRM;
    }

    public static function diffMonths($data1, $data2)
    {
        $d1 = explode('-', $data1);
        $d2 = explode('-', $data2);
        $result = (($d2[0] - $d1[0]) * 12);
        if ($d1[1] > $d2[1]) {
            $result -= ($d1[1] - $d2[1]);
        } elseif ($d2[1] > $d1[1]) {
            $result += ($d2[1] - $d1[1]);
        }
        return $result;
    }

    public static function calcularIdadeDoAtleta($dt_nascimento) {

        return date("Y-m-d") - date("Y-m-d", strtotime($dt_nascimento));
    }

    /***
     * Converte a data de [2015-08-09 16:12:39] para [09/08/2015 16:12:39]
     * @param $dataMysql
     * @return string
     */
    public static function converterDataHoraBancoMySQL2Brazil($dataMysql) {
        return isset($dataMysql) && $dataMysql ? date('d/m/Y H:i:s',strtotime($dataMysql)): "";
    }

    public static function converterDataHoraBancoMySQL2DataHoraBrazil($dataMysql) {
        return isset($dataMysql) && $dataMysql ? date('d/m/Y H:i:s',strtotime($dataMysql)): "";
    }

    /***
     * Converte a data de [09/08/2015 16:12:39] para [2015-08-09 16:12:39]
     * @param $dataBrazil
     * @return string
     */
    public static function converterDataHoraBrazil2BancoMySQL($dataBrazil) {
        $dataConvertida = "";
        if(isset($dataBrazil) && $dataBrazil) {
            $arDataHora = explode(" ", $dataBrazil);
            $data = $arDataHora[0];
            $hora = isset($arDataHora[1]) ? $arDataHora[1] : '00:00:00';
            $array = explode("/", $data);
            $array = array_reverse($array);
            $str = implode($array, "/");
            $str .= ' ' . $hora;
            $dataConvertida = date("Y-m-d H:i:s", strtotime($str));
        }

        return $dataConvertida;
    }

    /**
     * Converte a data de [09/08/2015] para [2015-08-09]
     * @param $dataBrazil
     * @return string
     */
    public static function converterDataBrazil2BancoMySQL($dataBrazil) {
        $array = explode("/", $dataBrazil);
        $array = array_reverse($array);
        $str = implode($array, "/");

        return date("Y-m-d", strtotime($str));
    }

    /***
     * Converte a data de [2015-08-09] para [09/08/2015]
     * @param $dataMysql
     * @return string
     */
    public static function converterDataBancoMySQL2Brazil($dataMysql) {
        if(isset($dataMysql) && $dataMysql){
            return date('d/m/Y',strtotime($dataMysql));
        } else {
            return '';
        }
    }

    public static function converterDataHoraBancoMySQL2DataBrazil($dataMysql) {
        if(isset($dataMysql) && $dataMysql){
            return date('d/m/Y',strtotime($dataMysql));
        } else {
            return '';
        }
    }

    /***
     * Retorna a data atual do sistema no formato [09/08/2015]
     * @return string
     */
    public static function getDataAtual2Brazil() {
        return date("d/m/Y");
    }

    /***
     * Retorna a data atual do sistema no formato [09/08/2015 16:36:12]
     * @return string
     */
    public static function getDataHoraAtual2Brazil() {
        return date("d/m/Y H:i:s");
    }

    /***
     * Retorna a data atual do sistema no formato [2015-08-09]
     * @return string
     */
    public static function getDataAtual2Banco() {
        return date("Y-m-d");
    }

    /***
     * Retorna a data atual do sistema no formato [2015-08-09 16:36:12]
     * @return string
     */
    public static function getDataHoraAtual2Banco() {
        return date("Y-m-d H:i:s");
    }

    /**
     * Extrair apenas a Data de uma Data no Formato 'dd/mm/aaaa hh:mm:ss' e retornará apenas 'dd/mm/aaaa'
     * @param $dataBrazil no Formato 'dd/mm/aaaa hh:mm:ss'
     * @return bool|string no formato para Banco de Dados 'aaaa-mm-aa hh:mm:ss'
     */
    public static function extrairDataDeUmDataHoraBrazil2Banco($dataBrazil) {
        $dataConvertida = "";
        if(isset($dataBrazil) && $dataBrazil) {
            $arDataHora = explode(" ", $dataBrazil);
            $data = $arDataHora[0];
            $array = explode("/", $data);
            $array = array_reverse($array);
            $str = implode($array, "/");
            $dataConvertida = date("Y-m-d", strtotime($str));
        }

        return $dataConvertida;
    }

    /**
     * Extrair apenas a Data de uma Data no Formato 'dd/mm/aaaa hh:mm:ss' e retornará apenas 'dd/mm/aaaa'
     * @param $dataBrazil no Formato 'dd/mm/aaaa hh:mm:ss'
     * @return bool|string no formato para Banco de Dados 'aaaa-mm-aa hh:mm:ss'
     */
    public static function extrairDataDeUmDataHoraBrazil($dataBrazil) {
        $dataConvertida = "";
        if(isset($dataBrazil) && $dataBrazil) {
            $arDataHora = explode(" ", $dataBrazil);
            $dataConvertida = $arDataHora[0];
        }

        return $dataConvertida;
    }

    /**
     * Extrair apenas a Hora de uma Data no Formato 'dd/mm/aaaa hh:mm:ss' e retornará apenas 'hh:mm:ss'
     * @param $dataBrazil no Formato 'dd/mm/aaaa hh:mm:ss'
     * @return bool|string no formato para Banco de Dados 'hh:mm:ss'
     */
    public static function extrairHoraDeUmDataHoraBrazil($dataBrazil) {
        $horaConvertida = '00:00:00';
        if(isset($dataBrazil) && $dataBrazil) {
            $arDataHora = explode(" ", $dataBrazil);
            $horaConvertida = isset($arDataHora[1]) ? $arDataHora[1] : '00:00:00';
        }

        return $horaConvertida;
    }

    public static function pegarAnoCorrente() {

        return date("Y");
    }

    public static function pegarMesCorrente()
    {

        return date("m");
    }

    public static function pegarUltimoDiaDoMesCorrente()
    {
        return date('t/m/Y');
    }

    public static function pegarUltimoDiaDoMes($dataMysql)
    {
        if (isset($dataMysql) && $dataMysql) {
            return date('t/m/Y', strtotime($dataMysql));
        } else {
            return '';
        }
    }

    public static function pegarPrimeiroDiaDoMes($dataMysql)
    {
        if (isset($dataMysql) && $dataMysql) {
            return "01/" . date("m", strtotime($dataMysql)) . "/" . date("Y", strtotime($dataMysql));
        } else {
            return '';
        }
    }

    public static function pegarPrimeiroDiaDoMesCorrente()
    {
        return "01/" . date("m") . "/" . date("Y");
    }

    /**
     *
     * @param Zend_Date $data
     * @return int $dias_diferenca
     */
    public static function calculaDiferencaEmHoras($data_inicial, $data_final)
    {
        $datatime1 = new \DateTime($data_final);
        $datatime2 = new \DateTime($data_inicial);

        $diff = $datatime1->diff($datatime2);
        $horas = $diff->h + ($diff->days * 24);

        return $horas;
    }

    public static function calculaDiferencaEmMinutos($data_inicial, $data_final)
    {
        $datatime1 = new \DateTime($data_final);
        $datatime2 = new \DateTime($data_inicial);

        $diff = $datatime1->diff($datatime2);
        $horas = $diff->h + ($diff->days * 24);
        $minutos = $diff->i;
        return ($horas * 60) + $minutos;
    }

}
