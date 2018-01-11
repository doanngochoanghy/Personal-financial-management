  <?php $date=date_create($budget['time']); ?>
<script>
  document.getElementById("buttonBudget").setAttribute("class", "active");
</script>
<div class="">
  <div class="login-logo">
    <b>Edit Budget</b>
  </div>

  <!-- /.login-logo -->
  <div class="row">
    <div class="col-md-2"></div>
    <div class="view-item col-md-8">
      <div class="form-group pull-right">
        <form action="http://localhost/QLTCCN/Budget/Delete" method="post">
          <input type="hidden" name="user_id" value="<?php echo $budget['user_id']; ?>">
          <input type="hidden" name="budget_id" value="<?php echo $budget['budget_id']; ?>">
          <div class="col-xs-3">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa ngân sách này không?');"><span style="font-size: 20px;"><i class="fa fa-trash"></i></span></button>
          </div>
        </form>
      </div>
      <div class="col-md-2"></div>
      <div class="form-group">
        <form action="<?php echo base_url(); ?>Budget/Change" method="post">          
          <div class="form-group">
            
          <select name="category_id" class="form-control select2 selectpicker input-lg" tabindex="-98" style="width: 100%;" data-live-search="true" required="">
            <option value="" disabled selected hidden>Select a category</option>
            <optgroup label="Chi tiêu">
              <option value="6" <?php echo ($budget['category_id']=="6") ? "selected " : " " ; echo ($budget['category_id']<15) ? "" : "disabled" ; ?>>Hóa đơn</option>
              <option value="7"<?php echo ($budget['category_id']=="7") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Giáo dục</option>
              <option value="8"<?php echo ($budget['category_id']=="8") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Giải trí</option>
              <option value="9"<?php echo ($budget['category_id']=="9") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Gia đình</option>
              <option value="10"<?php echo ($budget['category_id']=="10") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Sức khỏe</option>
              <option value="11"<?php echo ($budget['category_id']=="11") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Ăn uống</option>
              <option value="12"<?php echo ($budget['category_id']=="12") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Di chuyển</option>
              <option value="13"<?php echo ($budget['category_id']=="13") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Hẹn hò</option>
              <option value="14"<?php echo ($budget['category_id']=="14") ? "selected" : "" ; echo ($budget['category_id']<15) ? "" : "disabled" ;?>>Mua sắm</option>
            </optgroup>
            <!-- <optgroup label="Thu nhập">
              <option value="15"<?php echo ($budget['category_id']=="15") ? "selected" : "" ; echo ($budget['category_id']>14) ? "" : "disabled" ;?>>Lương</option>
              <option value="16"<?php echo ($budget['category_id']=="16") ? "selected" : "" ; echo ($budget['category_id']>14) ? "" : "disabled" ;?>>Thưởng</option>
              <option value="17"<?php echo ($budget['category_id']=="17") ? "selected" : "" ; echo ($budget['category_id']>14) ? "" : "disabled" ;?>>Lãi suất</option>
              <option value="18"<?php echo ($budget['category_id']=="18") ? "selected" : "" ; echo ($budget['category_id']>14) ? "" : "disabled" ;?>>Quà tặng</option>
              <option value="19"<?php echo ($budget['category_id']=="19") ? "selected" : "" ; echo ($budget['category_id']>14) ? "" : "disabled" ;?>>Bán đồ</option>
            </optgroup> -->
          </select>
        
          </div>
          <div class="form-group has-feedback">
            <!-- <label for=""><h3>Budget:</h3></label> -->
            <input type="number" required="" name="budget_money" value="<?php echo $budget['budget_money']; ?>" class="form-control input-lg" placeholder="How much?">
            <span class="glyphicon glyphicon-usd form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="note" value="<?php echo $budget['note']; ?>" class="form-control input-lg" placeholder="Note ...">
            <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
          </div>
          <div class="form-group">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="time" required="" type="text" value="<?php echo date_format($date,"m-Y");  ?>" class="form-control pull-right input-lg" id="datepicker">
              <input type="hidden" name="user_id" value="<?php echo $budget['user_id']; ?>">
              <input type="hidden" name="budget_id" value="<?php echo $budget['budget_id']; ?>">
            </div>
            <!-- /.input group -->
          </div>
          <br>  
          <div class="row">
            <!-- /.col -->
            <div class="col-md-3 col-sm-4 col-xs-5">
              <button type="reset" class="btn btn-primary btn-block btn-flat">
                Reset
              </button>
            </div>
            <div class="col-md-6 col-sm-4 col-xs-2"></div>
            <div class="col-md-3 col-sm-4 col-xs-5">
              <button type="submit" class="btn btn-primary btn-block btn-flat" style="float: right;">Done</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>

    </div></div>
    <!-- /.login-box-body -->
  </div>
  <script>  
var mm = <?php echo date_format($date,"m"); ?>; //January is 0!

var yyyy = <?php echo date_format($date,"Y");?>;
if(mm<10){
  mm='0'+mm;
} 
var today = mm+'-'+yyyy;
document.getElementById("datepicker").value = today;
</script>