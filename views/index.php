<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->EE =& get_instance();
?>

<?php foreach ($cp_messages as $cp_message_type => $cp_message) : ?>
	<p class="notice <?=$cp_message_type?>"><?=$cp_message?></p>
<?php endforeach; ?>

<style>
#alttag_container { width:300px;height:100px;background-size:cover;background-position:center;background-repeat:no-repeat; position:relative; }
#alttag_img { position:absolute; left: 9999px; z-index:999; }
#alttag_container:hover {background-image:none !important;}
#alttag_container:hover #alttag_img { left:0px; }
</style>
<script>
$(document).ready(function(){
  
  $("#alttagsform").submit(function(e){
    e.preventDefault();
  });
  
  $("#alttagsform input[type=text]").focus( function() { 
	$(this).css('color','green');
  });
  
  $("#alttagsform input[type=text]").blur( function() {
	$.post( $("#alttagsform").attr('action') , { id: $(this).attr('id'), value:$(this).val(), image:$(this).attr('image') } , function(data) { $('input[id='+data+']').css('color','black'); } );
  });
  
});
</script>

<p>This page lets you bulk edit descriptions for images and the desc field in assets. These can in turn be used in templates as alt tags (for example alt="{news_img}{description}{/news_img}"). When you click into a field it will turn green. When you click out or tab to the next field the text will turn back to black indicating it has been saved. <br>If you want to edit a description on a specific image, use Content > Files > File Manager to find the file and then click the pencil to edit.  </p>
<?php	
	echo form_open($action_url , array('id'=>'alttagsform') );

	$cp_table_template['table_open'] = '<table class="mainTable addDetour" border="0" cellspacing="0" cellpadding="0">';
	$this->table->set_template($cp_table_template);
	$this->table->set_heading(
		array(
			'data' => 'Image',
			'style' => 'width:25%;'
		),
		array(
			'data' => 'Alt text',
			'style' => 'width:75%;'
		)
	);
	
	
	foreach($images as $image)
	{
		$this->table->add_row(
			'<div id="alttag_container" style="background-image:url('.$image['src'].');"><img id="alttag_img" src="'.$image['src'].'"></div>',
			form_input(
				array(
					'name' => $image['id'],
					'id' => $image['id'], 
					'value' => $image['alt'],
					'image' => $image['name']
				)
			)
		);
	
	}
	
	echo $this->table->generate();	
	$this->table->clear();	

	//echo form_submit(array('name' => 'submit', 'value' => $this->EE->lang->line('btn_save_alttags'), 'class' => 'submit'));

	echo form_close();

	
?>