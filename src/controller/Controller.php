<?php

namespace Controller;

class Controller
{
    /**
     * 保存ファイルのパス
     * @param string $file_path フルパスを書く
     * @param string $content 書き込む内容
     */
    protected function file_put_contents(string $file_path, string $content)
    {

        $explode = explode("/", $file_path);
        unset($explode[count($explode) - 1]);

        $check_path = "";
        foreach ($explode as $val) {
            $check_path .= $val . "/";

            echo "<BR>", __DIR__ . "/" . $check_path, "<BR>";
            if (!file_exists(__DIR__ . "/" . $check_path)) {
                mkdir($check_path);
            }
        }

        file_put_contents(__DIR__ . $file_path, $content);
    }

    protected function get_php_opcode(string $php_path): array
    {
        $command = "echo print exec | phpdbg -v {$php_path}";
        $descriptor_spec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
        ];
        $process = proc_open($command, $descriptor_spec, $pipes);


        if (is_resource($process)) {
            fclose($pipes[0]);
            fclose($pipes[1]);

            $output = [];
            while (!feof($pipes[2])) {
                $get = trim(fgets($pipes[2]));
                if ($get === '') continue;
                $output[] = $get;
            }
            // 先頭３行はいらない
            unset($output[0], $output[1], $output[2]);
            $output = array_values($output);


            $zend_codes = ["FETCH_STATIC_PROP_FUNC_ARG", "ISSET_ISEMPTY_STATIC_PROP", "INIT_STATIC_METHOD_CALL", "DECLARE_LAMBDA_FUNCTION", "FETCH_STATIC_PROP_UNSET", "ASSIGN_STATIC_PROP_REF", "ISSET_ISEMPTY_PROP_OBJ", "ASSIGN_STATIC_PROP_OP", "INIT_NS_FCALL_BY_NAME", "ISSET_ISEMPTY_DIM_OBJ", "DECLARE_CLASS_DELAYED", "POST_INC_STATIC_PROP", "POST_DEC_STATIC_PROP", "FETCH_STATIC_PROP_RW", "FETCH_STATIC_PROP_IS", "FETCH_CLASS_CONSTANT", "IS_SMALLER_OR_EQUAL", "PRE_INC_STATIC_PROP", "PRE_DEC_STATIC_PROP", "FETCH_STATIC_PROP_R", "FETCH_STATIC_PROP_W", "ASSIGN_STATIC_PROP", "SEND_VAR_NO_REF_EX", "INIT_FCALL_BY_NAME", "FETCH_DIM_FUNC_ARG", "FETCH_OBJ_FUNC_ARG", "VERIFY_RETURN_TYPE", "DECLARE_ANON_CLASS", "ISSET_ISEMPTY_THIS", "ADD_ARRAY_ELEMENT", "ISSET_ISEMPTY_VAR", "INIT_DYNAMIC_CALL", "DISCARD_EXCEPTION", "UNSET_STATIC_PROP", "VERIFY_NEVER_TYPE", "IS_NOT_IDENTICAL", "INIT_METHOD_CALL", "DO_FCALL_BY_NAME", "GENERATOR_CREATE", "DECLARE_FUNCTION", "ADD_ARRAY_UNPACK", "HANDLE_EXCEPTION", "ISSET_ISEMPTY_CV", "FETCH_CLASS_NAME", "GENERATOR_RETURN", "GET_CALLED_CLASS", "ARRAY_KEY_EXISTS", "CHECK_UNDEF_ARGS", "CALLABLE_CONVERT", "INCLUDE_OR_EVAL", "FETCH_DIM_UNSET", "FETCH_OBJ_UNSET", "EXT_FCALL_BEGIN", "SEND_VAR_NO_REF", "CALL_TRAMPOLINE", "FETCH_FUNC_ARG", "FETCH_CONSTANT", "CHECK_FUNC_ARG", "INIT_USER_CALL", "ASSIGN_OBJ_REF", "BEGIN_SILENCE", "EXT_FCALL_END", "RETURN_BY_REF", "DECLARE_CONST", "DECLARE_CLASS", "ASSIGN_DIM_OP", "RECV_VARIADIC", "FUNC_NUM_ARGS", "FUNC_GET_ARGS", "SEND_FUNC_ARG", "ASSIGN_OBJ_OP", "SWITCH_STRING", "FETCH_GLOBALS", "VM_LAST_OPCOD", "FETCH_DIM_RW", "FETCH_OBJ_RW", "FETCH_DIM_IS", "FETCH_OBJ_IS", "IS_IDENTICAL", "FETCH_LIST_R", "POST_INC_OBJ", "POST_DEC_OBJ", "ASSERT_CHECK", "FETCH_LIST_W", "IS_NOT_EQUAL", "BIND_LEXICAL", "FETCH_UNSET", "END_SILENCE", "FAST_CONCAT", "FETCH_CLASS", "SEND_VAL_EX", "FE_RESET_RW", "FE_FETCH_RW", "PRE_INC_OBJ", "PRE_DEC_OBJ", "FETCH_DIM_R", "FETCH_OBJ_R", "SEND_VAR_EX", "USER_OPCODE", "FETCH_DIM_W", "SEND_UNPACK", "BIND_GLOBAL", "FETCH_OBJ_W", "BIND_STATIC", "SWITCH_LONG", "CASE_STRICT", "MATCH_ERROR", "FE_RESET_R", "ASSIGN_REF", "FE_FETCH_R", "ASSIGN_DIM", "SEND_ARRAY", "TYPE_CHECK", "ASSIGN_OBJ", "INSTANCEOF", "INIT_FCALL", "YIELD_FROM", "IS_SMALLER", "FETCH_THIS", "INIT_ARRAY", "ASSIGN_OP", "QM_ASSIGN", "UNSET_DIM", "RECV_INIT", "UNSET_OBJ", "FAST_CALL", "SPACESHIP", "SEND_USER", "GET_CLASS", "ROPE_INIT", "CHECK_VAR", "UNSET_VAR", "MAKE_REF", "IS_EQUAL", "SEND_VAL", "UNSET_CV", "ROPE_END", "SEPARATE", "ROPE_ADD", "DO_FCALL", "FAST_RET", "SEND_REF", "EXT_STMT", "SEND_VAR", "COPY_TMP", "FETCH_IS", "COALESCE", "BOOL_NOT", "BOOL_XOR", "FETCH_RW", "POST_INC", "IN_ARRAY", "DO_ICALL", "GET_TYPE", "JMPNZ_EX", "DO_UCALL", "JMP_NULL", "POST_DEC", "FETCH_R", "FE_FREE", "EXT_NOP", "FETCH_W", "DEFINED", "JMP_SET", "JMPZ_EX", "OP_DATA", "PRE_INC", "PRE_DEC", "BW_XOR", "CONCAT", "RETURN", "BW_NOT", "STRLEN", "ASSIGN", "BW_AND", "CLONE", "JMPNZ", "THROW", "TICKS", "COUNT", "MATCH", "BW_OR", "CATCH", "YIELD", "FREE", "CAST", "ECHO", "BOOL", "JMPZ", "CASE", "RECV", "EXIT", "JMP", "POW", "NOP", "MUL", "ADD", "MOD", "DIV", "SUB", "NEW", "SL", "SR"];
            $preg_zend_codes = "(" . implode("|", $zend_codes) . ")";


            foreach ($output as $key => $val) {

                // L0002
                $regex = "/^L0*([1-9][0-9]*)/";
                preg_match($regex, $val, $matches);
                $exec_line = $matches[1];

                $val = preg_replace($regex, "", $val);
                $val = trim($val);


                // 0001
                $regex = "/^0*([0-9]+)/";
                preg_match($regex, $val, $matches);
                $line = $matches[1];

                $val = preg_replace($regex, "", $val);
                $val = trim($val);


                // EXT_STMT
                $regex = "/(?:([TV]\d+)\s=\s)?({$preg_zend_codes})/";
                preg_match($regex, $val, $matches);
                $return = $matches[1];
                $code   = $matches[2];

                $val = preg_replace($regex, "", $val);
                $val = trim($val);


                // 一つ目のOP
                $regex = "/^(\S*)/";
                preg_match($regex, $val, $matches);
                $op1 = $matches[1];

                $val = preg_replace($regex, "", $val);
                $val = trim($val);

                // 二つ目のOP
                $regex = "/^(\S*)/";
                preg_match($regex, $val, $matches);
                $op2 = $matches[1];

                $val = preg_replace($regex, "", $val);
                $val = trim($val);


                // op1 と op2の余計なものを消す

                // op1
                $preg1 = preg_match("/(CV\d+)/", $op1, $matches);
                if ($preg1 === 1) {
                    $op1 = $matches[1];
                }
                $preg = preg_match("/(?<=int\()\d+(?=\))/", $op1, $matches);
                if ($preg === 1) {
                    $op1 = $matches[0];
                }
                $preg = preg_match('/(?<=string\()".*"(?=\))/', $op1, $matches);
                if ($preg === 1) {
                    var_dump($matches);
                    $op1 = $matches[0];
                }

                // op2
                $preg1 = preg_match("/(CV\d+)/", $op2, $matches);
                if ($preg1 === 1) {
                    $op2 = $matches[1];
                }
                $preg = preg_match("/(?<=int\()\d+(?=\))/", $op2, $matches);
                if ($preg === 1) {
                    $op2 = $matches[0];
                }
                $preg = preg_match('/(?<=string\()".*"(?=\))/', $op2, $matches);
                if ($preg === 1) {
                    $op2 = $matches[0];
                }

                $output[$key] = [
                    "exec_line" => $exec_line,
                    "line"      => $line,
                    "code"      => $code,
                    "op1"       => $op1,
                    "op2"       => $op2,
                    "return"    => $return,
                ];
            }
            $output = array_values($output);
            return $output;
        }
        return [];
    }
}
