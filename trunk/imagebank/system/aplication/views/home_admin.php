<?php ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Home Admin</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


<style type='text/css'>
div#container
{
   width: 1024px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #3C3C3C;
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #C8D7EB;
   text-decoration: underline;
}
a:visited
{
   color: #C8D7EB;
}
a:active
{
   color: #C8D7EB;
}
a:hover
{
   color: #376BAD;
   text-decoration: underline;
}
</style>
<style type="text/css">
#Shape2
{
   border-width: 0;
   height: 547px;
   width: 204px;
}
#Shape1
{
   border-width: 0;
   height: 24px;
   width: 204px;
}
#Shape3
{
   border-width: 0;
   height: 24px;
   width: 204px;
}
#Image1
{
   border: 0px #000000 solid;
}
#Shape4
{
   border-width: 0;
   height: 425px;
   width: 796px;
}
#Shape5
{
   border-width: 0;
   height: 203px;
   width: 796px;
}
#Shape6
{
   border-width: 0;
   height: 157px;
   width: 775px;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text1 div
{
   text-align: center;
}
.logoutform_button
{
   background-color: #666666;
   border-color: #282828;
   border-width: 1px;
   border-style: solid;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
#wb_BulletedList1
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_BulletedList1 .bullet
{
   color :#000000;
   float: left;
   font-family: Arial;
   font-size: 13px;
   padding: 0px;
   text-align: left;
   vertical-align: top;
   width: 19px;
}
#wb_BulletedList1 .item
{
   float: left;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
   width: 182px;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text2 div
{
   text-align: center;
}
#wb_BulletedList2
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_BulletedList2 .bullet
{
   color :#000000;
   float: left;
   font-family: Arial;
   font-size: 13px;
   padding: 0px;
   text-align: left;
   vertical-align: top;
   width: 27px;
}
#wb_BulletedList2 .item
{
   float: left;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
   width: 130px;
}
#Shape7
{
   border-width: 0;
   height: 24px;
   width: 204px;
}
#LoginName2
{
   color: #000000;
   font-family: "Trebuchet MS";
   font-size: 13px;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text3 div
{
   text-align: center;
}
#CmsSearch1_keyword
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#CmsSearch1_label
{
   color: #C0C0C0;
   cursor: text;
   font-family: Arial;
   font-size: 13px;
}
.searchresults
{
   padding: 2px 2px 2px 2px;
   list-style-position: inside;
   font-family: Arial;
   font-size: 13px;
   color: #000000;
}
.searchresults a
{
   color: #0000FF;
}
.searchresults li
{
   padding: 0px 0px 2px 0px;
}
#Combobox1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
#Image2
{
   border: 0px #000000 solid;
}
#wb_BulletedList3
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_BulletedList3 .bullet
{
   color :#000000;
   float: left;
   font-family: Arial;
   font-size: 13px;
   padding: 0px;
   text-align: left;
   vertical-align: top;
   width: 25px;
}
#wb_BulletedList3 .item
{
   float: left;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
   width: 142px;
}
#Table1
{
   border: 2px #C0C0C0 solid;
   background-color: transparent;
   border-spacing: 1px;
}
#Table1 td
{
   padding: 0px 0px 0px 0px;
}
#Table1 td div
{
   white-space: nowrap;
}
#Table2
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
   border-spacing: 1px;
}
#Table2 td
{
   padding: 0px 0px 0px 0px;
}
#Table2 td div
{
   white-space: nowrap;
}
</style>
<script type="text/javascript" src=".../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   var $search = $('#CmsSearch1_form');
   var $searchInput = $search.find('input');
   var $searchLabel = $search.find('label');
   if ($searchInput.val())
   {
      $searchLabel.hide();
   }
   $searchInput.focus(function()
   {
      $searchLabel.hide();
   }).blur(function()
   {
      if (this.value == '')
      {
         $searchLabel.show();
      }
   });
   $searchLabel.click(function()
   {
      $searchInput.trigger('focus');
   });

});
</script>
</head>
<body>
<div id="container">
<div id="wb_Shape2" style="position:absolute;left:0px;top:102px;width:204px;height:547px;z-index:0;">
<img src="images/img0007.gif'" id="Shape2" alt=""></div>
<div id="wb_Shape1" style="position:absolute;left:1px;top:190px;width:204px;height:24px;z-index:1;">
<img src="images/img0008.png" id="Shape1" alt=""></div>
<div id="wb_Shape3" style="position:absolute;left:1px;top:299px;width:204px;height:24px;z-index:2;">
<img src="images/img0009.png" id="Shape3" alt=""></div>
<div id="wb_Image1" style="position:absolute;left:6px;top:4px;width:197px;height:68px;z-index:3;">
<img src="images/logoimagebank " id="Image1" alt="" border="0" style="width:197px;height:68px;"></div>
<div id="wb_Shape4" style="position:absolute;left:215px;top:227px;width:796px;height:425px;z-index:4;">
<img src="images/img0010.gif" id="Shape4" alt=""></div>
<div id="wb_Shape5" style="position:absolute;left:214px;top:17px;width:796px;height:203px;z-index:5;">
<img src="images/img0011.gif'" id="Shape5" alt=""></div>
<div id="wb_Shape6" style="position:absolute;left:227px;top:28px;width:775px;height:157px;z-index:6;">
<img src="images/img0015.gif" id="Shape6" alt=""></div>
<button id="AdvancedButton1" type="button" name="" value="" style="position:absolute;left:571px;top:190px;width:84px;height:24px;z-index:7;"><div style="text-align:center"><span style="color:#000000;font-family:Arial;font-size:13px">New Folder</span></div></button>
<button id="AdvancedButton2" type="button" name="" value="" style="position:absolute;left:658px;top:190px;width:84px;height:24px;z-index:8;"><div style="text-align:center"><span style="color:#000000;font-family:Arial;font-size:13px">Delete</span></div></button>
<div id="wb_Text1" style="position:absolute;left:29px;top:303px;width:142px;height:16px;text-align:center;z-index:9;">
<span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>Admin Menu</strong></span></div>
<div id="wb_Logout1" style="position:absolute;left:47px;top:384px;width:96px;height:25px;z-index:10;">
<form name="logoutform" method="post" action="<?php basename(__FILE__); ?>" id="logoutform">
<input type="hidden" name="form_name" value="logoutform">
<input class="logoutform_button" type="submit" name="logout"value="Logout" id="logout" style="width:96px;height:25px;" />
</form>
</div>
<div id="wb_BulletedList1" style="position:absolute;left:6px;top:142px;width:202px;height:60px;z-index:11;">
<div>
   <div class="bullet" style="height:22px;">&#9632;</div>
   <div class="item" style="height:22px;text-align:left;"><span style="color:#000000;font-family:'Trebuchet MS';font-size:13px;">Edit Profile<br></span></div>
</div>
<div style="clear:both">
   <div class="bullet" style="height:38px;">&#9632;</div>
   <div class="item" style="height:38px;text-align:left;"><span style="color:#000000;font-family:'Trebuchet MS';font-size:13px;">Change Your Password<br></span></div>
</div>
</div>
<div id="wb_Text2" style="position:absolute;left:14px;top:193px;width:168px;height:16px;text-align:center;z-index:12;">
<span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>Folder</strong></span></div>
<div id="wb_BulletedList2" style="position:absolute;left:5px;top:221px;width:158px;height:40px;z-index:13;">
<div>
   <div class="bullet" style="height:20px;"><img src="images/foldermini1.png" style="width:20px;height:20px;" alt=""></div>
   <div class="item" style="height:20px;text-align:left;"><span style="color:#000000;font-family:'Trebuchet MS';font-size:13px;">Browse</span></div>
</div>
<div style="clear:both">
   <div class="bullet" style="height:20px;"><img src="images/foldermini1.png" style="width:20px;height:20px;" alt=""></div>
   <div class="item" style="height:20px;text-align:left;"><span style="color:#000000;font-family:'Trebuchet MS';font-size:13px;">My Image</span></div>
</div>
</div>
<div id="wb_Shape7" style="position:absolute;left:0px;top:85px;width:204px;height:24px;z-index:14;">
<img src="images/img0016.png" id="Shape7" alt=""></div>
<div id="wb_LoginName2" style="position:absolute;left:4px;top:117px;width:166px;height:23px;z-index:15;">
<span id="LoginName2">Welcome <?php
if (isset($_SESSION['username']))
{
   $_SESSION['username'];
}
else
{
   'Not logged in';
}
?></span></div>
<div id="wb_Text3" style="position:absolute;left:12px;top:88px;width:168px;height:16px;text-align:center;z-index:16;">
<span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>Admin Profile</strong></span></div>
<div id="wb_CmsSearch1" style="position:absolute;left:749px;top:191px;width:225px;height:18px;z-index:17;">
<form method="get" name="CmsSearch1_form" id="CmsSearch1_form" action="<?php basename(__FILE__); ?>">
<input type="text" id="CmsSearch1_keyword" style="position:absolute;left:0px;top:0px;width:225px;height:18px;line-height:18px;;" name="query" value="">
<label id="CmsSearch1_label" style="position:absolute;left:1px;top:2px;" for="CmsSearch1_keyword">Search image</label>
</form>
</div>
<select name="Combobox1" size="1" id="Combobox1" style="position:absolute;left:227px;top:192px;width:96px;height:21px;z-index:18;">
<option selected>All</option>
<option>Sport</option>
<option>Culture</option>
<option>Social</option>
<option>Education</option>
</select>
<div id="wb_Image2" style="position:absolute;left:978px;top:190px;width:25px;height:25px;z-index:19;">
<img src="images/img0052.png" id="Image2" alt="" border="0" style="width:25px;height:25px;"></div>
<button id="AdvancedButton3" type="button" name="" value="" style="position:absolute;left:327px;top:190px;width:84px;height:24px;z-index:20;"><div style="text-align:center"><span style="color:#000000;font-family:Arial;font-size:13px">Upload</span></div></button>
<button id="AdvancedButton4" type="button" name="" value="" style="position:absolute;left:413px;top:190px;width:84px;height:24px;z-index:21;"><div style="text-align:center"><span style="color:#000000;font-family:Arial;font-size:13px">Download</span></div></button>
<div id="wb_BulletedList3" style="position:absolute;left:6px;top:329px;width:168px;height:40px;z-index:22;">
<div>
   <div class="bullet" style="height:20px;"><img src="images/user.png" style="width:16px;height:16px;" alt=""></div>
   <div class="item" style="height:20px;text-align:left;"><span style="color:#000000;font-family:'Trebuchet MS';font-size:13px;">Manage User</span></div>
</div>
<div style="clear:both">
   <div class="bullet" style="height:20px;"><img src="images/user.png" style="width:16px;height:16px;" alt=""></div>
   <div class="item" style="height:20px;text-align:left;"><span style="color:#000000;font-family:'Trebuchet MS';font-size:13px;">Manage Category</span></div>
</div>
</div>
<table style="position:absolute;left:231px;top:32px;width:768px;height:150px;z-index:23;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:142px;">&nbsp;
</td>
</tr>
</table>
<table style="position:absolute;left:219px;top:230px;width:788px;height:418px;z-index:24;" cellpadding="0" cellspacing="1" id="Table2">
<tr>

<td style="background-color:transparent;text-align:left;vertical-align:top;height:416px;">&nbsp;
</td>
</td>
</tr>
</table>
</div>
</body>
</html>