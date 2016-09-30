<tr id="manager_left_bar">
	
	<td style="float:left; height:100%;">数据库驱动器</td>
	
	<td id="paging" style="float:right; height:100%;">
		<button class="paging_btn" value="<?php echo $pg-1; ?>">front</button>
		<?php echo "$pg/$all_pg"; ?>
		<button class="paging_btn" value="<?php echo $pg+1; ?>">next</button>
	</td>
	
</tr>


<tr class="manager_obj">
		
		<th class="obj_field_i">
			ID
		</th>
		
		<th class="obj_field_n">
			姓 名
		</th>
		
		<th class="obj_field_e">
			email
		</th>
		
		<th class="obj_field_m">
			管理员
		</th>
		
</tr>


<?php foreach($user_obj as $once) { ?>
	
	<tr class="manager_obj">
		
		<td class="obj_field_i">
			<?php echo $once['id']; ?>
		</td>
		
		<td class="obj_field_n">
			<?php echo mb_substr($once['name'], 0, 10); ?>
		</td>
		
		<td class="obj_field_e">
<?php echo mb_substr($once['email'], 0, 20); ?>
		</td>
		
		<td class="obj_field_m">
			
			<?php if($once['manager'] == 1) { ?>
				<font color="green">
					y
				</font>
			<?php } else { ?>
				<font color="red">
					x
				</font>
			<?php } ?>
			
		</td>
		
		<td class="obj_func">
			<button class="obj_btn_info" value="<?php echo $once['id']; ?>">info</button>
			<button class="obj_btn_cg" value="<?php echo $once['id']; ?>">change</button>
			<button class="obj_btn_del" value="<?php echo $once['id']; ?>">delete</button>
		</td>
		
	</tr>
	
<?php } ?>


<script src="/js/manager/ctrl.js"></script>
