<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	    'id'=>'inviteUsersWindow',
	    // additional javascript options for the dialog plugin
	    'options'=>array(
	        'title'=>Yii::t('site', 'Send invitations to your friends'),
	        'autoOpen'=>false,
	        'modal'=>true, 
			'resizable'=>false,
			'width'=> '30%'      
	    ),
	));
?>
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'register-form',
		'enableClientValidation'=>true,
		'clientOptions'=> array(
							'validateOnSubmit'=> true,
							'validateOnChange'=>false,
						 ),
	
	)); ?>
	

		<div class="row">
			<?php echo $form->labelEx($model,'emails'); ?>
			<?php echo $form->textarea($model,'emails', array('rows'=>5, 'cols'=>36,'resizable'=>false)); ?>
			<?php $errorMessage = $form->error($model,'emails'); 
				  if (strip_tags($errorMessage) == '') { echo '<div class="errorMessage">&nbsp;</div>'; }
				  else { echo $errorMessage; }
			?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'invitationMessage'); ?>
			<?php echo $form->textArea($model,'invitationMessage', array('rows'=>5, 'cols'=>36,'resizable'=>false)); ?>
			<?php $errorMessage = $form->error($model,'invitationMessage');  
				  if (strip_tags($errorMessage) == '') { echo '<div class="errorMessage">&nbsp;</div>'; }
				  else { echo $errorMessage; }
			?>	  			
		</div>		
	
		<div class="row buttons">
			<?php 
// 			echo CHtml::ajaxSubmitButton('Invite', $this->createUrl('site/inviteUsers'), 
// 												array(
// 													'success'=> 'function(result){ 
// 																	try {
// 																		var obj = jQuery.parseJSON(result);
// 																		if (obj.result && obj.result == "1") 
// 																		{
// 																			$("#inviteUsersWindow").dialog("close");
// 																		}
// 																	}
// 																	catch (error){
// 																		$("#inviteUsersWindow").html(result);
// 																	}
// 																 }',
// 													 ),
// 												null); 
						
			$this->widget('zii.widgets.jui.CJuiButton', array(
					'name'=>'ajaxInviteUsers',
					'caption'=>Yii::t('site', 'Invite'),
					'id'=>'inviteUsersAjaxButton',
					'htmlOptions'=>array('type'=>'submit','ajax'=>array('type'=>'POST','url'=>array('site/inviteUsers'),
							'success'=> 'function(result){
															try 
															{
																var obj = jQuery.parseJSON(result);
							
																if (obj.result && obj.result == "1")
																{
																	$("#inviteUsersWindow").dialog("close");
																	TRACKER.showMessageDialog("'.Yii::t('site', 'Invitations sent successfully...').'");
																}
																else if(obj.result && obj.result == "Duplicate Entry")
																{
																	$("#inviteUsersWindow").html(result);
																	$("#inviteUsersWindow").dialog("close");

																	var msgString = "'.Yii::t('site', 'Since invitations already sent for the e-mails below, <br/> only the other invitations sent!').'<br/><br/>";
							
																	for (var i=0;i<obj.emails.length;i++)
																	{
																		msgString = msgString + obj.emails[i] + "<br/>";
																	}
							
																	TRACKER.showMessageDialog(msgString);
																}							
															}																
															catch (error)
															{
																$("#inviteUsersWindow").html(result);
															}
														}',
					))
			));			
			?>
												
			<?php 
// 			echo CHtml::htmlButton('Cancel',  
// 												array(
// 													'onclick'=> '$("#inviteUsersWindow").dialog("close"); return false;',
// 													 ),
// 												null); 
			?>
			
			<?php 
				$this->widget('zii.widgets.jui.CJuiButton', array(
						'name'=>'inviteUsersCancel',
						'caption'=>Yii::t('common', 'Cancel'),
						'id'=>'inviteUsersCancelButton',
						'onclick'=> 'js:function(){$("#inviteUsersWindow").dialog("close"); return false;}'
				));				
 			?>															
		</div>
	
	<?php $this->endWidget(); ?>
</div>
<?php 
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>