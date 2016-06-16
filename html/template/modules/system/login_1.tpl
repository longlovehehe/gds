<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6 login"> <![endif]-->
<!--[if IE 7 ]><html class="ie7 login"> <![endif]-->
<!--[if IE 8 ]><html class="ie8 login"><![endif]-->
<!--[if IE 9 ]><html class="ie9 login"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="login"><!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{"集群通运营管理平台"|L}</title>
        <!--[if lte IE 8]>{'libs/html5'|scriptnocompile}<![endif]-->
        <link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon"/>
        <link href="style/login.css"  rel="stylesheet"  />
        {'reset|animate|login|pic.min'|style}
        <link  href="style/ie6.login.adapter.css" rel="stylesheet" type="text/css" />
        <style>
            a.lock,a.lock:hover{
                cursor: not-allowed;
            }
            .phcolor{ color:#ccc;}
        </style>
    </head>
    <body class="lang_{$smarty.cookies.lang} none_select">
        <div class="nosuper none"></div>
        <div class="login_content">
            <div class="lang">
                <a class="lang" data="cn_ZH">中文版</a>
                <a class="lang" data="en_US">English</a>
            </div>
            <div class="tips animated {if $msg ==''}none{/if}"><span>{$msg}</span></div>
            <div class="login  animated ">
                <section class="ad">
                    <nav>
                        <a class="{if $smarty.cookies.lang eq en_US}_GQT_icon_logo_1x120_en_png{else}_GQT_icon_logo_1x120_png{/if}"></a>
                    </nav>
                    <h1>{"运营管理平台"|L}</h1>
                </section>
                <form id="login1" action="?m=login_check" method="post">
                    <section class="login">
                        <label><span class="title">{"用户名"|L}： </span><input autocomplete="off"  placeholder="{'输入帐号'|L}" required="true" name="username" class="autosend"/></label>
                        <label><span class="title">{"密码"|L}：</span> <input autocomplete="off" id="password" placeholder="{'输入密码'|L}" type="password" required="true" name="password" class="autosend"/></label>

                        <a class="submit login button">{"登录"|L}</a>
                    </section>
                </form>
            </div>
        </div>
        {*<div class="window hide">
            <div class="mask"></div>
            <div class="content">
                <h3>请输入动态密码</h3>
                <a class="close">X</a>
                <p>已向手机 186****0000 发送了动态密码。如果手机号不正确，请联系管理员</p>
                <input autocomplete="off"  />
                <a class="button">验证</a>
            </div>
        </div>*}

        {'login'|scriptmodule}
        <script src="script/com.js"></script>
        <div class='bkimg animated fadeIn'></div>
    </body>
</html>