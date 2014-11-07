var theme = "";
var resp;
function GetDuration() {
    var duration;
    if (window.ytplayer) {
        duration = window.ytplayer.getDuration(); 
    }
    return duration;
}
function shuffle(o){
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};
function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '600',
          width: '800',
          videoId: 'Dkfi60-7CRI',
          playerVars: {controls: 0, disablekb: 1, iv_load_policy: 3,  enablejsapi: 1, rel: 0, showinfo: 0, modestbranding: 1},
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        $("#loading").hide();
        $("#back").click(function(){
            window.location.href = "http://yourmainApplication12345.com";
        });
        $(".play").click(function(){
        theme = jQuery(this).attr("id");
        var myData = {"theme": theme};
        $.ajax({
            url: "./php/getData.php",
            type: "POST",
            data: myData,
            context: this,
            error: function () {},
            dataType: 'json',
            success : function (response) {
                //console.log(response);
                player.loadVideoById(response.link);
                $("#qTitle").text(response.question);
                var indexes = [1,2,3];
                indexes = shuffle(indexes);
                $("#answer"+indexes[0]).text(response.answer);
                $("#answerCorrect").text(response.answer);
                $("#answer"+indexes[1]).text(response.answerFake1);
                $("#answer"+indexes[2]).text(response.answerFake2);
                player.playVideo();
                $("#mainScreen").hide();
                setTimeout(showQuestions, getRandomArbitrary(8000, 50000));
            }
        });
        $("#answer1").click(function(){showAnswer();});
      $("#answer2").click(function(){showAnswer();});
      $("#answer3").click(function(){showAnswer();});
    });
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          //setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
      function showQuestions(){
        player.stopVideo();
        //alert(player.getDuration());
        $("#questions").show();
        //setTimeout(showAnswer, 7000);
      }
      
      function showAnswer(){
      if(!$("#answer").is(":visible")){
        $("#answer").show();
        $("#questions").hide();
        setTimeout(goBack, 3000);
        }
      }
      function goBack(){
        $("#answer").hide();
        $("#mainScreen").show();
        
      }
