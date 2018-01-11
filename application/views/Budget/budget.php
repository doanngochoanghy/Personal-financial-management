<script>
	document.getElementById("buttonBudget").setAttribute("class", "active");
</script>
<button class="btn btn-lg btn-info" data-toggle="modal" data-target="#addBudget" style="border-radius: 50%;float: right;">
	<i class="fa fa-plus"></i>
</button>
<div class="modal fade login" id="addBudget">
	<div class="modal-dialog login animated">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">Add Budget</h2>
			</div>
			<div class="modal-body">
				<div class="box-body box-profile box" style="color: black;">
					<form action="<?php echo base_url(); ?>Budget/Add" method="post">          
						<div class="form-group" style="color: black;">
							<select name="category_id" class="form-control select2 selectpicker input-lg" tabindex="-98" style="width: 100%;" data-live-search="true" required="">
								<option value="" disabled selected hidden>Select a category</option>
								<optgroup label="Chi tiêu">
									<option value="6">Hóa đơn</option>
									<option value="7">Giáo dục</option>
									<option value="8">Giải trí</option>
									<option value="9">Gia đình</option>
									<option value="10">Sức khỏe</option>
									<option value="11">Ăn uống</option>
									<option value="12">Di chuyển</option>
									<option value="13">Hẹn hò</option>
									<option value="14">Mua sắm</option>
								</optgroup>
								<!-- <optgroup label="Thu nhập">
									<option value="15">Lương</option>
									<option value="16">Thưởng</option>
									<option value="17">Lãi suất</option>
									<option value="18">Quà tặng</option>
									<option value="19">Bán đồ</option>
								</optgroup> -->
							</select>
						</div>
						<div class="form-group has-feedback loginBox">
							<input name="budget_money"	type="number" class="form-control input-lg" placeholder="How much?" required="">
							<span class="glyphicon glyphicon-usd form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback loginBox ">
							<input name="note" type="text" class="form-control input-lg" placeholder="Note ...">
							<span class="glyphicon glyphicon-pencil form-control-feedback"></span>
						</div>
						<div class="form-group">
							<div class="input-group ">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input name="time" type="text" class="form-control pull-right input-lg" id="monthpicker" required="">
								<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id');?>">
							</div>
							<!-- /.input group -->
						</div>
						<br>  
						<div class="row">
							<!-- /.col -->
							<div class="col-xs-9"></div>
							<div class="col-xs-3">
								<button type="submit" class="btn btn-primary btn-block btn-flat" style="float: right;">Done</button>
							</div>
							<!-- /.col -->
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-sm-3 col-xs-2 "></div>
	<div class=" form-group col-md-4 col-sm-6 col-xs-8">
		<form action="<?php echo base_url();?>Budget" method="post">
			<div class="form-group">
				<div class="input-group input-lg  form-group">
					<div class="input-group-addon input-lg">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" class="form-control pull-right input-lg text-center" id="datepicker" name='month'>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-3">
					</div>
					<button type="submit" class="col-md-6 col-sm-6 col-xs-6 btn btn-warning text-center">View</button>
				</div>
			</div>
		</form>
		<div class="form-group">
		</div>
	</div>
</div>

<div class="row date-view" id="content-transaction">
	<div class="col-md-2 col-sm-1"></div>
	<div class=" col-md-8 col-sm-10 col-xs-12">
		<div class="item-transaction row">
			<?php foreach ($budget_list as $budget): ?>
				<?php 
					$category_id=$budget['category_id'];
					$user_id=$this->session->userdata('user_id');
					$sum_money=$this->budget_model->Get_Sum_Money_By_id($year_select,$month_select,$category_id);
					// var_dump($sum_money);
				 ?>
				<a href="http://localhost/QLTCCN/Budget/View/<?php echo $budget['budget_id']; ?>">
				<div class="item item-expense row">
					<div class="icon-item col-md-1 col-sm-2 col-xs-4">
						<i class="fa <?php echo($budget['icon']); ?>"></i>
					</div>
					<div class="cat-item col-md-3 col-sm-3 col-xs-4">
						<div class="cat"><?php echo($budget['category_name']); ?></div>
					</div>
					<div class="money col-md-8 col-sm-7 col-xs-12">
						<div class="col-md-6 budget">Ngân sách:</div>
						<div class="col-md-6"><?php echo number_format($budget['budget_money'],0,",","."); ?> đ</div>
						<div class="col-md-6 budget">Đã chi:</div>
						<div class="col-md-6"><?php echo(number_format($sum_money,0,",",".")); ?> đ</div>
						<div class="divider-summary col-md-12"></div>
						<div class="col-md-6 budget">Còn lại:</div>
						<div class="col-md-6" <?php if ($budget['budget_money']-$sum_money<0) {
							echo 'style="color:red; "';
						} ?>><?php echo(number_format($budget['budget_money']-$sum_money,0,",",".")); ?> đ</div>
					</div>
				</div>
			</a>
			<?php endforeach ?>
	</div>
	<div class="col-md-2 col-sm-1"></div>
</div>
<?php if (empty($budget_list)): ?>
	<div class="callout callout-warning">
		<h4><?php echo "Không có ngân sách nào trong tháng ".$month_select.'-'.$year_select; ?></h4>
	</div>
<?php endif ?>
<script>	
var mm = <?php echo $month_select; ?>; //January is 0!

var yyyy = <?php echo $year_select;?>;
if(mm<10){
	mm='0'+mm;
} 
var today = mm+'-'+yyyy;
document.getElementById("datepicker").value = today;
</script>
<script>
	var now = new Date();
	var today =now.getFullYear()+ '-' + (now.getMonth() + 1);
	document.getElementById("monthpicker").value = today;
</script>