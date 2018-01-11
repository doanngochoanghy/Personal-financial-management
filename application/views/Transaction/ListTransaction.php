<button class="btn btn-lg btn-info" data-toggle="modal" data-target="#addTransaction" style="border-radius: 50%;float: right;">
	<i class="fa fa-plus"></i>
</button>

<div class="modal fade login" id="addTransaction">
	<div class="modal-dialog login animated">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">Add Transaction</h2>
			</div>
			<div class="modal-body">
				<div class="box-body box-profile box" style="color: black;">
					<form action="<?php echo base_url(); ?>/Transaction/AddTransaction" method="post">          
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
								<optgroup label="Thu nhập">
									<option value="15">Lương</option>
									<option value="16">Thưởng</option>
									<option value="17">Lãi suất</option>
									<option value="18">Quà tặng</option>
									<option value="19">Bán đồ</option>
								</optgroup>
							</select>
						</div>
						<div class="form-group has-feedback loginBox">
							<input name="money"	type="number" class="form-control input-lg" placeholder="How much?" required="">
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
								<input name="time" type="text" class="form-control pull-right input-lg" id="timepicker" required="">
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
		<form action="<?php echo base_url();?>Transaction" method="post">
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
<?php if (count($dates)==0): ?>
	<div class="callout callout-warning">
		<h4><?php echo "Không có dữ liệu" ?></h4>
	</div>
<?php endif ?>
<?php foreach ($dates as $key => $date_value): ?>
	<div class="row date-view" id="content-transaction">
		<div class="col-md-2 col-sm-1"></div>
		<div class=" col-md-8 col-sm-10 col-xs-12">
		<div class="row">
			<div class="date"><b><?php $time = DateTime::createFromFormat('Y-m-d', $date_value['time']);
				echo $time->format('d-m-Y');
				$data_expense=$this->transaction_model->Get_all_expense($date_value['time']);
				$data_income=$this->transaction_model->Get_all_income($date_value['time']);
				?></b>
			</div>
			</div>
			<div class="item-transaction row">
				<?php foreach ($data_expense as $expense): ?>
					<a href="<?php echo base_url();?>Transaction/View/expense/<?php echo $expense['expense_id']; ?>">
						<div class="item item-expense row">
							<?php //var_dump($expense); ?>
							<div class="icon-item col-md-2 col-sm-2 col-xs-4">
								<i class="fa <?php echo ($expense['icon']);?>"></i>
							</div>
							<div class="cat-item col-md-6 col-sm-6 col-xs-8 row">
								<div class="cat col-md-6 col-sm-6 col-xs-8"><?php echo($expense['Category_Name']); ?></div>
								<div class="note col-md-6 col-sm-6 col-xs-4"><?php echo($expense['note']); ?></div>
							</div>
							<div class="money expense col-md-4 col-sm-4 col-xs-12" ><?php echo (number_format($expense['money'],0,",","."));?> đ</div>
						</div>
					</a>
				<?php endforeach ?>
				<?php foreach ($data_income as $income): ?>
					<a href="<?php echo base_url();?>Transaction/View/income/<?php echo $income['income_id']; ?>">
						<div class="item item-income row">
							<div class="icon-item col-md-2 col-sm-2 col-xs-4">
								<i class="fa <?php echo ($income['icon']);?>" ></i>
							</div>
							<div class="cat-item col-md-6 col-sm-6 col-xs-8 row" style="justify-content: center;">
								<div class="cat col-md-6 col-sm-6 col-xs-8"><?php echo($income['Category_Name']); ?></div>
								<div class="note col-md-6 col-sm-6 col-xs-4"><?php echo($income['note']); ?></div>
							</div>
							<div class="money income col-md-4 col-sm-4 col-xs-12"><?php echo (number_format($income['money'],0,",","."));?> đ</div>
						</div>
					</a>
				<?php endforeach ?>
			</div>
		</div>
		<div class="col-md-2 col-sm-1" ></div>
	</div>
<?php endforeach ?>
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
	var today =now.getFullYear()+ '-' + (now.getMonth() + 1) + '-'+ now.getDate();
	document.getElementById("timepicker").value = today;
</script>
