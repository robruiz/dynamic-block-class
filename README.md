# Dynamic Gutenberg block class

A simple class for easily registering a dynamic block in Gutenberg

## Simple Example Use
```
include_once('class-DynamicBlock.php');

$my_block = new DynamicBlock('my-block-name','render_my_block');

function render_my_block(){
    $html = 'Hello World';
    return $html;
}
```

### Add custom attributes to your block like this: 
```

$atts = array(
    'my_text_attribute' => array(
        'type'		=> 'string',
        'default'	=> ''
    ),
)
$my_block = new DynamicBlock('my-block-name','render_my_block', $atts);

```

### Override any number of block registration options using the optional $args parameter. This
```
add_action('wp_enqueue_scripts', function(){
    wp_register_style('block-styles', plugin_dir_url(__FILE__).'/styles/block-style.css');
    wp_register_script('block-scripts', plugin_dir_url(__FILE__).'/scripts/block-script.js');
});
$args = array(
    'style' => 'block-styles',
    'script' => 'block-scripts'
)
$my_block = new DynamicBlock('my-block-name','render_my_block', array(), $args);

```


### If using get_template_part() or anything along those lines, this pattern is recommended:
```
function render_my_block(){
    ob_start();
    get_template_part(plugin_dir_path(__FILE__).'/template-parts/template-part.php');
    return ob_get_clean();
}
```
For professional use, consider changing the $block_namespace string in the class

Please feel free to contribute improvements to this class via PR.

Thanks!
