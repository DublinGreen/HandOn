<div role="tabpanel" style="background-color: #fff;" class="tab-pane active" id="track">
   <ul style="padding: 0;margin: 0;">
    <div class="col-md-4">
      <li>
        <a href="#">Talent Gems</a>
        <span><?php if(!empty($totalGems['totalGems'])){ echo $totalGems['totalGems']; } else{ echo 0 ;} ?> </span>
      </li>
      <li>
        <a href="#">New Talents</a>
        <span><?php if(!empty($cureentMonthTalents)){ echo $cureentMonthTalents; } else{ echo 0 ;} ?>  </span>
      </li>

    </div>
    <div class="col-md-4">
      <li>
        <a href="#">Gem Reward</a>
        <span>NA </span>
      </li>
      <li>
        <a href="#">Active Talents</a>
        <span><?php if(!empty($activeTalents)){ echo $activeTalents; } else{ echo 0 ;} ?>  </span>
      </li>

    </div>

    <div class="col-md-4">
      <li>
        <a href="#">Live Duration</a>
        <span><?php if(!empty($liveDuration['spendTime'])){ echo $liveDuration['spendTime']; } else{ echo 0 ; } ?>   </span>
      </li>
      <li>
        <a href="#">Total Talents</a>
        <span>
          <?php if(!empty($totalTalents)){ echo $totalTalents; } else{ echo 0 ;} ?>
        </span>
      </li>
    </div>


  </ul>
</div>
