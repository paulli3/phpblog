<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* uncomment the following to provide test database connection
			'db'=>array(
				'connectionString'=>'DSN for test database',
			),
			*/
		),
	)
);
/*
 *required: CRequiredValidator
filter: CFilterValidator
match: CRegularExpressionValidator
email: CEmailValidator
url: CUrlValidator
unique: CUniqueValidator
compare: CCompareValidator
length: CStringValidator
in: CRangeValidator
numerical: CNumberValidator
captcha: CCaptchaValidator
type: CTypeValidator
file: CFileValidator
default: CDefaultValueValidator
exist: CExistValidator
boolean: CBooleanValidator
date: CDateValidator
safe: CSafeValidator
unsafe: CUnsafeValidator 

1、CRequiredValidator – 必须值验证属性
requiredValue-mixed-所需的值
strict-boolean-是否比较严格  
实例： array(‘username’, ‘required’), 不能为空
array(‘username’, ‘required’, ‘requiredValue’=>’lh’,'message’=> ‘usernmae must be lh’), 这个值必须为lh,如果填其他值还是会验证不过
array(‘username’, ‘required’, ‘requiredValue’=>’lh’, ‘strict’=>true), 严格验证 还可以在后面加 ‘message’=>”,’on’=>这些
2、CFilterValidator 过滤验证属性
filter – 方法名 (调用用户自己定义的函数)
实例：
array(‘username’, ‘test’) function test() { $username = $this->username; if($username != ‘lh’){ $this->addError(‘username’, ‘username must be lh’); } }
使用这个方法如果你还在array里面写message=>”,给出的提示信息还是你的test里面的。也就是以test里面的错误信息为准
3、CRegularExpressionValidator -
正则验证属性allowEmpty – 是否为空(默认true)
not-是否反转的验证逻辑(默认false) pattern – 正则表达式匹配实例：
// 匹配a-z array(‘username’, ‘match’, ‘allowEmpty’=>true, ‘pattern’=>’/[a-z]/i’,'message’=>’必须为字母’),
// 匹配不是a-z array(‘username’, ‘match’, ‘allowEmpty’=>true, ‘not’=>true, ‘pattern’=>’/[a-z]/i’,'message’=>’必须不是字母’),
4、CEmailValidator –邮箱验证属性：
allowEmpty – 是否为空
allowName – 是否允许在电子邮件地址的名称
checkMx – 是否检查电子邮件地址的MX记录
checkPort – 是否要检查端口25的电子邮件地址
fullPattern – 正则表达式，用来验证电子邮件地址与名称的一部分
pattern – 正则表达式，
用来验证的属性值实例： array(‘username’, ‘email’, ‘message’=>’必须为电子邮箱’, ‘pattern’=>’/[a-z]/i’),
5、CUrlValidator – url验证属性：
allowEmpty – 是否为空
defaultScheme – 默认的URI方案
pattern – 正则表达式
validSchemes – 清单应视为有效的URI计划。
实例：
array(‘username’, ‘url’, ‘message’=>’must url’),
array(‘username’, ‘url’, ‘defaultScheme’=>’http://www.baidu.com’),
6、CUniqueValidator – 唯一性验证属性：
allowEmpty – 是否为空
attributeName – 属性名称
caseSensitive – 区分大小写
className – 类名
criteria – 额外的查询条件
实例：
array(‘username’, ‘unique’, ‘message’=>’该记录存在’),
array(‘username’, ‘unique’, ‘caseSensitive’=>false, ‘message’=>’该记录存在’),
7、CCompareValidator – 比较验证属性：
allowEmpty – 是否为空
compareAttribute – 需要比较的属性
compareValue -比较的值
operator – 比较运算符
strict – 严格验证（值和类型都要相等)
实例： // 与某个值比较 array(‘username’, ‘compare’, ‘compareValue’=>’10′, ‘operator’=>’>’, ‘message’=>’必须大于10′),
 // 与某个提交的属性比较 array(‘username’, ‘compare’, ‘compareAttribute’=>’password’, ‘operator’=>’>’, ‘message’=>’必须大于password’),
8、CStringValidator – 字符串验证属性：
allowEmpty – 是否为空
encoding – 编码
is – 确切的长度
max – 最大长度
min – 最小长度
tooLong – 定义值太大的错误
tooShort – 定义最小长度的错误
实例： array(‘username’, ‘length’, ‘max’=>10, ‘min’=>5, ‘tooLong’=>’太长了’, ‘tooShort’=>’太短了’),
array(‘username’, ‘length’, ‘is’=>5, ‘message’=>’长度必须为5′),
9、CRangeValidator – 在某个范围内属性：
allowEmpty – 是否为空
not – 是否反转的验证逻辑。
range – array范围
strict – 严格验证(类型和值都要一样)
实例： array(‘username’, ‘in’, ‘range’=>array(1,2,3,4,5), ‘message’=>’must in 1 2 3 4 5′),
array(‘username’, ‘in’, ‘not’=>true, ‘range’=>array(1,2,3,4,5), ‘message’=>’must not in 1 2 3 4 5′),
10、CNumberValidator – 数字验证属性：
allowEmpty – 是否为空
integerOnly – 整数
integerPattern – 正则表达式匹配整数
max – 最大值
min – 最小值
numberPattern – 匹配号码
tooBig – 值太大时的错误提示
tooSmall – 值太小时的错误提示
实例： array(‘username’, ‘numerical’, ‘integerOnly’=>true, ‘message’=>’must be int’),
array(‘username’, ‘numerical’, ‘integerOnly’=>true, ‘message’=>’must be int’, ‘max’=>100, ‘min’=>10, ‘tooBig’=>’is too big’, ‘tooSmall’=>’is too small’),
11、CCaptchaValidator – 验证码验证属性：
allowEmpty – 是否为空
caseSensitive – 区分大小写
12、CTypeValidator – 类型验证属性：
allowEmpty – 是否为空
dateFormat – 日期应遵循的格式模式(‘MM/dd/yyyy’)
datetimeFormat – 日期时间应遵循的格式模式(‘MM/dd/yyyy hh:mm’)
timeFormat – 时间应遵循的格式模式(‘hh:mm’)
type – 类型 ‘string’, ‘integer’, ‘float’, ‘array’, ‘date’, ‘time’ and ‘datetime’
实例： array(‘username’, ‘type’, ‘dateFormat’=>’MM/dd/yyyy’, ‘type’=>’date’),
13、CFileValidator – 文件验证属性：
allowEmpty – 是否为空
maxFiles – 最大文件数
maxSize – 文件的最大值
minSize – 最小值
tooLarge – 太大时的错误信息
tooMany – 太多时的错误信息
tooSmall – 太小时的错误信息
types – 允许的文件扩展名
wrongType – 扩展名错误时给出的错误信息
14、CDefaultValueValidator – 默认值属性：
setOnEmpty – 设置为空
value – 默认值
实例： array(‘username’, ‘default’, ‘setOnEmpty’=>true, ‘value’=>’lh’),
15、CExistValidator – 是否存在属性：
allowEmpty = 是否为空
attributeName – 属性名称
className – 类名
criteria – 标准
16、CBooleanValidator – 布尔类型验证属性：
allowEmpty – 是否为空
falseValue – 错误状态的值
strict – 严格验证
trueValue – 真实状态的值
实例： array(‘username’, ‘boolean’, ‘trueValue’=>1, ‘falseValue’=>-1, ‘message’=>’the value must be 1 or -1′),
17、CDateValidator – 日期验证属性：
allowEmpty – 是否为空
format – 日期值应遵循的格式模式
timestampAttribute – 接收解析结果的属性名称
 * 
 * 
 */