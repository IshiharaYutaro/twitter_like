var user_id;
var my_id;
var sentpage;

$(document).ready(function(){
  var sentpage=0;
$.ajax({
        type:'POST',
        url: '/cakephp/users/json_data',
        dataType: 'json',
        cache : false,
        //data : {page: data.page},
        timeout: 10000,
    error: function(){
            //通信失敗時の処理
          alert('通信失敗');
        },
    success:function(data){
     //alert('通信');
    user_id = data.user_id;
    my_id = data.my_id;
    sentpage=1;
    var i=0;
    //sentpage=data.page
    if(data.user_first_tweet){
    if(data.json_user_data==my_id){
      $("#sent_no").append('<a href=/cakephp/users/index/mypage>投稿数'+data.user_sentdata);
    }
    else{
    $("#sent_no").append('<a href=/cakephp/users/index/'+data.json_user_data+'>投稿数'+data.user_sentdata);
  }
    $("#first_tweet").append(data.user_first_tweet.Tweet.tweet);
    $("#tweet_time").append(data.user_first_tweet.Tweet.tweettime);}
    else{
      $("#first_tweet").append("まだ、つぶやいてないです。今すぐ、つぶやこう！");
    }
    $("#output").empty();
    for(i in data.json_data){
    $("#output").append('<a href='+data.json_data[i].Tweet.name+'>'+data.json_data[i].Tweet.name+"</br>");
    var tweet =data.json_data[i].Tweet.tweet;
      tweet =tweet.replace(/\r?\n/g, '<br>');
      tweet =tweet.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g , '<a href="$1" target="_blank">$1</a></div> ');
    $("#output").append(tweet+"</br>");
    $("#output").append(data.json_data[i].Tweet.tweettime+"</br>");
    if(data.my_id==data.json_data[i].Tweet.name){
    $("#output").append('<button type="button" name="delite" id="delite" value='+data.json_data[i].Tweet.id+'>削除</button></br>');
     }
    $("#output").append("</br>");
    }
    if(i==0)
      $("#output").append('一度もツイートしていません。'+"</br>");
  }
    });
console.log(sentpage);
     tweet_bottom();
    });

$(function(){
  //15秒ごとに読み込み
 setInterval("tweet_load()", 15000);
});

function tweet_bottom(){
  sentpage =1;
  var end_flag=0;

  $(window).bottom({proximity: 0.05});
      $(window).bind("bottom", function(){
        if(end_flag==0){
        var obj = $(this);
        
        if (!obj.data("loading")) {
          obj.data("loading", true);
           $('.loading').append('<div class= gif><img src="/cakephp/img/loading.gif"></div>');
          setTimeout(function() {
            sentpage++;
            console.log(sentpage);
            $.ajax({
        type:"POST",
        url: '/cakephp/users/json_data',
        dataType: 'json',
        cache : false,
        data : {'page': sentpage},
        timeout: 10000,
        success:function(data){
         
    user_id = data.user_id;
    my_id = data.my_id;
    var i=0;
    //console.log(data.page);
    // console.log(data.json_data);
    $("#output").empty();
     $('.loading').empty();
     if(data!="end"){
    for(i in data.json_data){
    $("#output").append('<a href='+data.json_data[i].Tweet.name+'>'+data.json_data[i].Tweet.name+"</br>");
    var tweet =data.json_data[i].Tweet.tweet;
      tweet =tweet.replace(/\r?\n/g, '<br>');
      tweet =tweet.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1" target="_blank">$1</a>');
    $("#output").append(tweet+"</br>");
    $("#output").append(data.json_data[i].Tweet.tweettime+"</br>");
    //console.log(i);
    if(data.my_id==data.json_data[i].Tweet.name){
    $("#output").append('<button type="button" name="delite" id="delite" value='+data.json_data[i].Tweet.id+'>削除</button></br>');
     }
    $("#output").append("</br>");
  }}
  else{
    end_flag=1;
  }

  },
  error:function(){
            //通信失敗時の処理
            alert('通信失敗');
        },
      });

            obj.data("loading", false);
          }, 1500);
        }
      }
   });
}


function tweet_load(){
  $.ajax({
        type:"POST",
        url: '/cakephp/users/json_data',
        dataType: 'json',
        cache : false,
        data : {'page': sentpage},
        timeout: 10000,
        error:function(){
            //通信失敗時の処理
          alert('通信失敗');
        },
         success:function(data){
   $("#output").empty();
   $("#sent_no").empty();
    if(data.json_user_data==my_id){
      $("#sent_no").append('<a href=/cakephp/users/index/mypage>投稿数'+data.user_sentdata);
    }
    else{
    $("#sent_no").append('<a href=/cakephp/users/index/'+data.json_user_data+'>投稿数'+data.user_sentdata);
  }
    for(i in data.json_data){
    $("#output").append('<a href='+data.json_data[i].Tweet.name+'>'+data.json_data[i].Tweet.name+"</br>");
    var tweet =data.json_data[i].Tweet.tweet;
      tweet =tweet.replace(/\r?\n/g, '<br>');
      tweet =tweet.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1" target="_blank">$1</a> ');
    $("#output").append(tweet+"</br>");
    $("#output").append(data.json_data[i].Tweet.tweettime+"</br>");
    //console.log(i);
    if(data.my_id==data.json_data[i].Tweet.name){
    $("#output").append('<button type="button" name="delite" id="delite" value='+data.json_data[i].Tweet.id+'>削除</button></br>');
     }
    $("#output").append("</br>");
    }
    $("#first_tweet").empty();
    $("#tweet_time").empty();
    $("#first_tweet").append(data.user_first_tweet.Tweet.tweet);
    $("#tweet_time").append(data.user_first_tweet.Tweet.tweettime);
    }

});}


$(document).on('click','button',function(event){
  if(!confirm('本当に削除しますか？')){
        /* キャンセルの時の処理 */
        return false;
    }else{
    event.preventDefault();
            $.ajax({
                type:'POST',
                url: '/cakephp/users/json_data',
                dataType: 'json',
                cache : false,
                data : {id : $(this).val()},
                timeout:10000,
                success: function(data) {
                            //console.log(user_id+' '+my_id+' '+$('textarea').val()+' '+time);
                            console.log('delite_success');
                            tweet_load();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                             alert('error');
                       }
    });}
          });

$(document).on('click','div.submit',function(event) {
  event.preventDefault();
    console.log('validate_start');
$("div.submit").prop('disabled', true);   
    console.log('validate_end');
            $.ajax({
                type:'POST',
                url: '/cakephp/users/json_data',
                dataType: 'json',
                cache : false,
                data : {'tweet_id': user_id ,'name': my_id , 'tweet' : $('textarea').val()},
                timeout:10000,
                success: function(data) {
                  $("#error_msg").empty();
                  if(data.error_msg==null){
                            $('textarea').val("");
                            console.log(data);
                            //console.log(user_id+' '+my_id+' '+$('textarea').val()+' '+time);
                            console.log('sucess');
                            tweet_load();
                          }
                          else{
                            
                            $("#error_msg").append(data.error_msg.tweet);
                  }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                             alert('error');
                       }
              });
            $("div.submit").prop('disabled', false);
});



