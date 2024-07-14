<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>>{{ env("APP_NAME")}} - @yeld('title')</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body  style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:12px">
<div class="wrapper" style="background-color: #333; padding: 30px 0;">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
  <tbody>
    <tr>
      <td>
      <table border="0" cellpadding="0" cellspacing="0" class="title" style="background-color: #ffffff;">
        <tbody>
          <tr>
            <td width="40">&nbsp;</td>
            <td class="main" style="text-align: center;padding: 20px 0;" width="520">
              <a href="{{ env('Site.url'); }}" style="border:none; text-decoration:none"><img alt=""  src="{{  env('SITE_URL') }}/img/email/logo.png" style="text-align: center; float: left;display:block" height="100" width="100" /></a>
            </td>
            <td width="40" style="padding-right:10px"><a href="https://www.facebook.com/mayacosmeticos"><img alt=""  src="{{ env('SITE_URL'); }}/img/email/i-facebook.png" style="text-align: center; float: left; display:block" height="45" width="48" /></a></td>
            <td width="40" style="padding-right:10px"><a href="https://www.youtube.com/channel/UCaTCN32ZirtEtskugXXc5eQ"><img alt=""  src="{{ env('SITE_URL') }}/img/email/i-youtube.png" style="text-align: center; float: left; display:block" height="45" width="48" /></a></td>
            <td width="40" style="padding-right:10px"><a href="https://twitter.com/maya_cosmeticos"><img alt=""  src="{{ env('SITE_URL') }}/img/email/i-twitter.png" style="text-align: center; float: left; display:block" height="45" width="48" /></a></td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
    <tr>
      <td>
      <table border="0" cellpadding="0" cellspacing="0" style="background-color: #ede6e6;">
        <tbody>
          <tr>
            <td width="40">&nbsp;</td>
            <!-- Image Top -->
            <td valign="top">
              <a href="http://www.mayacosmeticos.com.br">
                <img alt="" src="{{ env('SITE_URL') }}/img/email/arrow_top.png" style="display: block;" />
              </a>
            </td>
            <td width="40">&nbsp;</td>
          </tr>
          <tr>
            <td width="40">&nbsp;</td>
            <td width="520" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:12px">
                <!-- Principal Container -->
               @yield('content')
            </td>
            <td width="40">&nbsp;</td>
          </tr>
          <tr>
            <td width="40">&nbsp;</td>
            <!-- image Bottom -->
            <td valign="bottom">
              <img alt="" src="{{ env('SITE_URL') }}/img/email/arrow_bottom.png" style="top: 11px; display: block;position: relative;" height="11" width="51" />
            </td>
            <td width="40">&nbsp;</td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
    <tr>
      <td>
      <table border="0" cellpadding="0" cellspacing="0" class="footer" style="background-color: #ffd2d1;">
        <tbody>
          <tr>
            <td width="40">&nbsp;</td>
            <td class="main" style="text-align: center;padding: 35px 0;" width="520">
              <table>
              <tbody>
                <tr>
                  <td style="text-align:left">
                      <p style="font-size: 12px; font-weight: bold;margin:0">
                    Maya Cosm&eacute;ticos
                  </p>
                  <p style="font-size: 11px;margin:0">
                    +55 (12)98868-1452
                  </p>
                  
                  <p style="font-size: 11px;margin:0">
                    atendimento@mayacosmeticos.com.br
                  </p>
                  <a href="https://www.mayacosmeticos.com.br" style="color: #666666; font-size: 11px">www.mayacosmeticos.com.br</a></td>
                </tr>
              </tbody>
            </table>
            </td>
            <td width="40">&nbsp;</td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
    <tr>
      <td>
        <font style="font-size:10px;color:#797878" face="Arial, Helvetica, sans-serif">
          <span style="font-weight:bold">Ana Claudia Nogueira 33087264830</span> - Av. Vale do Paraíba, 485, Jacareí/SP 12309-00 Inscrita no CNPJ 21228933/0001-00 </span></font>
      </td>
    </tr>
  </tbody>
</table>
</div>
</body>
</html>