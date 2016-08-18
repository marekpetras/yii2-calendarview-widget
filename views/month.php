<table class="month <?=$monthRendered?>">
<thead>
    <th colspan="8">
        <div class="btn-group btn-group-justified">
                <a href="" class="navigate btn btn-primary" data-show="<?=$monthRendered-1?>" data-hide="<?=$monthRendered?>">&#8678; <?=Yii::t('calendar','Previous')?></a>
                <a href="" class="navigate btn btn-primary disabled hidden-xs hidden-sm"><?=$title?></a>
                <a href="" class="navigate btn btn-primary disabled hidden-md hidden-lg"><?=$title?></a>
                <a href="" class="navigate btn btn-primary" data-show="<?=$monthRendered+1?>" data-hide="<?=$monthRendered?>"><?=Yii::t('calendar','Next')?> &#8680;</a>
        </div>
    </th>
</thead>
<thead>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Week')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Monday')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Tuesday')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Wednesday')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Thursday')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Friday')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Saturday')?></th>
<th class="hidden-xs hidden-sm"><?=Yii::t('calendar','Sunday')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','W')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','Mo')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','Tu')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','We')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','Th')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','Fr')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','Sa')?></th>
<th class="hidden-md hidden-lg"><?=Yii::t('calendar','Su')?></th>
</thead>

<?=$content?>

</table>