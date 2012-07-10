< h1 > < ?php echo $title;? > < /h1 >
< p > < ?php echo anchor("admin/categories/create", "Create new category");? > < /p >
<?php
if ($this->session-> flashdata('message')){
echo "<div class='message' >" .$this-> session-> flashdata('message')."< /div >" ;
}
if (count($categories)){
echo "<table border='1' cellspacing='0' cellpadding='3' width='400' > \n";
echo " <tr valign=’top’> \n";
echo "<th>ID</th>\n<th>Name</th><th>Actions</th>\n";
echo "<td align='center'>". $list['status']."</td>\n";
echo "<td align = 'center'>";
echo anchor('admin/categores/edit/'.$list['id'].'edit');
echo anchor('admin/categores/delete/'.$list['id'].'delete');
echo "</td>\n";
echo "</tr>\n";
echo "</table>";

}

?>
