<?php
$userID = get_current_user_id();
$metaData = metadata_exists('user', $userID, 'fcredit_total');

if (!$metaData) {
  add_user_meta($userID, 'fcredit_total', 1000);
}
?>
<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
<script>
  $(document).ready(function () {
    $('#canvas').css({'width': '80%', 'position': 'relative'});
    screenfull.onchange(function () {
      if(screenfull.isFullscreen){
        $('#canvas').css({'width': '', 'position': ''});
      }else{
        $('#canvas').css({'width': '80%', 'position': 'relative'});
      }
    });
    var oMain = new CMain({
      audio_enable_on_startup: false, //ENABLE/DISABLE AUDIO WHEN GAME STARTS 
      fullscreen: true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
      check_orientation: true, //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
      combo_value: 50, //amount added to the score for each ball exploded in a combo
      extra_score: 100, //amount added to the score when level is completely cleared
    });


    $(oMain).on("start_session", function (evt) {
      if (getParamValue('ctl-arcade') === "true") {
        parent.__ctlArcadeStartSession();
      }
    });

    $(oMain).on("end_session", function (evt) {
      if (getParamValue('ctl-arcade') === "true") {
        parent.__ctlArcadeEndSession();
      }

    });

    $(oMain).on("save_score", function (evt, iScore) {
      if (getParamValue('ctl-arcade') === "true") {
        parent.__ctlArcadeSaveScore({score: iScore});
      }

      $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        cache: false,
        context: this,
        timeout: 7000,
        dataType: 'json',
        data: {
          score: iScore,
          status: 'sscore',
          action: 'adjust_credit'
        },
        beforeSend: function () {

        },
        success: function (response) {

        },
        error: function (xmlhttprequest, textstatus, message) {

        }
      });

    });

    $(oMain).on("start_level", function (evt, iLevel) {
      if (getParamValue('ctl-arcade') === "true") {
        parent.__ctlArcadeStartLevel({level: iLevel});
      }
      if (iLevel == 1) {
        $.ajax({
          url: '<?php echo admin_url('admin-ajax.php'); ?>',
          type: 'post',
          cache: false,
          context: this,
          timeout: 7000,
          dataType: 'json',
          data: {
            status: 'sstart',
            action: 'adjust_credit'
          },
          beforeSend: function () {

          },
          success: function (response) {

          },
          error: function (xmlhttprequest, textstatus, message) {

          }
        });
      }
    });

    $(oMain).on("end_level", function (evt, iLevel) {
      if (getParamValue('ctl-arcade') === "true") {
        parent.__ctlArcadeEndLevel({level: iLevel});
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("show_interlevel_ad", function (evt) {
      if (getParamValue('ctl-arcade') === "true") {
        parent.__ctlArcadeShowInterlevelAD();
      }
      //...ADD YOUR CODE HERE EVENTUALLY
    });

    $(oMain).on("share_event", function (evt, iScore) {

    });

    if (isIOS()) {
      setTimeout(function () {
        sizeHandler();
      }, 200);
    } else {
      sizeHandler();
    }
  });

</script>
<div class="check-fonts">
  <p class="check-font-1">test 1</p>
</div> 
<div class="canvas-container">
  <canvas id="canvas" class='ani_hack' width="960" height="540"> </canvas>
</div>

<div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
<div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
<style>
  .canvas-container {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  h1.main_title{
    display: none;
  }
</style>
