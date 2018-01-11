<div class="">
  <div class="login-logo">
    <b>Edit transaction</b>
  </div>

  <!-- /.login-logo -->
  <div class="row">
    <div class="col-md-2"></div>
    <div class="view-item col-md-8">
      <div class="form-group pull-right">
        <form action="<?php echo base_url();?>Transaction/Delete" method="post">
          <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id');?>">
          <input type="hidden" name="category_id" value="<?php echo $data_transaction['category_id'];?>">
          <input type="hidden" name="transaction_id" value="<?php echo ($data_transaction['category_id']<15) ? $data_transaction['expense_id'] : $data_transaction['income_id'];?>">
          <input type="hidden" name="money" value="<?php echo $data_transaction['money'];?>">
          <div class="col-xs-3">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa giao dịch này không?');"><span style= "font-size: 20px;" ><i class="fa fa-trash"></i></span></button>
          </div>
        </form>
      </div>
      <div class="form-group"><form action="<?php echo base_url(); ?>/Transaction/UpdateTransaction" method="post">          
        <div class="form-group">
          <select name="category_id" class="form-control select2 selectpicker input-lg" tabindex="-98" style="width: 100%;" data-live-search="true" required="">
            <option value="" disabled selected hidden>Select a category</option>
            <optgroup label="Chi tiêu">
              <option value="6" <?php echo ($data_transaction['category_id']=="6") ? "selected " : " " ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ; ?>>Hóa đơn</option>
              <option value="7"<?php echo ($data_transaction['category_id']=="7") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Giáo dục</option>
              <option value="8"<?php echo ($data_transaction['category_id']=="8") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Giải trí</option>
              <option value="9"<?php echo ($data_transaction['category_id']=="9") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Gia đình</option>
              <option value="10"<?php echo ($data_transaction['category_id']=="10") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Sức khỏe</option>
              <option value="11"<?php echo ($data_transaction['category_id']=="11") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Ăn uống</option>
              <option value="12"<?php echo ($data_transaction['category_id']=="12") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Di chuyển</option>
              <option value="13"<?php echo ($data_transaction['category_id']=="13") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Hẹn hò</option>
              <option value="14"<?php echo ($data_transaction['category_id']=="14") ? "selected" : "" ; echo ($data_transaction['category_id']<15) ? "" : "disabled" ;?>>Mua sắm</option>
            </optgroup>
            <optgroup label="Thu nhập">
              <option value="15"<?php echo ($data_transaction['category_id']=="15") ? "selected" : "" ; echo ($data_transaction['category_id']>14) ? "" : "disabled" ;?>>Lương</option>
              <option value="16"<?php echo ($data_transaction['category_id']=="16") ? "selected" : "" ; echo ($data_transaction['category_id']>14) ? "" : "disabled" ;?>>Thưởng</option>
              <option value="17"<?php echo ($data_transaction['category_id']=="17") ? "selected" : "" ; echo ($data_transaction['category_id']>14) ? "" : "disabled" ;?>>Lãi suất</option>
              <option value="18"<?php echo ($data_transaction['category_id']=="18") ? "selected" : "" ; echo ($data_transaction['category_id']>14) ? "" : "disabled" ;?>>Quà tặng</option>
              <option value="19"<?php echo ($data_transaction['category_id']=="19") ? "selected" : "" ; echo ($data_transaction['category_id']>14) ? "" : "disabled" ;?>>Bán đồ</option>
            </optgroup>
          </select>
        </div>
        <div class="form-group has-feedback">
          <input type="number" required="" name="money" value="<?php echo($data_transaction['money']); ?>" class="form-control input-lg" placeholder="How much?" >
          <span class="glyphicon glyphicon-usd form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" name="note" value="<?php echo ($data_transaction['note']); ?>" class="form-control input-lg" placeholder="Note ...">
          <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
        </div>
        <div class="form-group">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input name="time" required="" type="text" value="<?php echo ($data_transaction['time']); ?>"class="form-control pull-right input-lg" id="timepicker" required="">
            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id');?>">
            <input type="hidden" name="transaction_id" value="<?php echo ($data_transaction['category_id']<15) ? $data_transaction['expense_id'] : $data_transaction['income_id'];?>">
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
