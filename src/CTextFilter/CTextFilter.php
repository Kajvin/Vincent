<?php
/**
 * A wrapper for various text filtering options.
 * 
 * @package VincentCore
 */
class CTextFilter {

  /**
   * Properties
   */
  public static $instance = null;
 // public static $geshi = null;


  /**
  *HTMLPurifier by Edward Z. Yang, http://htmlpurifier.org/
  * 
 /**
   * Clean your HTML with HTMLPurifier, create an instance of HTMLPurifier if it does not exists. 
   *
   * @param $text string the dirty HTML.
   * @returns string as the clean HTML.
   */
   public static function Purify($text) {   
    if(!self::$instance) {
      require_once(__DIR__.'/htmlpurifier-4.5.0-standalone/HTMLPurifier.standalone.php');
      $config = HTMLPurifier_Config::createDefault();
      $config->set('Cache.DefinitionImpl', null);
      self::$instance = new HTMLPurifier($config);
    }
    return self::$instance->purify($text);
  }
  
  
  
  /**
   * Support Markdown syntax with PHP Markdown. 
   *
   * @param $text string with Markdown text.
   * @return string as formatted HTML.
   */
   public static function Markdown($text) {   
    require_once(__DIR__.'/php-markdown_1q/markdown.php');
    return Markdown($text);
  }
  

  /**
   * Support Markdown syntax with PHP Markdown Extra. 
   *
   * @param $text string with Markdown text.
   * @return string as formatted HTML.
   */
   public static function MarkdownExtra($text) {   
    require_once(__DIR__.'/php_markdown_extra_1.2.7/markdown.php');
    $ret = Markdown($text);
    return $ret;
  }
  

  /**
   * Support SmartyPants for better typography. 
   *
   * @param string text text to be converted.
   * @return string the formatted text.
   */
   public static function SmartyPants($text) {   
    require_once(__DIR__.'/php_smartypants_1.5.1f/smartypants.php');
    return SmartyPants($text);
  }
  

  /**
   * Support enhanced SmartyPants/Typographer for better typography. 
   *
   * @param string text text to be converted.
   * @return string the formatted text.
   */
   public static function Typographer($text) {   
    require_once(__DIR__.'/php_smartypants_typographer_1.0.1/smartypants.php');
    $ret = SmartyPants($text);
    return $ret;
  }
  
  
  /**
   * BBCode formatting converting to HTML.
   *
   * @param string text text to be converted.
   * @return string the formatted text.
   */
  public static function Bbcode2HTML($text) {
    $search = array( 
      '/\[b\](.*?)\[\/b\]/is', 
      '/\[i\](.*?)\[\/i\]/is', 
      '/\[u\](.*?)\[\/u\]/is', 
      '/\[img\](https?.*?)\[\/img\]/is', 
      '/\[url\](https?.*?)\[\/url\]/is', 
      '/\[url=(https?.*?)\](.*?)\[\/url\]/is' 
      );   
    $replace = array( 
      '<strong>$1</strong>', 
      '<em>$1</em>', 
      '<u>$1</u>', 
      '<img src="$1" />', 
      '<a href="$1">$1</a>', 
      '<a href="$1">$2</a>' 
      );     
    return preg_replace($search, $replace, $text);
  }


  /**
   * Make clickable links from URLs in text.
   *
   * @param string text text to be converted.
   * @return string the formatted text.
   */
  public static function MakeClickable($text) {
    return preg_replace_callback(
      '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
     // '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', 
      create_function(
        '$matches',
        'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
      ),
      $text
    );
  }
 /**
   * Init shortcode handling by preparing the option list to an array.
   *
   * @param string $code the code to process.
   * @param string $options for the shortcode.
   * @return array with all the options.
   */
  public static function ShortCodeInit($options) {
    preg_match_all('/[a-zA-Z0-9]+="[^"]+"|\S+/', $options, $matches);

    $res = array();
    foreach($matches[0] as $match) {
      $pos = strpos($match, '=');
      if($pos == false) {
        $res[$match] = true;
      }
      else {
        $key = substr($match, 0, $pos);
        $val = trim(substr($match, $pos+1), '"');
        $res[$key] = $val;
      }
    }

    return $res;
  }


  /**
   * Shortcode for <figure>.
   *
   * @param string $code the code to process.
   * @param string $options for the shortcode.
   * @return array with all the options.
   */
  public static function ShortCodeFigure($options) {
    extract(array_merge(array(
      'id' => null,
      'class' => null,
      'src' => null,
      'title' => null,
      'alt' => null,
      'caption' => null,
      'href' => null,
      'nolink' => false,
    ), CTextFilter::ShortCodeInit($options)), EXTR_SKIP);

    $id = $id ? " id='$id'" : null;
    //$class = $class ? " class='$class'" : null;
    $class = $class ? " class='figure $class'" : " class='figure'";
    $title = $title ? " title='$title'" : null;
    
    if(!$alt && $caption) {
      $alt = $caption;
    }

    if(!$href) {
      $pos = strpos($src, '?');
      $href = $pos ? substr($src, 0, $pos) : $src;
    }

    if(!$nolink) {
      $a_start = "<a href='{$href}'>";
      $a_end = "</a>";
    }

    $html = <<<EOD
<figure{$id}{$class}>
  {$a_start}<img src='{$src}' alt='{$alt}'{$title}/>{$a_end}
  <figcaption markdown=1>{$caption}</figcaption>
</figure>
EOD;

    return $html;
  }


  /**
   * Shorttags to to quicker format text as HTML.
   *
   * @param string text text to be converted.
   * @return string the formatted text.
   */
  public static function ShortTags($text) {
    $callback = function($matches) {
      switch($matches[1]) {
        case 'IMG':
          $caption = t('Image: ');
          $pos = strpos($matches[2], '?');
          $href = $pos ? substr($matches[2], 0, $pos) : $matches[2];
          $src = htmlspecialchars($matches[2]);
          return <<<EOD
<figure>
  <a href='{$href}'><img src='{$src}' alt='{$matches[3]}' /></a>
  <figcaption markdown=1>{$caption}{$matches[3]}</figcaption>
</figure>
EOD;

        case 'IMG2':
          $caption = null; //t('Image: ');
          $pos = strpos($matches[2], '?');
          $href = $pos ? substr($matches[2], 0, $pos) : $matches[2];
          $src = htmlspecialchars($matches[2]);
          return <<<EOD
<figure class="{$matches[4]}">
  <a href='{$href}'><img src='{$src}' alt='{$matches[3]}' /></a>
  <figcaption markdown=1>{$caption}{$matches[3]}</figcaption>
</figure>
EOD;

     
        
        case 'syntax=': return CTextFilter::SyntaxHighlightGeSHi($matches[3], $matches[2]); break;
        case '```': return CTextFilter::SyntaxHighlightGeSHi($matches[3], $matches[2]); break;
        //case 'syntax=': return "<pre>" . highlight_string($matches[3], true) . "</pre>"; break;
        //case 'INCL':  include($matches[2]); break;
        case 'INFO':  return "<div class='info' markdown=1>"; break;
        case '/INFO': return "</div>"; break;
        case 'BASEURL': return CLydia::Instance()->request->base_url; break;
        case 'FIGURE': return CTextFilter::ShortCodeFigure($matches[2]); break;
        default: return "{$matches[1]} IS UNKNOWN SHORTTAG."; break;
      }
    };
	
    $patterns = array(
      '#\[(BASEURL)\]#',
      //'/\[(AUTHOR) name=(.+) email=(.+) url=(.+)\]/',
      '/\[(FIGURE)[\s+](.+)\]/',
      '/\[(IMG) src=(.+) alt=(.+)\]/',
      '/\[(IMG2) src=(.+) alt="(.+)" class="(.+)"\]/',
      '/\[(BOOK) isbn=(.+)\]/',
      '/\[(YOUTUBE) src=(.+) width=(.+) caption=(.+)\]/',
      '/~~~(syntax=)(php|html|html5|css|sql|javascript|bash)\n([^~]+)\n~~~/s',
      '/(```)(php|html|html5|css|sql|javascript|bash)\n([^`]+)\n```/s',
      //'/\[(INCL)/s*([^\]+)/',
      '#\[(INFO)\]#', '#\[(/INFO)\]#',
    );

    $ret = preg_replace_callback($patterns, $callback, $text);
    return $ret;
  }


}

  