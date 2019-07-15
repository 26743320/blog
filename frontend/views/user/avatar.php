<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\avatar\AvatarWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->registerCssFile("@web/css/jquery.Jcrop.css"); ?>
<?=$this->registerCssFile("@web/css/user.css"); ?>
<?=$this->registerCssFile("@web/css/font/font-awesome/css/font-awesome.min.css"); ?>
<style>
#submit_button{
    width:80px;
    height: 30px;
}
.container{
  padding: 0px;
  padding-left:5px;
}
</style>
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncm-default-form">
        <dl>
            <dt>头像预览</dt>
            <dd>
                <div class="user-avatar">
                    <span>
                        <?php if($model->head_pic != ""){?>
                        <img id="avatar" style="width:150px;height:150px;" src="<?php echo $model->head_pic.'?'.microtime(); ?>" alt="" nc_type="avatar" />
                    <?php }else{?>
                        <img id="avatar" style="width:150px;height:150px;" src="/uploads/avatar/default/default-1.png" alt="" nc_type="avatar" />
                    <?php }?>
                    </span>
                </div>
            </dd>
        </dl>
        <dl>
            <dt>更换头像</dt>
            <dd>
                <?= AvatarWidget::widget(['imageUrl'=>$model->head_pic])?>
              <!-- <div class="ncm-upload-btn">
                <a href="javascript:void(0);">
                    <span><input type="file" hidefocus="true" size="1" class="input-file" name="pic" id="pic" file_id="0" multiple="" maxlength="0"/></span>
                    <p><i class="icon-upload-alt"></i>图片上传</p>
                </a> 
                </div> -->
            </dd>
        </dl>
        <dl>
            <dt>推荐头像：</dt>
            <dd>
                <?php
                    for ($i=1; $i<=16;$i++) {
                        echo "<img class='touXiang' src='/uploads/avatar/default/default-{$i}.png' data-avatar='default-{$i}.png' style=' cursor: pointer;width: 50px; padding: 5px' onclick='changeAvatar(this)'>";
                    }
                ?>
            </dd>
        </dl>
    </div>
<script type="text/javascript">
    var changeAvatar = function (obj) {
        var avatar = $(obj).data("avatar");
        //var csrf = $("_csrf").val();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: 'POST',
            url: '/user/changeavatar',
            data: {_csrf_frontend:csrfToken,avatar:avatar},
            success: function(res){
                if(res.sucess == 'ok') {
                    console.log(res);
                    $('#avatar').attr('src', res.result+"?math="+(new Date()).valueOf());
                }
            },
            dataType: 'json'
        });
        //var csrfToken=$('input[name="_csrf-frontend"]').val();
        // $.post('/user/changeavatar',{avatar:avatar,_csrf:csrfToken},function(res){
        //     if(res.sucess == 'ok') {
        //         console.log(res);
        //         $('#avatar').attr('src', res.result+"?math="+(new Date()).valueOf());
        //     }
        // }, 'json');
    }
</script>
