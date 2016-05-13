$(function(){
	prettyPrint();
	$("#card-4").flip({
          trigger: 'manual'
        });

        $("#flip-btn").click(function(){
          $("#card-4").flip(true);
        });
});