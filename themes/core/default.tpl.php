<!doctype html>
<html lang='en'> 
<head>
  <meta charset='utf-8'/>
  <title><?=$title?></title>
	<link rel='shortcut icon' href='<?=theme_url($favicon)?>'/>
  <link rel='stylesheet' href='<?=$stylesheet?>'/>
   <script>var __adobewebfontsappname__ = "code"</script>
<script src="http://use.edgefonts.net/shojumaru:n4:all.js"></script>
    <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
</head>
 <body>
  <div id='wrap-header'>
    <div id='header'>
      <div id='login-menu'>
        <?=login_menu()?>
      </div>
      <div id='banner'>
        <a href='<?=base_url()?>'><img id='site-logo' src='<?=theme_url($logo)?>' alt='logo' width='<?=$logo_width?>' height='<?=$logo_height?>' /></a>
        <p class='site-title'><a href='<?=base_url()?>'><?=$header?></a></p>
        <p class='site-slogan'><?=$slogan?></p>
      </div>
    </div>
  </div>
  <div id='wrap-main'>
    <div id='main' role='main'>
      <?=get_messages_from_session()?>
      <?=@$main?>
      <?=render_views()?>
    </div>
  </div>
  <div id='wrap-footer'>
    <div id='footer'>
      <?=$footer?>
      <?=get_debug()?>
    </div>
  </div>
</body>
</html>