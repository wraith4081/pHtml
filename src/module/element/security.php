<?php
class security {
  // Properties
  public $input;
  public $security_level;

  // functions
  function removexss($input, $security_level) {
    if ($security_level > 0) {
      var returnvalue = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
      return $returnvalue;
    }
  }
   
}
$security = new security();

// !!!WARNING THIS FUNCTIONS NOT TESTED!!!
final class xss_cleanernottested1 {
    public static function clean( string $html ): string {
        return self::cleanXSS(
            preg_replace(
                [
                    '/\s?<iframe[^>]*?>.*?<\/iframe>\s?/si',
                    '/\s?<style[^>]*?>.*?<\/style>\s?/si',
                    '/\s?<script[^>]*?>.*?<\/script>\s?/si',
                    '#\son\w*="[^"]+"#',
                ],
                [
                    '',
                    '',
                    ''
                ],
                $html
            )
        );
    }
    protected static function hexToSymbols( string $s ): string {
        return html_entity_decode($s, ENT_XML1, 'UTF-8');
    }
    protected static function escape( string $s, string $m = 'attr' ): string {
        preg_match_all('/data:\w+\/([a-zA-Z]*);base64,(?!_#_#_)([^)\'"]*)/mi', $s, $b64, PREG_OFFSET_CAPTURE);
        if( count( array_filter( $b64 ) ) > 0 ) {
            switch( $m ) {
                case 'attr':
                    $xclean = self::cleanXSS(
                                         urldecode(
                                            base64_decode(
                                                $b64[ 2 ][ 0 ][ 0 ]
                                            )
                                        )
                                );
                    break;
                case 'tag':
                    $xclean = self::cleanTagInnerXSS(
                                        urldecode(
                                            base64_decode(
                                                $b64[ 2 ][ 0 ][ 0 ]
                                            )
                                        )
                                );
                    break;
            }
            return substr_replace(
                $s,
                '_#_#_'. base64_encode( $xclean ),
                $b64[ 2 ][ 0 ][ 1 ],
                strlen( $b64[ 2 ][ 0 ][ 0 ] )
            );
        }
        else {
            return $s;
        }
    }
    protected static function cleanXSS( string $s ): string {
        // base64 injection prevention
        $st = self::escape( $s, 'attr' );
        return preg_replace([
                // JSON unicode
                '/\\\\u?{?([a-f0-9]{4,}?)}?/mi',                                                                    // [1] unicode JSON clean
                // Data b64 safe
               '/\*\w*\*/mi',                                                                                            // [2] unicode simple clean
                // Malware payloads
                '/:?e[\s]*x[\s]*p[\s]*r[\s]*e[\s]*s[\s]*s[\s]*i[\s]*o[\s]*n[\s]*(:|;|,)?\w*/mi',    // [3]  (:expression) evalution
                '/l[\s]*i[\s]*v[\s]*e[\s]*s[\s]*c[\s]*r[\s]*i[\s]*p[\s]*t[\s]*(:|;|,)?\w*/mi',         // [4]  (livescript:) evalution
                '/j[\s]*s[\s]*c[\s]*r[\s]*i[\s]*p[\s]*t[\s]*(:|;|,)?\w*/mi',                                 // [5]  (jscript:) evalution
                '/j[\s]*a[\s]*v[\s]*a[\s]*s[\s]*c[\s]*r[\s]*i[\s]*p[\s]*t[\s]*(:|;|,)?\w*/mi',       // [6]  (javascript:) evalution
                '/b[\s]*e[\s]*h[\s]*a[\s]*v[\s]*i[\s]*o[\s]*r[\s]*(:|;|,)?\w*/mi',                     // [7]  (behavior:) evalution
                '/v[\s]*b[\s]*s[\s]*c[\s]*r[\s]*i[\s]*p[\s]*t[\s]*(:|;|,)?\w*/mi',                      // [8]  (vsbscript:) evalution
                '/v[\s]*b[\s]*s[\s]*(:|;|,)?\w*/mi',                                                              // [9]  (vbs:) evalution
                '/e[\s]*c[\s]*m[\s]*a[\s]*s[\s]*c[\s]*r[\s]*i[\s]*p[\s]*t*(:|;|,)?\w*/mi',        // [10] (ecmascript:) possible ES evalution
                '/b[\s]*i[\s]*n[\s]*d[\s]*i[\s]*n[\s]*g*(:|;|,)?\w*/mi',                                 // [11] (-binding) payload
                '/\+\/v(8|9|\+|\/)?/mi',                                                                          // [12] (UTF-7 mutation)
                // Some entities
                '/&{\w*}\w*/mi',                                                                                   // [13] html entites clenup
                '/&#\d+;?/m',                                                                                      // [14] html entites clenup
                // Script tag encoding mutation issue
                '/\¼\/?\w*\¾\w*/mi',                                                                         // [21] mutation KOI-8
                '/\+ADw-\/?\w*\+AD4-\w*/mi',                                                         // [22] mutation old encodings
                '/\/*?%00*?\//m',
                // base64 escaped
                '/_#_#_/mi',                                                                                       // [23] base64 escaped marker cleanup          
            ],
            // Replacements steps :: 23
            ['&#x$1;', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            str_ireplace(
                ['\u0', '&colon;', '&tab;', '&newline;'],
                ['\0', ':', '', ''],
            // U-HEX prepare step
            self::hexToSymbols( $st ))
        );
    }
}

function xss_cleanernottested2($input_str) {
    $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
    return $return_str;
}

function xss_cleanernottested3($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}
  ?>
