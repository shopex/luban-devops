## 功能介绍
本项目是luban架构的java服务端开发包，用来启动服务并发布服务接口文档，供后续开发者调用。下面文档将会介绍服务编写以及发布的方法，和如何生成doc接口。


## 编写服务
将所有服务实现类放到同一个package下,并在在函数之上加上注释，注释作用是生成接口文档，需严格按照给出的格式追加注释，然后编写业务逻辑，**参数都是以map对象的形式传入的** server服务类中的一个样例函数
```
	// @Title 新增会员
	// @Doc 本接口说明
	// @Param  mobile        string  true  手机
	// @Param  name          string  false  姓名
	// @Param  email         string  false  邮箱
	// @Param  state_id      int32   false  省份id
	// @Param  city_id       int32   false  城市id
	// @Param  district_id   int32   false  地区id
	// @Param  point         int32   false  积分
	// @Param  level_id      int32   false  会员等级
	// @Param  growth_value  int32   false  成长值
	// @Param  meta      string  false  扩展字段: key:value;key:value
	public HashMap<String,String> New(HashMap<String,String> args){
		
		HashMap<String,String> remap = new HashMap<String,String>();
		String errorcode="0";
		String mobile = args.get("mobile");
		if(mobile==null || !mobile.matches("\\d{11}")){
			errorcode="1001";
			remap.put("code", errorcode);
			remap.put("status", "fail");
			remap.put("error_msg", "手机号格式不正确");
			remap.put("data", "");
			return remap;
		}else{
		remap.put("code", errorcode);
		remap.put("error_msg", "");
		remap.put("status", "succ");
		return remap;
		}
		

		
	}
```
## 生成api文档类
构造CreateDocJava对象传入服务实现类所在包名和Doc.java所在的路径，下面代码中injavapath是服务类所在的包位置，outdocfile是doc接口所在包的位置，该操作会生成Doc.java的代码，生成好之后直接编译即可使用***以下只提供部分代码，具体代码需参见下面“启动服务样例”的完整代码***
```
String injavapath="src/main/java/server";
String outdocfile="src/main/java/doc/Doc.java";
new CreateDocJava(injavapath, outdocfile).createDoc();

```

## 注册doc函数
利用上面步骤生成的Doc.java 做以下操作即可完成doc接口的发布***以下只提供部分代码，具体代码需参见下面“启动服务样例”的完整代码***
```
//注册doc函数
docClassName="doc.Doc";//完整的包名和类名
HproseTcpServer server = new HproseTcpServer("tcp://192.168.199.241:8088");//hprose服务的创建
Services ss = new Services(docClassName);
server.add("doc", ss);

```
## 服务发布代码
服务发布代码将会在Doc.java最下面生成,用于注册服务业务***以下只提供部分代码，具体代码需参见下面“启动服务样例”的完整代码***
```
Base base = new Base();
server.add("Hello",base,"base_hello");
server.add("New",base,"base_new");
server.add("Update",base,"base_update");
TagGroup taggroup = new TagGroup();
server.add("New",taggroup,"tag_group_new");
server.add("Find",taggroup,"tag_group_find");
server.add("Update",taggroup,"tag_group_update");
server.add("Get",taggroup,"tag_group_get");
server.add("Remove",taggroup,"tag_group_remove");
```
## 启动服务样例
```
package org.example.test;

import hprose.server.HproseTcpServer;

import java.io.IOException;
import java.net.URISyntaxException;

import server.Base;
import server.TagGroup;

import com.shopex.hprose.getdoc.CreateDocJava;
import com.shopex.hprose.server.Services;

import etcd.EtcdUtil;

public class Test {

	private static HproseTcpServer server = null;
    /**
     * inclould package name example com.shopex.hprose.getdoc.Doc
     * 此类名对应java类由createdoc()自动生成 直接调用new Test().createdoc();
     */
	private static String docClassName;
	
	@SuppressWarnings("unused")
	private void createdoc(){
		CreateDocJava cj = new CreateDocJava("src/main/java/server", "src/main/java/doc/Doc.java");
		cj.createDoc();
	}
	
	
	public static void startHproseServer() throws IOException, URISyntaxException {
		try {
			//创建到etcd服务器的链接
			EtcdUtil c = new EtcdUtil("http://192.168.10.96:2379");
			//每个5秒重置一个节点值 该节点值生效时间是10秒
			c.puttmp("/luban/nodes/javamember/192.168.199.241:8088", "ok");
		} catch (Exception e) {
			e.printStackTrace();
		} 
		//创建hprose服务
		server = new HproseTcpServer("tcp://192.168.199.241:8088");
		//注册doc函数
		docClassName="doc.Doc";
		Services ss = new Services(docClassName);
		server.add("doc", ss);
		
		
		
		//注册业务函数
		Base base = new Base();
		server.add("Hello",base,"base_hello");
		server.add("New",base,"base_new");
		TagGroup taggroup = new TagGroup();
		server.add("New",taggroup,"tag_group_new");
		server.add("Find",taggroup,"tag_group_find");
        server.start();
	}

}

```


## 测试客户端
```
import hprose.client.HproseTcpClient;

public class TestCli {
	
	public static void main(String[] args) throws Throwable {
		HproseTcpClient hc2 = new HproseTcpClient("tcp://192.168.199.241:8088");
		try {
			String hm2 = hc2.invoke("doc").toString();
			System.out.println(hm2);
		} catch (Throwable e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
	}

}

```
## 源码
项目源码托管在github上 下载地址是 https://github.com/zhongjiqiang/luban-srv-java.git
```
git clone  https://github.com/zhongjiqiang/luban-srv-java.git
```

## maven源
```
  <dependencies>
    <dependency>
      <groupId>com.github.zhongjiqiang</groupId>
      <artifactId>luban-srv-java</artifactId>
      <version>0.0.1</version>
    </dependency>
  </dependencies>
```
