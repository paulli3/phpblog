<?php

/*
PHP的数据库操作
PHP一般的数据库最佳合作对象肯定是mysql
2者都是开源免费
PHP语言很简单，很多东西，都是通过扩展实现的，比如mysql，msqli，curl，memcache链接，redis链接等等

这里我们要将的就是mysql
首先，我们要知道的是，自己的php运行环境是否支持mysql。  也就是是否有加载mysql扩展模块
检测方式可以使用 

查看php加载了哪些模块，可以使用如下方式
1,命令行 : php.ext -m
C:\Users\Administrator.PC-20130119TPWG>php -m
[PHP Modules]
........
....
gd
hash
iconv
json
libxml
mbstring
mcrypt
mhash
mysql
mysqli
mysqlnd
......
等等
2，php内部函数
C:\Users\Administrator.PC-20130119TPWG>php -r "print_r(get_loaded_extensions());"
Array
(
    [0] => Core
    [1] => bcmath
    [2] => calendar
    [3] => com_dotnet
    [4] => ctype
    [5] => date
    [6] => ereg
    [7] => filter
    [8] => ftp
    [9] => hash
    [10] => iconv
    [11] => json
    [12] => mcrypt
    [13] => SPL
    [14] => odbc
    [15] => pcre
    [16] => Reflection
    [17] => session
    [18] => standard
    [19] => mysqlnd
    [20] => tokenizer
    [21] => zip
    [22] => zlib
    [23] => libxml
    [24] => dom
    [25] => PDO
    [26] => Phar
    [27] => SimpleXML
    [28] => wddx
    [29] => xml
    [30] => xmlreader
    [31] => xmlwriter
    [32] => mbstring
    [33] => gd
    [34] => mysql
    [35] => mysqli
    [36] => pdo_mysql
    [37] => pdo_sqlite
    [38] => mhash
    [39] => xdebug
)

3.查看某个模块，PHP是否支持
C:\Users\Administrator.PC-20130119TPWG>php -r "var_dump(extension_loaded('mysql'));"
bool(true)

C:\Users\Administrator.PC-20130119TPWG>php -r "var_dump(extension_loaded('mysql1'));"
bool(false)

4.查看某个模块里面，所支持的函数
C:\Users\Administrator.PC-20130119TPWG>php -r "var_dump(get_extension_funcs('mysql'));"
array(61) {
  [0] =>
  string(13) "mysql_connect"
  [1] =>
  string(14) "mysql_pconnect"
  [2] =>
  string(11) "mysql_close"
  [3] =>
  string(15) "mysql_select_db"
  [4] =>
  string(11) "mysql_query"
  [5] =>
  string(22) "mysql_unbuffered_query"
  [6] =>
  string(14) "mysql_db_query"
  [7] =>
  string(14) "mysql_list_dbs"
  [8] =>
  string(17) "mysql_list_tables"
  [9] =>
  string(17) "mysql_list_fields"
  [10] =>
  string(20) "mysql_list_processes"
  [11] =>
  string(11) "mysql_error"
  [12] =>
  string(11) "mysql_errno"
  [13] =>
  string(19) "mysql_affected_rows"
  [14] =>
  string(15) "mysql_insert_id"
  [15] =>
  string(12) "mysql_result"
  [16] =>
  string(14) "mysql_num_rows"
  [17] =>
  string(16) "mysql_num_fields"
  [18] =>
  string(15) "mysql_fetch_row"
  [19] =>
  string(17) "mysql_fetch_array"
  [20] =>
  string(17) "mysql_fetch_assoc"
  [21] =>
  string(18) "mysql_fetch_object"
  [22] =>
  string(15) "mysql_data_seek"
  [23] =>
  string(19) "mysql_fetch_lengths"
  [24] =>
  string(17) "mysql_fetch_field"
  [25] =>
  string(16) "mysql_field_seek"
  [26] =>
  string(17) "mysql_free_result"
  [27] =>
  string(16) "mysql_field_name"
  [28] =>
  string(17) "mysql_field_table"
  [29] =>
  string(15) "mysql_field_len"
  [30] =>
  string(16) "mysql_field_type"
  [31] =>
  string(17) "mysql_field_flags"
  [32] =>
  string(19) "mysql_escape_string"
  [33] =>
  string(24) "mysql_real_escape_string"
  [34] =>
  string(10) "mysql_stat"
  [35] =>
  string(15) "mysql_thread_id"
  [36] =>
  string(21) "mysql_client_encoding"
  [37] =>
  string(10) "mysql_ping"
  [38] =>
  string(21) "mysql_get_client_info"
  [39] =>
  string(19) "mysql_get_host_info"
  [40] =>
  string(20) "mysql_get_proto_info"
  [41] =>
  string(21) "mysql_get_server_info"
  [42] =>
  string(10) "mysql_info"
  [43] =>
  string(17) "mysql_set_charset"
  [44] =>
  string(5) "mysql"
  [45] =>
  string(15) "mysql_fieldname"
  [46] =>
  string(16) "mysql_fieldtable"
  [47] =>
  string(14) "mysql_fieldlen"
  [48] =>
  string(15) "mysql_fieldtype"
  [49] =>
  string(16) "mysql_fieldflags"
  [50] =>
  string(14) "mysql_selectdb"
  [51] =>
  string(16) "mysql_freeresult"
  [52] =>
  string(15) "mysql_numfields"
  [53] =>
  string(13) "mysql_numrows"
  [54] =>
  string(13) "mysql_listdbs"
  [55] =>
  string(16) "mysql_listtables"
  [56] =>
  string(16) "mysql_listfields"
  [57] =>
  string(13) "mysql_db_name"
  [58] =>
  string(12) "mysql_dbname"
  [59] =>
  string(15) "mysql_tablename"
  [60] =>
  string(16) "mysql_table_name"
}

C:\Users\Administrator.PC-20130119TPWG>php -r "var_dump(get_extension_funcs('mbstring'));
array(68) {
  [0] =>
  string(15) "mb_convert_case"
  [1] =>
  string(13) "mb_strtoupper"
  [2] =>
  string(13) "mb_strtolower"
  [3] =>
  string(11) "mb_language"
  [4] =>
  string(20) "mb_internal_encoding"
  [5] =>
  string(13) "mb_http_input"
  [6] =>
  string(14) "mb_http_output"
  [7] =>
  string(15) "mb_detect_order"
  [8] =>
  string(23) "mb_substitute_character"
  [9] =>
  string(12) "mb_parse_str"
  [10] =>
  string(17) "mb_output_handler"
  [11] =>
  string(22) "mb_preferred_mime_name"
  [12] =>
  string(9) "mb_strlen"
  [13] =>
  string(9) "mb_strpos"
  [14] =>
  string(10) "mb_strrpos"
  [15] =>
  string(10) "mb_stripos"
  [16] =>
  string(11) "mb_strripos"
  [17] =>
  string(9) "mb_strstr"
  [18] =>
  string(10) "mb_strrchr"
  [19] =>
  string(10) "mb_stristr"
  [20] =>
  string(11) "mb_strrichr"
  [21] =>
  string(15) "mb_substr_count"
  [22] =>
  string(9) "mb_substr"
  [23] =>
  string(9) "mb_strcut"
  [24] =>
  string(11) "mb_strwidth"
  [25] =>
  string(13) "mb_strimwidth"
  [26] =>
  string(19) "mb_convert_encoding"
  [27] =>
  string(18) "mb_detect_encoding"
  [28] =>
  string(17) "mb_list_encodings"
  [29] =>
  string(19) "mb_encoding_aliases"
  [30] =>
  string(15) "mb_convert_kana"
  [31] =>
  string(20) "mb_encode_mimeheader"
  [32] =>
  string(20) "mb_decode_mimeheader"
  [33] =>
  string(20) "mb_convert_variables"
  [34] =>
  string(23) "mb_encode_numericentity"
  [35] =>
  string(23) "mb_decode_numericentity"
  [36] =>
  string(12) "mb_send_mail"
  [37] =>
  string(11) "mb_get_info"
  [38] =>
  string(17) "mb_check_encoding"
  [39] =>
  string(17) "mb_regex_encoding"
  [40] =>
  string(20) "mb_regex_set_options"
  [41] =>
  string(7) "mb_ereg"
  [42] =>
  string(8) "mb_eregi"
  [43] =>
  string(15) "mb_ereg_replace"
  [44] =>
  string(16) "mb_eregi_replace"
  [45] =>
  string(8) "mb_split"
  [46] =>
  string(13) "mb_ereg_match"
  [47] =>
  string(14) "mb_ereg_search"
  [48] =>
  string(18) "mb_ereg_search_pos"
  [49] =>
  string(19) "mb_ereg_search_regs"
  [50] =>
  string(19) "mb_ereg_search_init"
  [51] =>
  string(22) "mb_ereg_search_getregs"
  [52] =>
  string(21) "mb_ereg_search_getpos"
  [53] =>
  string(21) "mb_ereg_search_setpos"
  [54] =>
  string(16) "mbregex_encoding"
  [55] =>
  string(6) "mbereg"
  [56] =>
  string(7) "mberegi"
  [57] =>
  string(14) "mbereg_replace"
  [58] =>
  string(15) "mberegi_replace"
  [59] =>
  string(7) "mbsplit"
  [60] =>
  string(12) "mbereg_match"
  [61] =>
  string(13) "mbereg_search"
  [62] =>
  string(17) "mbereg_search_pos"
  [63] =>
  string(18) "mbereg_search_regs"
  [64] =>
  string(18) "mbereg_search_init"
  [65] =>
  string(21) "mbereg_search_getregs"
  [66] =>
  string(20) "mbereg_search_getpos"
  [67] =>
  string(20) "mbereg_search_setpos"
}

C:\Users\Administrator.PC-20130119TPWG>php -r "var_dump(get_extension_funcs('mb'));"
bool(false)



*/

