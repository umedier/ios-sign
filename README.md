静态
```
location / {
	if (!-e $request_filename){
   	 	rewrite "^/([a-zA-Z0-9]{6})$" /user/install/index/$1/ last;
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	}
}
```
解除禁用函数:exec
移动ssl证书
安装zsign
```
git clone https://github.com/zhlynn/zsign.git
cd zsign
chmod +x INSTALL.sh
./INSTALL.sh
ln -s ./build/zsign /usr/bin/zsign
```






数据清理
```


truncate table cmf_verification_code;
truncate table cmf_valid_time;
truncate table cmf_user_warning;
truncate table cmf_user_token;
truncate table cmf_user_score_log;
truncate table cmf_user_posted_log;
truncate table cmf_user_posted;
truncate table cmf_user_login_attempt;
truncate table cmf_user_link_log;
truncate table cmf_user_favorite;
truncate table cmf_user_auth_info;
truncate table cmf_user_action_log;
truncate table cmf_user_action;
truncate table cmf_third_party_user;
truncate table cmf_super_signature_ipa;
truncate table cmf_super_num;
truncate table cmf_super_download_log;
truncate table cmf_sup_charge_log;
truncate table cmf_slide_item;
truncate table cmf_slide;
truncate table cmf_report_record;
truncate table cmf_recycle_bin;
truncate table cmf_portal_tag_post;
truncate table cmf_portal_tag;
truncate table cmf_portal_post;
truncate table cmf_portal_category_post;
truncate table cmf_portal_category;
truncate table cmf_link;
truncate table cmf_ios_udid_list;
truncate table cmf_ios_certificate;
truncate table cmf_downloading;
truncate table cmf_download;
truncate table cmf_domain;
truncate table cmf_comment;
truncate table cmf_charge_log;
truncate table cmf_charge;
truncate table cmf_auth_access;
truncate table cmf_asset;
truncate table cmf_route;
truncate table cmf_nav;
truncate table cmf_nav_menu;


cmf_user
cmf_role
cmf_role_user
cmf_hook
cmf_hook_plugin
cmf_config
cmf_theme_file
cmf_theme
cmf_option
cmf_auth_rule
cmf_admin_menu
cmf_plugin
```









