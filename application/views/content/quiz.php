<div class="puzzle-overlay"></div>
      <div class="container-puzzle">
        <div class="puzzle-title">Puzzle</div>
        <div class="puzzle-participant">Hi,<br><?php echo str_replace('@unilever.com','',$this->session->userdata('email'));?></div>
        <div class="container-pieces">
          <ul>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle1">1.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle2">2.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle3">3.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle4">4.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle5">5.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle6">6.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle7">7.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle8">8.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle9">9.</a></li>
            <li><a href="javascript:void(0);" class="puzzle-piece" id="puzzle10">10.</a></li>
          </ul>
        </div>
        <div class="puzzle-timer-container">
          <div class="puzzle-timer-caption">Time</div>
          <div class="puzzle-timer"><time>00:00</time></div>
        </div>
  
      </div>

      <div class="puzzle-popup" id="win-popup">
        <div class="puzzle-box">
          <div class="puzzle-box-content">
          <!-- <form method="post" action=""> -->
          <?php echo form_open() ?>
            <div class="win-message"><strong>Selamat,</strong> waktu anda <span class="puzzle-timer-win"><time>00:00</time></span>. Anda bisa mengurangi waktu anda dengan share permainan ini ke tiga orang teman kantormu. Masukkan tiga email temanmu:</div>
            <ul class="share-form">
              <li><input name="email1" type="text" placeholder="email"></li>
              <li><input name="email2" type="text" placeholder="email"></li>
              <li><input name="email3" type="text" placeholder="email"></li>
              <div class="msg-error">Email tidak valid! Masukkan alamat email dengan domain @unilever.com. </div>
              <div class="msg-success">Email valid.</div>
              <input type="hidden" id="waktu" name="time" value=""/>
              <input type="hidden" id="idnya" name="time" value="<?php echo $id; ?>"/>
              <!-- <a href="#" onclick="$(this).closest('form').submit();" class="puzzle-share">Share</a> -->
              <a href="#" onclick="submited();" class="puzzle-share">Share</a>
            </ul>
            <?php echo form_close() ?>
          </div>
        </div>
      </div>

      <div class="puzzle-popup" id="leaderboard-popup">
        <div class="puzzle-box">
          <div class="puzzle-box-content">
            <div class="leaderboard-caption">Leader Board</div>
            <ul id="popup">
            </ul>
          </div>
          <a href="javascript:void(0);" class="popup-close-leaderboard">X</a>
        </div>
        <div class="puzzle-box-player">
          <div class="puzzle-box-content">
            <ul id="player">
              
            </ul>
          </div>
        </div>
        <div class="puzzle-box-try" id="try-again">
          <div class="puzzle-box-content">
            <a href="<?php echo site_url('quiz');?>" class="puzzle-submit">Try Again</a>
          </div>
        </div>
      </div>
      <div class="puzzle-popup" id="puzzle-wrong">
        <div class="puzzle-box">
          <div class="puzzle-box-content">
            <div class="puzzle-wrong-caption">Jawaban Anda Salah</div>
          </div>
          <div class="popup-close-wrong">X</div>
          

        </div>
      </div>

      <?php $no=1; foreach ($questions as $list ) : ?>
      <div class="puzzle-popup" id="puzzle<?php echo $no; ?>">
        <div class="puzzle-box">
          <div class="puzzle-box-content">
            <div class="puzzle-question"><?php echo $list['question']?></div>
            <ol>
               <?php $id = $list['id'];
                  $items = baseQuestion($id); ?>
                <?php echo $items; ?>
            </ol>
          </div>
        </div>
      </div>
      <?php  $no++; endforeach ?>
</div>

<script type="text/javascript">
  function show_popup_updates(){
    $('#leaderboard-popup').fadeIn();
    return false;
  }

  function submited(){
    //validation
    var checkEmail = /(^\w+([\.-]*\w+)*@unilever.com$|^$)/;
    var checkEmailNotNull = /^\w+([\.-]*\w+)*@unilever.com$/

    var email1 = $('input[name=email1]').val();
    var email2 = $('input[name=email2]').val();
    var email3 = $('input[name=email3]').val();
    if (checkEmail.test(email1) === false) {
      //puzEmail1.remove();
      // puzEmail1 = "0";
      // puzEmailCheckValid = 0;
      return false;
    } else if (checkEmail.test(email2) === false) {
      //puzEmail2.remove();
      // puzEmail2 = "0";
      // puzEmailCheckValid = 0;
      return false;
    } else if (checkEmail.test(email3) === false) {
      //puzEmail3.remove();
      // puzEmail3 = "0";
      // puzEmailCheckValid = 0;
      return false;
    }

    var time = $('#waktu').val();
    var mail1 = email1.replace('@unilever.com','');
    var mail2 = email2.replace('@unilever.com','');
    var mail3 = email3.replace('@unilever.com','');
    var score = time.replace(':','');
    var id = $('#idnya').val();
    $.ajax({
        url:'<?php echo site_url("faq/save") ?>'+'/'+score+'/'+id+'/'+mail1+'/'+mail2+'/'+mail3,
        type:'POST',
        })
    setTimeout(function(){
     $.ajax({
        url:'<?php echo site_url("faq/showPopup") ?>',
        type:'POST',
        dataType:'json',
        data:{contents:'', lastcontent:''},
        success: function(data){
          if(data.lastcontent == ''){
            $('#popup').html(data.contents);
            $('.puzzle-box-player').remove();
          }
          $('#popup').html(data.contents);
          $('#player').html(data.lastcontent);
          $('.popup-close-leaderboard').click(function(){
            $('#leaderboard-popup').fadeOut();
            window.location = '<?php echo site_url('activities')?>';
          });
        },
        });}, 1000);
    
  }

</script>