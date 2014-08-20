<div class = "content">
<div class="order-con">
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">我出售的物品</div>

  <!-- Table -->
 <table class="table">
          <thead>
            <tr>
              <th class="col-md-1">#</th>
              <th class="col-md-5">标题</th>
              <th class="col-md-2">价格(元)</th>
              <th class="col-md-2">发布时间</th>
              <th class="col-md-2">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php $i =1;foreach ($order as $od):?>
            <tr>
              <td><?php echo $i;$i++;?></td>
              <td class = "tb-title"><a class = "link-tl" href=<?php echo 'index.php/home/detail/'.$od->id;?>><?=$od->title?></a></td>
              <td><?php echo $od->price;?></td>
              <td><?php echo $od->update_time;?></td>
              <td>
            <?php if($od->soldout):?>
              <button class="btn btn-warning btn-xs" data-toggle="modal" data-target=<?php echo '#conModal'.$i;?>>  确认成交</button>
			<?php else:?>
			  <button type="button" class="btn btn-default btn-xs" disabled="disabled">已经售出</button>
			<?php endif;?>
              </td>
            </tr>
            
            <div class="modal fade" id=<?php echo 'conModal'.$i;?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">确认交易</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-warning">
        <p><strong>注意：</strong>你必须在确认物品已经完全交易完成才能点击确认,<br>
        你确认交易完成后，出现一切损失与本站无关。<br>
        </p>
        </div>
        </p>是否确认交易？</p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <?php $good_id = $od->id;?>
        <a class="btn btn-warning" href=<?php echo 'index.php/home/complete/'.$good_id;?> role="button">确认成交</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            
            
            <?php endforeach;?>
          </tbody>
        </table>
</div>








</div>
</div>