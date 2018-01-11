<script>
	document.getElementById("buttonReport").setAttribute("class", "active");
</script>
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
<?php if ($data_expense==NULL&&$data_income==NULL): ?>
	<div class="callout callout-warning">
		<h4><?php echo "Không có dữ liệu giao dịch trong tháng ".$month_select.'-'.$year_select; ?></h4>
	</div>
<?php endif ?>
<div class="row two-chart-box">
	<div class="col-md-6 income-chart-box">	
		<h3 class="box-title">Income</h3>
		<div id="income-donut-chart" style="height: 300px;"></div>
		<!-- <?php var_dump($data_income); ?> -->
		<div class="item-transaction row">

			<?php $total=0; ?>
			<?php foreach ($data_income as $income): ?>
				<?php $total+=(int)$income['money']; ?>
				<div class="item item-income row">
					<div class="icon-item col-md-2 col-sm-2 col-xs-4">
						<i class="fa <?php echo $income['icon']; ?>"></i>
					</div>
					<div class="cat-item col-md-5 col-sm-5 col-xs-8 row">
						<div class="cat"><?php echo($income['category_name']); ?></div>
						<!-- <div class="note col-md-6 col-sm-6 col-xs-4"><?php echo($expense['note']); ?></div> -->
					</div>
					<div class="money income col-md-5 col-sm-5 col-xs-12" ><?php echo (number_format($income['money'],0,",","."));?> đ</div>
				</div>
			<?php endforeach ?>

			<div class="divider-summary"></div>
			<div class="item item-expense row">
				<div class="icon-item col-md-2 col-sm-2 col-xs-4">
					<!-- <i class="fa fa-cutlery"></i> -->
				</div>
				<div class="cat-item col-md-5 col-sm-5 col-xs-8 row">
					<div class="cat">Tổng cộng</div>
					<!-- <div class="note col-md-6 col-sm-6 col-xs-4"><?php echo($expense['note']); ?></div> -->
				</div>
				<div class="money income col-md-5 col-sm-5 col-xs-12" ><?php echo (number_format($total,0,",","."));?> đ</div>
			</div>
			<!-- </a> -->
		</div>
	</div>
	<div class="col-md-6 expense-chart-box">
		<h3 class="box-title">Expense</h3>	
		<div id="expense-donut-chart" style="height: 300px;"></div>
		<div class="item-transaction row">
			<?php $total=0; ?>
			<?php foreach ($data_expense as $expense): ?>
				<?php $total+=(int)$expense['money']; ?>
				<div class="item item-expense row">
					<div class="icon-item col-md-2 col-sm-2 col-xs-4">
						<i class="fa <?php echo $expense['icon']; ?>"></i>
					</div>
					<div class="cat-item col-md-4 col-sm-4 col-xs-8 row">
						<div class="cat"><?php echo($expense['category_name']); ?></div>
						<!-- <div class="note col-md-6 col-sm-6 col-xs-4"><?php echo($expense['note']); ?></div> -->
					</div>
					<div class="money expense col-md-6 col-sm-6 col-xs-12" ><?php echo (number_format($expense['money'],0,",","."));?> đ</div>
				</div>
			<?php endforeach ?>

			<div class="divider-summary"></div>
			<div class="item item-expense row">
				<div class="icon-item col-md-2 col-sm-2 col-xs-4">
					<!-- <i class="fa fa-cutlery"></i> -->
				</div>
				<div class="cat-item col-md-4 col-sm-4 col-xs-8 row">
					<div class="cat">Tổng cộng</div>
					<!-- <div class="note col-md-6 col-sm-6 col-xs-4"><?php echo($expense['note']); ?></div> -->
				</div>
				<div class="money expense col-md-6 col-sm-6 col-xs-12" ><?php echo (number_format($total,0,",","."));?> đ</div>
			</div>
			<!-- </a> -->
		</div>
	</div>
</div>

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
<script src="<?php echo base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url()?>bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url()?>bower_components/Flot/jquery.flot.pie.js"></script>
<script>
	
	$(function () {
    /*
     * DONUT CHART
     * -----------
     */

     var expenseData=<?php 
     $donut_expense_data=array();
     if ($data_expense!=NULL) {
     	foreach ($data_expense as $expense) {
     		$donut_expense_data[]=array("label"=>$expense['category_name'],"data"=>$expense['money'],"legendText");
     	}}
     	echo json_encode($donut_expense_data);
     	?>

     	var incomeData=<?php 
     	$donut_income_data=array();
     	if ($data_income!=NULL) {
     		foreach ($data_income as $income) {
     			$donut_income_data[]=array("label"=>$income['category_name'],"data"=>$income['money']);
     		}
     	}
     	echo json_encode($donut_income_data);
     	?>
     // <?php 
     // 	foreach ($data_expense as $expense) {
     // 		$donut_expense_data[]=array("label"=>$expense['category_name'],"data"=$expense['money']);
     // 	}
     // 	echo json_encode($donut_expense_data);
     //  ?>
     

     $.plot('#expense-donut-chart', expenseData, {
     	series: {
     		pie: {
     			show       : true,
     			radius     : 1,
     			innerRadius: 0.4,
     			label      : {
     				show     : true,
     				radius   : 5/7,
     				formatter: labelFormatter,
     				threshold: 0.1
     			}

     		}
     	},
     	legend: {
     		labelBoxBorderColor: "none",
     		verticalAlign: "center", 
			horizontalAlign: "right",
     	}
     })
     $.plot('#income-donut-chart', incomeData, {
     	series: {
     		pie: {
     			show       : true,
     			radius     : 1,
     			innerRadius: 0.4,
     			label      : {
     				show     : true,
     				radius   : 5/7,
     				formatter: labelFormatter,
     				threshold: 0.1
     			}

     		}
     	},
     	legend: {
     		labelBoxBorderColor: "none",
     		verticalAlign: "center", 
			horizontalAlign: "right",

     	}
     })
    /*
     * END DONUT CHART
     */

 })

  /*
   * Custom Label formatter
   * ----------------------
   */
   function labelFormatter(label, series) {
   	return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
   	+ label
   	+ '<br>'
   	+ Math.round(series.percent) + '%</div>'
   }
</script>