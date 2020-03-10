<div class="todolist">
	<h1>Tasks</h1>
	<form action="add" method="post">
		<input type="text" class="form-group form-control" placeholder="Write a description of a task" name="description" required>
		<button class="btn btn-outline-primary" type="submit">Add Task</button>
		<hr>
	</form>
	<form action="" method="post">
		<label for="sortby">Sort by</label>
		<select name="sortby">
			<option value="email">Email</option>
			<option value="status">Status</option>
			<option value="login">Login</option>
		</select>
		<label for="type">Asc</label>
		<input name="type" type="radio" value="asc">
		<label for="type">Desc</label>
		<input name="type" type="radio" value="desc">
		<button type="submit">Sort</button>
		<hr>
	</form>	
	<ul id="sortable" class="list-unstyled">
		<?php foreach ($tasks as $val): ?>					 
			<li class="ui-state-default">
				<div class="checkbox">
					<?php if ($val['task_if_changed'] == 1):?>
						<span class="badge badge-info">Modifyed by admin</span>
					<?php endif; ?>
					<!-- Check if task checked by Admin -->
					<?php if ($val['task_if_done'] == 0):?>
						<span class="badge badge-secondary">Not checked</span><br>
						<?php else: ?>
							<span class="badge badge-success">Checked</span><br>
						<?php endif; ?>

						<!-- How admin sees the page -->
						<?php if (isset($_SESSION['account']['id'])):?>
							<?php if ($_SESSION['account']['status'] =='admin'):?>
								<span class="username"><?php echo $val["login"];?></span></span><br>
								<span class="email"></span><?php echo $val["email"];?><br>
								<form action="change" method="post">
									<label for="task_id">ID:</label>
									<input type="text" name="task_id" value="<?php echo $val['task_id'] ?>" style="width: 30px" readonly><br>
									<textarea class="form-control" rows="3" name = "changed"><?php echo $val['task_descr'] ?></textarea><br>
									<input type="checkbox" name="checked">
									<label for="checked">Mark as checked</label><br>
									<button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Save</button>
								</form>
								<?php else: ?> 
								<span class="username"><?php echo $val["login"];?></span></span><br>
								<span class="email"></span><?php echo $val["email"];?><br>
								<span class="taskDescr"><?php echo $val['task_descr']; ?></span>
						<?php endif ?>
							<!-- How user sees the page -->
						<?php else: ?> 
								<span class="username"><?php echo $val["login"];?></span></span><br>
								<span class="email"></span><?php echo $val["email"];?><br>
								<span class="taskDescr"><?php echo $val['task_descr']; ?></span>
						<?php endif; ?>			
						</div>
					</li>
					<p></p>
					<hr>
				<?php endforeach;  ?>
				<?php echo $pagination; ?>
			</ul>
		</div>
