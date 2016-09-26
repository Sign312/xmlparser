# xmlparser
xmlparser是一个用于xml字符串与PHP数组、对象之间相互转化的工具，简单轻量

2.0版本更新,解决非关联数组转xml问题

### API

* XmlParser::arr2xml()
传入PHP数组,返回XML字符串
注意:数组第一位不得为非关联数组
如: array[0]['name'],array[0]等将不能成功转化

* XmlParser::obj2xml()
传入PHP对象,返回XML字符串

* XmlParser::xml2arr()
传入XML字符串,返回PHP数组

* XmlParser::xml2obj()
传入XML字符串,返回PHP对象

* XmlParser::is_assoc()
判断数组是否为关联数组,传入数组,返回true or false