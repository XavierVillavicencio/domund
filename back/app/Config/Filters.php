<?php

namespace Config;

use App\Libraries\Oauth;
use CodeIgniter\Config\BaseConfig;
use OAuth2\Request;

class Filters extends BaseConfig
{
    // Makes reading things below nicer,
    // and simpler to change out script that's used.
    public $aliases = [
        'csrf' => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'OauthFilter' => \App\Filters\OauthFilter::class,
    ];

    // Always applied before every request
    public $globals = [
        'before' => [
            //'honeypot'
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            //'honeypot'
        ],
    ];

    // Works on all of a particular HTTP method
    // (GET, POST, etc) as BEFORE filters only
    //     like: 'post' => ['CSRF', 'throttle'],
    public $methods = [];

    // List filter aliases and any before/after uri patterns
    // that they should run on, like:
    //    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],

    public $filters = [
        'OauthFilter' => [
            'before' => ['*']
        ]
    ];

    public function __construct()
    {

        return true;
        if ($this->checkIsConsole()) {
            return true; // logbar
        } else {
            $this->checkSSL();
            //echo "checkSSL";
            $this->checkIfServer();
            //echo "chefkifserver";
            $this->checkPathInfo();
            //echo "checkPathInfo";
            $this->checkHttpAuthorization();
            //echo "checkHTTPAuthorization";
        }

        $this->getOauthFilter();
    }

    private function checkSSL()
    {
        if(isset($_SERVER['HTTPS'])){
            if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'on') {
                $error = 'HTTP/1.0 405 Method Not Allowed';
                $code = 405;
                log_message('critical', $code . ': Server is not in ssl'.print_r($_SERVER,true));
                header($error);
                $this->showErrorMessage($code, $error);
            }
        }else{
            $error = 'HTTP/1.0 405 Method Not Allowed';
            $code = 405;
            log_message('critical', $code . ': Server is not in ssl'.print_r($_SERVER,true));
            header($error);
            $this->showErrorMessage($code, $error);
        }


        return $this;
    }

    private function checkIsConsole()
    {


        if (!empty($_SERVER['SESSIONNAME']) && $_SERVER['SESSIONNAME'] === 'Console') {
            return true;
        }
        //
        if (empty($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['CI_ENVIRONMENT'] == 'development' && !empty($_GET['log'])) {
            return true;
        }
    }

    private function checkIfServer()
    {
        if (empty($_SERVER['SSL_TLS_SNI'])) {
            if(empty($_SERVER["HTTP_REFERER"])){
                $error = 'HTTP/1.0 403 Server Not Allowed HTTP_REFERER not set';
                $code = 403;
                log_message('critical', $code . ': Server not in allowed HTTP_REFERER not set');
                header($error);
                $this->showErrorMessage($code, $error);
            }else{
                $_SERVER['SSL_TLS_SNI'] = $_SERVER["HTTP_REFERER"];
            }
        }
        preg_match('/' . str_replace(array('/'), '\/', $_SERVER['SSL_TLS_SNI']) . '/i', $_SERVER['app.allowedHOST'], $coincidencias);
        if (empty($coincidencias)) {
            $error = 'HTTP/1.0 403 Server Not Allowed';
            $code = 403;
            log_message('critical', $code . ': Server not in allowed');
            header($error);
            $this->showErrorMessage($code, $error);
        }

        return $this;
    }

    private function checkPathInfo()
    {
        if (empty($_SERVER['PATH_INFO'])) {
            if ($_SERVER['CI_ENVIRONMENT'] == 'development') {
                return $this;
            } else {
                $error = 'HTTP/1.0 403 Server Not Allowed';
                $code = 403;
                log_message('critical', $code . ': Server not in allowed, no path_info');
                header($error);
                $this->showErrorMessage($code, $error);
            }
        }

        return $this;
    }

    private function checkHttpAuthorization()
    {
        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return $this;
        } else {
            /* if modrewrite is activated */
            if(!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])){
                $_SERVER['HTTP_AUTHORIZATION'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
                return $this;
            }
            $error = 'HTTP/1.0 401 Unauthorized	';
            $code = 401;
            log_message('critical', $code . ': Unauthorized');
            header($error);
            $this->showErrorMessage($code, $error);
        }
    }

    private function getOauthFilter()
    {
        global $protected, $public, $userData, $sesionDataLoged;
        $public_permisson = false;
        /* como el filtro no es basic, pasamos a revisar un bearer*/
        $closed_token = trim(str_replace(array('Bearer', 'Basic'), '', $_SERVER['HTTP_AUTHORIZATION']));
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $ip = $_SERVER['REMOTE_ADDR'];
        switch (strtolower($_SERVER['REQUEST_METHOD'])) {
            case 'get':
                $jdata = $_GET;
                break;
            case 'post':
                $jdata = $_POST;
                break;
            case 'put':
                $jdata = $request->getRawInput();
                break;
            case 'patch':
                $jdata = $request->getRawInput();
                break;
            case 'delete':
                $jdata = array("Ha eliminado un dato, fíjate en el url");
                break;
            default:
                $jdata = $request;
                break;
        }
        $jdata[strtolower($_SERVER['REQUEST_METHOD'])] = $jdata;
        $server = $_SERVER;
        sort($server);
        sort($jdata);
        $jdataTmp = json_encode(array_merge($jdata, $server));
        /* filtro para el basic auth*/
        preg_match('/Basic/i', $_SERVER['HTTP_AUTHORIZATION'], $coincidencias);
        if (!empty($coincidencias[0])) {

            $tmpauthuser = str_replace('Basic ','',$_SERVER['HTTP_AUTHORIZATION']);
            $tmpauthuser = explode(':',base64_decode($tmpauthuser));

            if(!empty($tmpauthuser[0])){
                $_SERVER['PHP_AUTH_USER'] = $tmpauthuser[0];
                $_SERVER['PHP_AUTH_PW'] = $tmpauthuser[1];
            }else{
                $error = 'HTTP/1.0 401 Unauthorized  user is invalid    ';
                $code = 401;
                log_message('critical', $code . ': Unauthorized  user is invalid\'');
                header($error);
                $this->showErrorMessage($code, $error);
            }

            if (empty($_SERVER['PHP_AUTH_PW'])) {
                $error = 'HTTP/1.0 401 Unauthorized  user is invalid	';
                $code = 401;
                log_message('critical', $code . ': Unauthorized  password is invalid\'');
                header($error);
                $this->showErrorMessage($code, $error);
            }

            $query = $db->query("select * from administration.sp_savelogbasic('" . $_SERVER['PHP_AUTH_USER'] . "','" . $_SERVER['PHP_AUTH_PW'] . "','" . $CurPageURL . "','" . $_SERVER['REQUEST_METHOD'] . "','" . $ip . "','" . $jdataTmp . "')");
            $basicData = (empty($query->getRow())) ? null : $query->getRow();

            if (empty($basicData->out_scope)) {
                $error = 'HTTP/1.0 401 Unauthorized no scope defined	';
                $code = 401;
                log_message('critical', $code . ': Unauthorized no scope defined\'');
                header($error);
                $this->showErrorMessage($code, $error);
            }


            $this->filters = [
                'OauthFilter' => [
                    'before' => ['*']
                ]
            ];

            foreach ($public as $key => $item) {
                if ($public_permisson == true) {
                    break;
                }

                $scope = empty($key) ? null : $key . '\/';

                foreach ($item as $route) {
                    $tmpPath = '\/' . $scope . $route;
                    preg_match('/' . $tmpPath . '/i', $_SERVER['PATH_INFO'], $urlPathInfo);
                    if (!empty($urlPathInfo)) {
                        return true;
                    } else {
                        $public_permisson = false;
                    }
                }
            }

            if (empty($public_permisson)) {
                $error = 'HTTP/1.0 401 Unauthorized, autorization token is invalid, needs http authorization';
                $code = 401;
                log_message('critical', $code . ': Unauthorized, autorization token is invalid, needs http authorization\'');
                header($error);
                $this->showErrorMessage($code, $error);
            }
        }


        $query = $db->query("select * from administration.sp_savelog('" . $closed_token . "','" . $CurPageURL . "','" . $_SERVER['REQUEST_METHOD'] . "','" . $ip . "','" . $jdataTmp . "')");
        $userData = (empty($query->getRow())) ? null : $query->getRow();

        if (empty($userData->out_use_int_id)) {
            $this->filters = [
                'OauthFilter' => [
                    'before' => ['*']
                ]
            ];

            $error = 'HTTP/1.0 401 Unauthorized authorization token is invalid';
            $code = 401;
            log_message('critical', $code . ': Unauthorized authorization token is invalid\'');
            header($error);
            $this->showErrorMessage($code, $error);

            return false;
        } elseif (empty($userData->out_use_int_id)) {
            $error = 'HTTP/1.0 401 Unauthorized authorization token is invalid';
            $code = 401;
            log_message('critical', $code . ': Unauthorized authorization token is invalid\'');
            header($error);
            return false;
        }
        $sesionDataLoged = array(
            'use_text_user' => $userData->out_use_text_name,
            'use_int_id' => $userData->out_use_int_id,
            'use_text_name' => $userData->out_use_text_name,
            'use_text_lastname' => $userData->out_use_text_lastname,
            'use_int_admin' => $userData->out_use_int_admin,
            'out_sp_getusertags' => $userData->out_sp_getusertags
        );

        if (!empty($protected) && !is_array($protected)) {
            $protected = [];
        }

        if (empty($userData->out_use_int_admin)) {
            if (!empty($userData->out_sp_getusertags)) {
                $masTags = explode(',', $userData->out_sp_getusertags);
                //$protected = array_merge($protected, $masTags);
            } else {
                $error = 'HTTP/1.0 401 Unauthorized  no tags defined';
                $code = 401;
                log_message('critical', $code . ': Unauthorized no tags defined\'');
                header($error);
            }
            foreach ($protected as $key => $tag) {
                $scope = empty($key) ? null : $key . '/';
                foreach($tag as $itemTag){
                    $debug_tags[] = "/" . $scope . $itemTag;
                }
            }

            $this->filters = [
                'OauthFilter' => [
                    'before' => $debug_tags
                ]
            ];
        }else{
            return true;
        }
    }

    private function showErrorMessage($error, $message)
    {
        $out = array(
            'body' => array(
                'error' => $error,
                'message' => $message
            )
        );
        echo utf8_encode(json_encode($out));
        exit();
    }
}
