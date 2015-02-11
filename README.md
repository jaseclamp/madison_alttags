# madison_alttags
Update descriptions on all your files on one page. Great for better site alt tags. 

To access go into Addons > Modules > Madison Alttags

Example of using image description in template alt tag: 

For a normal image:
&lt;img src="{feature_img}" width="280" height="160" alt="{feature_img}{description}{/feature_img}">

With Assets: 
&lt;img src="{feature_img}" width="280" height="160" alt="{feature_img}{desc}{/feature_img}">

For an image within a grid field:
&lt;img src="{lv_home_slider:image}" alt="{lv_home_slider:image:desc}" width="960" height="351">

With CE Image on file field: 
{exp:ce_img:single src="{feature_img}" width="280" height="160" crop="yes" attributes='alt="{feature_img}{description}{/feature_img}"'}

With CE Image on assets field: 
{exp:ce_img:single src="{feature_img}" width="280" height="160" crop="yes" attributes='alt="{feature_img}{desc}{/feature_img}"'}

# install

Drag the folder into your third_party folder. 