<?php

class XmlParser
{
    public static function arr2xml($arr, $is_cdata = false, $isroot = true)
    {
        $str = "";
        if ($isroot) {
            $str .= "<xml>";
        }
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                if (!self::is_assoc($val)) {
                    for ($i = 0; $i < count($val); ++$i) {
                        if (is_array($val[$i])) {
                            $child = self::arr2xml($val[$i], $is_cdata, false);
                            $str .= self::xml_join($key, $child, false);
                        } else {
                            $value = $val[$i];
                            $str .= self::xml_join($key, $value, $is_cdata);
                        }
                    }
                } else {
                    $child = self::arr2xml($val, $is_cdata, false);
                    $str .= self::xml_join($key, $child, false);
                }
            } else {
                $str .= self::xml_join($key, $val, $is_cdata);
            }
        }
        if ($isroot) {
            $str .= "</xml>";
        }
        return $str;
    }

    public static function obj2xml($obj, $is_cdata = false, $isroot = true)
    {
        $str = "";
        if ($isroot) {
            $str .= "<xml>";
        }
        foreach ($obj as $key => $val) {
            if (is_object($val)) {
                $child = self::obj2xml($val, $is_cdata, false);
                $str .= self::xml_join($key, $child, false);
            } else {
                $str .= self::xml_join($key, $val, $is_cdata);
            }
        }
        if ($isroot) {
            $str .= "</xml>";
        }
        return $str;
    }

    public static function xml2arr($xml)
    {
        $arr = json_decode(json_encode(self::xml2obj($xml)), true);
        return $arr;
    }

    public static function xml2obj($xml)
    {
        $obj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $obj;
    }

    public static function is_assoc($array)
    {
        if (is_array($array)) {
            $keys = array_keys($array);
            return $keys !== array_keys($keys);
        }
        return false;
    }

    private static function xml_join($key, $value, $is_cdata)
    {
        $str = '';
        if ($is_cdata) {
            if (gettype($value) == 'string') {
                $str .= "<$key><![CDATA[$value]></$key>";
            } else {
                $str .= "<$key>$value</$key>";
            }
        } else {
            $str .= "<$key>$value</$key>";
        }
        return $str;
    }
}