<style type="text/css">
    #remark tr td{
        border:1px solid #CCCCCC;
        text-align: center;
    }
    #remark tr th{
        border:1px solid #CCCCCC;
        text-align: center;
        vertical-align: middle;
    }
</style>
<form class="data">
<table class="base full" id='remark'>
            <tr class="head">
                <th>{"累计用户"|L}</th>
                <th>{"累计在线"|L}</th>
                <th>{"累计对讲次数"|L}</th>
                <th>{"累计通话次数"|L}</th>
                <th>{"已用终端"|L}</th>
                <th>{"已用流量卡"|L}</th>
            </tr>
            <tr>
                <td>{$user_list[0]['sdr_creat_user']}</td>
                <td>{$user_list[0]['sdr_online_user']}</td>
                <td>{$call_list[0]['sdr_ptt_hcount']}</td>
                <td>{$call_list[0]['sdr_call_hcount']}</td>
                <td>{$user_list[0]['sdr_terminal_user']}</td>
                <td>{$user_list[0]['sdr_gprs_user']}</td>
            </tr>
            <tr  class="head">
                <th>{"开户用户"|L}</th>
                <th>{"商用用户"|L}</th>
                <th>{"累计对讲时长"|L}</th>
                <th>{"累计通话时长"|L}</th>
                <th>{"商用终端"|L}</th>
                <th>{"商用流量卡"|L}</th>
            </tr>
            <tr>
                <td>{$user_list[0]['sdr_user']}</td>
                <td>{$user_list[0]['sdr_commercial_user']}</td>
                <td>{$call_list[0]['sdr_ptt_htime']}({"分钟"|L})</td>
                <td>{$call_list[0]['sdr_call_htime']}({"分钟"|L})</td>
                <td>{$user_list[0]['sdr_terminal_user_commercial']}</td>
                <td>{$user_list[0]['sdr_gprs_user_commercial']}</td>
            </tr>
            <tr></tr>
        </table>
</form>