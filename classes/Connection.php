<?php


/**
 * Class Connection
 */
class Connection{
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $url = "https://".C_SERVER.":2087/json-api/";

    /**
     * Connection constructor.
     * @param $user
     * @param $token
     * @param $host
     * @param $uri
     */
    public function __construct($uri){
        $this->user = C_USER;
        $this->token = C_TOKEN;
        $this->host = C_HOST;
        $this->url .= $uri;
    }

    /**
     * @param null $request
     * @return bool|mixed|string
     */
    public function query($request=null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        if($request != null)
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $request);

        $header[0] = "Authorization: whm $this->user:$this->token";
        $header[1] = "Content-Type: text/plain";

//        $header2 = array(
//            'Content-Type: application/json',
//            'Authorization: whm '.$this->user.':'.$this->token,
//        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $this->url);

        $response = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($http_status != 200) {
            return $this->httpCode($http_status);
        }
        curl_close($curl);
        return $response;
    }

    /**
     * @return string
     */
    public function json(){
        $json = json_decode($this->query());
        if($json->{'metadata'}->{'command'} == 'createacct') {
            return $json->{'metadata'}->{'reason'}.$json->{'metadata'}->{'output'}->{'raw'};
        }
        if($json->{'metadata'}->{'command'} == 'listaccts') {
            $array = array();
            if(isset($json->{'data'})) {
                foreach ($json->{'data'}->{'acct'} as $userdetails) {
                    $array[] = "\tUSERNAME: " . $userdetails->{'user'} . "\tDOMAIN: " . $userdetails->{'domain'} . "\tEMAIL: " . $userdetails->{'email'} . "\tPLAN: " . $userdetails->{'plan'} . "\n<br>";
                }
                print_r($array);
            }
        }
        return $json->{'metadata'}->{'reason'};
    }

    /**
     *
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /**
     * @return bool|mixed|string
     */
    public function __toString()
    {
        return $this->query();
    }

    /**
     * @param $httpCode
     * @return mixed
     */
    private function httpCode($httpCode){
        $response = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing', // WebDAV; RFC 2518
            103 => 'Early Hints', // RFC 8297
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information', // since HTTP/1.1
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content', // RFC 7233
            207 => 'Multi-Status', // WebDAV; RFC 4918
            208 => 'Already Reported', // WebDAV; RFC 5842
            226 => 'IM Used', // RFC 3229
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found', // Previously "Moved temporarily"
            303 => 'See Other', // since HTTP/1.1
            304 => 'Not Modified', // RFC 7232
            305 => 'Use Proxy', // since HTTP/1.1
            306 => 'Switch Proxy',
            307 => 'Temporary Redirect', // since HTTP/1.1
            308 => 'Permanent Redirect', // RFC 7538
            400 => 'Bad Request',
            401 => 'Unauthorized', // RFC 7235
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required', // RFC 7235
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed', // RFC 7232
            413 => 'Payload Too Large', // RFC 7231
            414 => 'URI Too Long', // RFC 7231
            415 => 'Unsupported Media Type', // RFC 7231
            416 => 'Range Not Satisfiable', // RFC 7233
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot', // RFC 2324, RFC 7168
            421 => 'Misdirected Request', // RFC 7540
            422 => 'Unprocessable Entity', // WebDAV; RFC 4918
            423 => 'Locked', // WebDAV; RFC 4918
            424 => 'Failed Dependency', // WebDAV; RFC 4918
            425 => 'Too Early', // RFC 8470
            426 => 'Upgrade Required',
            428 => 'Precondition Required', // RFC 6585
            429 => 'Too Many Requests', // RFC 6585
            431 => 'Request Header Fields Too Large', // RFC 6585
            451 => 'Unavailable For Legal Reasons', // RFC 7725
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates', // RFC 2295
            507 => 'Insufficient Storage', // WebDAV; RFC 4918
            508 => 'Loop Detected', // WebDAV; RFC 5842
            510 => 'Not Extended', // RFC 2774
            511 => 'Network Authentication Required', // RFC 6585
        );
        return $response[$httpCode];
    }
}