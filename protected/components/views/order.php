
				<?php if ($data):?>
					<?php $isajax= $this->param['type']=='ajax';?>
					<?php foreach ($data as $item):?>
						<?php 
						$isStep1 = $item->step>TableOrder::STATUS_STEP1_UNCOMPLETED;
						$isStep2 = $item->step>TableOrder::STATUS_STEP2_COMPLETED;
						$isStep3 = $item->step>TableOrder::STATUS_STEP3_AGREED;
						$isStep4 = $item->step>TableOrder::STATUS_STEP4_PAY;
						?>
						<?php 
							if (!$isajax):
						?>
						<div id="user_order_<?php echo $item->order_id;?>" class="ordertext" status="<?php echo $item->step;?>">
						<?php endif;?>
						
		                <table class="orderstatus status<?php echo $item->step;?>" >
		                	<tr>
		                    	<td width="8%" class="step1"><div></div></td>
		                        <td width="22%" class="step2"><div><br/>Online Form Status: <br/>
		                        		<?php if ($isStep1):?>
		                        			completed
		                        		<?php else:?>
		                        			<button onclick="showWindow('complete','<?php echo url('user/profile');?>');">completeInfo</button> 
		                        		<?php endif;?>
		                        	</div>
		                        </td>
		                        <td width="22%" class="step3"><div><br/>Media Plan Status: <br/>
		                        	<?php if ($isStep1):?>
			                        	<?php if (!$isStep2):?>
			                        
			                        	<?php if ($item->planurl):?>
			                        		<?php if ($item->isplandownload):?>
			                        			<button id="user_order_wait_<?php echo $item->order_id;?>" onclick="ajaxget('<?php echo url('user/order',array('agree'=>1,'id'=>$item->order_id));?>','user_order_<?php echo $item->order_id;?>',this)">agreed</button>	<br/>
			                        		<?php endif;?>
			                        		<a href="<?php echo url('user/download',array('oid'=>$item->order_id));?>" target="_blank" style="color:#FFF;" onclick="setTimeout(funtion(){location.reload();})">download here</a>
			                        		<?php else:?>
			                        		<span title="Your proposal is on the way">Please wait </span>
			                        	<?php endif;?>
			                        	<?php else :?>
			                        	agreed
			                        	<?php endif;?>
		                        	<?php else:?>
		                        	<br/>not agreed
		                        	<?php endif;?>
		                        
		                        
		                        </div></td>
		                        <td width="22%" class="step4"><div><br/>Payment Status:<br/>
		                        	<?php if (!$isStep3 && $isStep2):?>
		                        			<button onclick="gopay('<?php echo $item->order_id;?>','<?php echo $item->gid;?>','<?php echo $item->uid;?>');">pay here</button>
		                        	<?php elseif($isStep3):?>
		                        	completed
		                        	<?php else :?>
		                        	Not completed
		                        	<?php endif;?>
		                        </div></td>
		                        <td width="22%" class="step5"><div><br>Campaign Status:<br/>
		                        	<?php if ($isStep4):?>
		                        		launched
		                        	<?php else:?>
		                        		Haven’t launched
		                        	<?php endif;?>
		                        
		                        
		                        </div></td>
		                    </tr>
		                </table>
		                <?php if (!$isajax):?>
						</div>
						<?php endif;?>
                	<?php endforeach;?>
                	<?php if (!$isajax):?>
		                <script>
							function gopay(orderid,gid,uid)
							{
								location = "<?php echo url('user/PayConfirm');?>?oid="+orderid+"&gid="+gid+"&uid="+uid;
							}
							jQuery("div.ordertext").click(function(){
								jQuery(this).addClass("on").siblings().removeClass("on");
								jQuery("#step").get(0).className="status"+this.getAttribute("status");
							});  
							jQuery("div.ordertext:first").trigger('click');            
		                </script>
					<?php endif;?>
                <?php else:?>
                
             
                <?php endif;?>