<div class="row">
	<div class="col-md-4 col-sm-3 col-xs-2 "></div>
	<div class=" form-group col-md-4 col-sm-6 col-xs-8">
		<form action="<?php echo base_url();?>Report" method="post">
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
				<a href="http://localhost/QLTCCN/Transaction/View/expense/25">
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
<script>	
var mm = <?php echo $month_select; ?>; //January is 0!

var yyyy = <?php echo $year_select;?>;
if(mm<10){
	mm='0'+mm;
} 
var today = mm+'-'+yyyy;
document.getElementById("datepicker").value = today;
</script>