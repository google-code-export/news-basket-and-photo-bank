<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 
<div id="main-content">
   <div class='title'>Daftar User</div>
 
   <?php echo anchor('home/insert_user','+ Tambah User Baru');?>
   <table class='data' width='100%'>
      <tr>
         <th width='30%' align='left'>Nama</th>
         <th width='20%' align='left'>Username</th>
         <th width='24%' align='left'>Level</th>
         <th width='20%' align='center'>Aksi</th>
      </tr>
   <?php
   foreach($all_user->result() as $row)
   {
      ?>
      <tr>
         <td><?php echo $row->user_nama;?></td>
         <td><?php echo $row->user_username;?></td>
         <td><?php echo $row->level_nama;?></td>
         <td align='center'>
            <?php
            echo anchor('home/edit_user/'.$row->user_id,'Edit');
            echo ' - ';
            echo anchor('home/delete_user/'.$row->user_id,'Hapus');
            ?>
         </td>
      </tr>
      <?php
   }
   ?>