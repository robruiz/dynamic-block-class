# Dynamic Gutenberg block class

A simple class for easily registering a dynamic block in Gutenberg

## Simple Example Use
### Step 1: Command Line
```
// In your /wp-content/plugins directory, you can
npx @wordpress/create-block my-block-name
cd my-block-name
npm start 
git clone https://github.com/robruiz/dynamic-block-class.git .

```

### Step 2: Edit my-block-name/my-block-name.php
```

include_once('class-DynamicBlock.php');

$my_block = new DynamicBlock('my-block-name','render_my_block');

function render_my_block(){
    $html = 'Hello World';
    return $html;
}
```
Some things to note here:
- Be sure your block name (first argument when using the DynamicBlock class) matches the block name you used when creating the block with npx
- You will need to [register the block properly](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/) in the index.js of the block (whether you are using block.json or not)

The DynamicBlock class makes some assumptions in regards to naming and file location, 
so be sure to check the code in the class if you have questions about those assumptions

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
