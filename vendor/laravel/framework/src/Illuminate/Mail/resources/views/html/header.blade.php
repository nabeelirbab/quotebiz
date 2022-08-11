<?php
 $sitelargelogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
 ?>
<tr>
<td class="header">
<a href="{{ url('') }}" style="display: inline-block;">

<h4>{{\Acelle\Model\Setting::get('site_name')}}</h4>

</a>
</td>
</tr>
