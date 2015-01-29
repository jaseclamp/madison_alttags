# madison_alttags
Update descriptions on all your files on one page. Great for better site alt tags. 

To access go into Addons > Modules > Madison Alttags

Example of using image description in template alt tag: 

For a normal image:
<img src="{feature_img}" width="280" height="160" alt="{feature_img}{description}{/feature_img}">

With CE Image: 
{exp:ce_img:single src="{feature_img}" width="280" height="160" crop="yes" attributes='alt="{feature_img}{desc}{/feature_img}"'}

With Assets: 
<img src="{feature_img}" width="280" height="160" alt="{feature_img}{desc}{/feature_img}">

For an image within a grid field:
<img src="{lv_home_slider:image}" alt="{lv_home_slider:image:desc}" width="960" height="351">