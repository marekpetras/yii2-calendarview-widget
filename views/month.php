<table class="month <?=$monthRendered?>">
<thead>
    <th colspan="8">
        <div class="btn-group btn-group-justified">
                <a href="" class="navigate btn btn-primary" data-show="<?=$monthRendered-1?>" data-hide="<?=$monthRendered?>">&#8678; Previous</a>
                <a href="" class="navigate btn btn-primary disabled hidden-xs hidden-sm"><?=$title?></a>
                <a href="" class="navigate btn btn-primary disabled hidden-md hidden-lg"><?=$title?></a>
                <a href="" class="navigate btn btn-primary" data-show="<?=$monthRendered+1?>" data-hide="<?=$monthRendered?>">Next &#8680;</a>
        </div>
    </th>
</thead>
<thead>
<th class="hidden-xs hidden-sm">Week</th>
<th class="hidden-xs hidden-sm">Monday</th>
<th class="hidden-xs hidden-sm">Tuesday</th>
<th class="hidden-xs hidden-sm">Wednesday</th>
<th class="hidden-xs hidden-sm">Thursday</th>
<th class="hidden-xs hidden-sm">Friday</th>
<th class="hidden-xs hidden-sm">Saturday</th>
<th class="hidden-xs hidden-sm">Sunday</th>
<th class="hidden-md hidden-lg">W</th>
<th class="hidden-md hidden-lg">M</th>
<th class="hidden-md hidden-lg">T</th>
<th class="hidden-md hidden-lg">W</th>
<th class="hidden-md hidden-lg">T</th>
<th class="hidden-md hidden-lg">F</th>
<th class="hidden-md hidden-lg">S</th>
<th class="hidden-md hidden-lg">S</th>
</thead>

<?=$content?>

</table>