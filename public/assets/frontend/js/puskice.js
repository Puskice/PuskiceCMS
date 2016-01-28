$(document).on('click', '.yamm .dropdown-menu', function(e) {
  e.stopPropagation()
})

$(document).ready(function() {
    $('.pgwSlider').pgwSlider({
    	maxHeight: 300,
    });
    $('.news-carousel').slick({
	  slidesToShow: 6,
    draggable: false,
    swipe: false,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 4,
	        slidesToScroll: 1,
          draggable: false,
	        infinite: true,
          swipe: false,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1,
          draggable: false,
          swipe: false
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1,
          draggable: false,
          swipe: false
	      }
	    }
	  ]
	});
});

function vote(){
  id = $("input:radio[name=option_id]:checked").val();
  pollID = $("#poll_id").val();
  token = $("#token").val();
  $.post("http://www.puskice.org/apipolls/cast-vote/", { poll_id: pollID, option_id: id, _token: token })
    .done(function(data) {
      $("#fade_container").fadeOut("slow", function(){
          $.ajax({
            url: "https://api.puskice.org/polls/poll-results/"+pollID,
            context: document.body
          }).done(function(data) {
            $("#fade_container").html("");
            for (var i = data['poll_options'].length - 1; i >= 0; i--) {
              $("#fade_container").append("<div class='checkbox'><label>"+data['poll_options'][i]['title']+" "+((parseInt(data['poll_options'][i]['vote_count'],10)/parseInt(data['total_votes'], 10))*100).toFixed(2)+"%</label></div>");
            };
            $("#fade_container").append("<p><strong>"+data['totalvotes']+"</strong></p>");
            $("#fade_container").fadeIn("slow");
          }); 
      });
    })
}

function results(){
  pollID = $("#poll_id").val();
      $("#fade_container").fadeOut("slow", function(){
          $.ajax({
            url: "https://api.puskice.org/polls/poll-results/"+pollID,
            context: document.body
          }).done(function(data) {
            $("#fade_container").html("");
            for (var i = data['poll_options'].length - 1; i >= 0; i--) {
              $("#fade_container").append("<div class='checkbox'><label>"+data['poll_options'][i]['title']+" "+((parseInt(data['poll_options'][i]['vote_count'],10)/parseInt(data['total_votes'], 10))*100).toFixed(2)+"%</label></div>");
            };
            $("#fade_container").append("<p><strong>"+data['totalvotes']+"</strong></p>");
            $("#fade_container").fadeIn("slow");
          });
      });
}

function toLat(){
  text = $("#original").val();
  token = $("#token").val();
  $.post("http://www.puskice.org/apinews/to-latin/", { text: text, _token:token })
    .done(function(data) {
      $("#transliterated").val(data.response);
    });
}

function toCir(){
  text = $("#original").val();
  token = $("#token").val();
  $.post("http://www.puskice.org/apinews/to-cyrilic/", { text: text, _token:token })
    .done(function(data) {
      $("#transliterated").val(data.response);
    });
}

function fileThumbsUp(id){
  $.ajax({
    url: "https://api.puskice.org/files/thumbs-up/"+id,
    context: document.body
  }).done(function(data) {
    if(data['status'] == 'success'){
      $(".clear_text_thumbs a").attr('onclick', '');
      $(".clear_text_thumbs a").css('color', '#aaa');
      $("#upvote"+id).fadeOut('fast', function(){
        $("#upvote"+id).html("");
        $("#upvote"+id).html(data['thumbsUp']);
        $("#upvote"+id).fadeIn("fast");
      })
      $("#downvote"+id).fadeOut('fast',function(){
        $("#downvote"+id).html("");
        $("#downvote"+id).html(data['thumbsDown']);
        $("#downvote"+id).fadeIn("fast");  
      }) 
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
    if(data['status'] == 'fail'){
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
  });
}

function fileThumbsDown(id){
  $.ajax({
    url: "https://api.puskice.org/files/thumbs-down/"+id,
    context: document.body
  }).done(function(data) {
    if(data['status'] == 'success'){
      $(".clear_text_thumbs a").attr('onclick', '');
      $(".clear_text_thumbs a").css('color', '#aaa');
      $("#upvote"+id).fadeOut('fast', function(){
        $("#upvote"+id).html("");
        $("#upvote"+id).html(data['thumbsUp']);
        $("#upvote"+id).fadeIn("fast");
      })
      $("#downvote"+id).fadeOut('fast',function(){
        $("#downvote"+id).html("");
        $("#downvote"+id).html(data['thumbsDown']);
        $("#downvote"+id).fadeIn("fast");  
      }) 
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
    if(data['status'] == 'fail'){
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
  });
}

function newsThumbsUp(id){
  $.ajax({
    url: "https://api.puskice.org/news/thumbs-up/"+id,
    context: document.body
  }).done(function(data) {
    if(data['status'] == 'success'){
       $(".clear_text_thumbs a").attr('onclick', ' ');
      $(".clear_text_thumbs a").css('color', '#aaa');
      $("#upvote").fadeOut('fast', function(){
        $("#upvote").html("");
        $("#upvote").html(data['thumbsUp']);
        $("#upvote").fadeIn("fast");
      })
      $("#downvote").fadeOut('fast',function(){
        $("#downvote").html("");
        $("#downvote").html(data['thumbsDown']);
        $("#downvote").fadeIn("fast");  
      }) 
      $("#thumbsresponse").hide();
      $("#thumbsresponse").html(data['message']);
      $("#thumbsresponse").fadeIn('slow');
    }
    else{
      $("#thumbsresponse").hide();
      $("#thumbsresponse").html(data['message']);
      $("#thumbsresponse").fadeIn('slow');
    }
  });
}

function newsThumbsDown(id){
  $.ajax({
    url: "https://api.puskice.org/news/thumbs-down/"+id,
    context: document.body
  }).done(function(data) {
    if(data['status'] == 'success'){
       $(".clear_text_thumbs a").attr('onclick', ' ');
      $(".clear_text_thumbs a").css('color', '#aaa');
      $("#upvote").fadeOut('fast', function(){
        $("#upvote").html("");
        $("#upvote").html(data['thumbsUp']);
        $("#upvote").fadeIn("fast");
      })
      $("#downvote").fadeOut('fast',function(){
        $("#downvote").html("");
        $("#downvote").html(data['thumbsDown']);
        $("#downvote").fadeIn("fast");  
      }) 
      $("#thumbsresponse").hide();
      $("#thumbsresponse").html(data['message']);
      $("#thumbsresponse").fadeIn('slow');
    }
    else{
      $("#thumbsresponse").hide();
      $("#thumbsresponse").html(data['message']);
      $("#thumbsresponse").fadeIn('slow');
    }
  });
}

function commentThumbsUp(id){
  $.ajax({
    url: "https://api.puskice.org/comments/thumbs-up/"+id,
    context: document.body
  }).done(function(data) {
    if(data['status'] == 'success'){
      $(".clear_text_thumbs a").attr('onclick', '');
      $(".clear_text_thumbs a").css('color', '#aaa');
      $("#upvote"+id).fadeOut('fast', function(){
        $("#upvote"+id).html("");
        $("#upvote"+id).html(data['thumbsUp']);
        $("#upvote"+id).fadeIn("fast");
      })
      $("#downvote"+id).fadeOut('fast',function(){
        $("#downvote"+id).html("");
        $("#downvote"+id).html(data['thumbsDown']);
        $("#downvote"+id).fadeIn("fast");  
      }) 
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
    if(data['status'] == 'fail'){
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
  });
}

function commentThumbsDown(id){
  $.ajax({
    url: "https://api.puskice.org/comments/thumbs-down/"+id,
    context: document.body
  }).done(function(data) {
    if(data['status'] == 'success'){
      $(".clear_text_thumbs a").attr('onclick', '');
      $(".clear_text_thumbs a").css('color', '#aaa');
      $("#upvote"+id).fadeOut('fast', function(){
        $("#upvote"+id).html("");
        $("#upvote"+id).html(data['thumbsUp']);
        $("#upvote"+id).fadeIn("fast");
      })
      $("#downvote"+id).fadeOut('fast',function(){
        $("#downvote"+id).html("");
        $("#downvote"+id).html(data['thumbsDown']);
        $("#downvote"+id).fadeIn("fast");  
      }) 
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
    if(data['status'] == 'fail'){
      $("#thumbsresponse"+id).hide();
      $("#thumbsresponse"+id).html(data['message']);
      $("#thumbsresponse"+id).fadeIn('slow');
    }
  });
}

function postComment(id){
  uname = $("#username").val();
  eml = $("#email").val();
  content = $("#comment_content").val();
  verification = $("#antibot").val();
  token = $("#token").val();
  user_id = $("#id").val();
  if(parseInt(verification, 10) == parseInt($("#num1").html(), 10) + parseInt($("#num2").html(), 10)){
    $.post("http://www.puskice.org/apicomments/create/"+id, { commentContent: content, email: eml, username: uname, _token: token, user_id:user_id })
    .done(function(data) {
      var intRegex = /^\d+$/;
      if(data['status'] == 'success') {
          $("#response").fadeOut("slow", function(){
            $("#response").html("");
            $("#response").html(data['message']);  
            $("#response").fadeIn('slow');  
            $("#response").css('color', "#00ff00");
            $("#username").val("");
            $("#email").val("");
            $("#comment_content").val("");
            $("#antibot").val("");
            $("#postbutton").attr("onclick", "");
          });   
      }
      else{
        $("#response").fadeOut("slow", function(){
          $("#response").html("");
          $("#response").html(data['message']);
          $("#response").fadeIn('slow');  
          $("#response").css('color', "#ff0000");
        });

      }   
    })
    .fail(function() { 
        $("#response").html("");
        $("#response").fadeOut("slow");
        $("#response").html("");
        $("#response").html("Komentar nije uspešno poslat. Pokušajte ponovo");
        $("#response").fadeIn('slow');
         });
  }
  else{
    $("#response").fadeOut("slow", function(){
          $("#response").html("");
          $("#response").html("Error");
          $("#response").fadeIn('slow');  
          $("#response").css('color', "#ff0000");
        }); 
  }
}


function postMemeComment(id){
  uname = $("#username").val();
  eml = $("#email").val();
  content = $("#comment_content").val();
  verification = $("#antibot").val();
  token = $("#token").val();
  user_id = $("#id").val();
  if(parseInt(verification, 10) == parseInt($("#num1").html(), 10) + parseInt($("#num2").html(), 10)){
    $.post("http://www.puskice.org/apicomments/create-meme-comment/"+id, { commentContent: content, email: eml, username: uname, _token: token, user_id:user_id })
    .done(function(data) {
      var intRegex = /^\d+$/;
      if(data['status'] == 'success') {
          $("#response").fadeOut("slow", function(){
            $("#response").html("");
            $("#response").html(data['message']);  
            $("#response").fadeIn('slow');  
            $("#response").css('color', "#00ff00");
            $("#username").val("");
            $("#email").val("");
            $("#comment_content").val("");
            $("#antibot").val("");
            $("#postbutton").attr("onclick", "");
          });   
      }
      else{
        $("#response").fadeOut("slow", function(){
          $("#response").html("");
          $("#response").html(data['message']);
          $("#response").fadeIn('slow');  
          $("#response").css('color', "#ff0000");
        });
 
      }   
    })
    .fail(function() { 
        $("#response").html("");
        $("#response").fadeOut("slow");
        $("#response").html("");
        $("#response").html("Komentar nije uspešno poslat. Pokušajte ponovo");
        $("#response").fadeIn('slow');
         });
  }
  else{
    $("#response").fadeOut("slow", function(){
          $("#response").html("");
          $("#response").html("Error");
          $("#response").fadeIn('slow');  
          $("#response").css('color', "#ff0000");
        }); 
  }
}