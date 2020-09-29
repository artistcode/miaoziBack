# 好苗子人才站 API
### 登录流程 

1. 客户端发送post请求 携带用户名 和 用户密码

2. 服务端接收到用户名密码 

3. 验证 用户名密码是否正确

4. 使用sha1 算法 创建token 保存在数据库  并返回token 给客户端 

   服务端代码

   ```php
   public function Login(){
           $param  = request()->param();
           $post_user = [
            'phone'=>$param['phone'],
            'password'=>$param['password']
           ];
           $user = $this->where($post_user)->find();
           if(!$user) throw new Exception([
                                           'msg'=>'用户名或密码错误'
                                           'code'=>'99999'
                                           ]);
   
          return $this->createToken();
   
   
       }
   ```

   

> ### 数据表

```sql
create table member(
	id int unsigned  primary key auto_increment,
    name varchar(5)  not null default '' comment '用户昵称',
    phone varchar(14) not null default '' comment '手机号码',
    token varchar(50) not null default '' comment 'api token',
    expire_time  int unsigned  not null default 0 comment 'token 过期时间',
    sex   tinyint(1) not null default 0 comment '0 男 1女',
    avatar varchar(50) not null default 0 comment '头像',
    menery decimal(10,2) not null default 0 comment '余额',
    status tinyint(1) not null default 0 comment '0正常 1禁用',
    create_time int unsigned  not null default 0 comment'创建时间',
    update_time int unsigned  not null default 0 comment '更新时间',
    delete_time int unsigned  not null default 0 comment '删除时间'
)engine=innodb default charset=utf8;
```







