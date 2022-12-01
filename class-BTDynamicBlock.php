<?php

/**
 * Class for easily registering a dynamic Gutenberg block
 *
 */
class DynamicBlock
{
	public $block_handle, $render, $attributes, $args;
	public $block_namespace = 'dynamic-blocks';
	function __construct($block_handle, $render, $attributes = array(), $args = array()){
		$this->block_handle = $block_handle;
		$this->render = $render;
		$this->attributes = $attributes;
		$this->args = $args;
		$this->hooks();
	}

	function hooks(){
		add_action('init', array($this, 'register_dynamic_block'));
	}

	function register_dynamic_block() {
		$args = array(
			'api_version' 		=> 2,
			'editor_script' 	=> 'create-block/bt-blocks',
			'render_callback' 	=> $this->render,
			'attributes'		=> $this->attributes
		);

		if(!empty($this->args)){
			foreach($this->args as $arg_key => $arg_value) {
				$args[$arg_key] = $arg_value;
			}
		}


		register_block_type( $this->block_namespace.'/'.$this->block_handle, $args );
	}

}
