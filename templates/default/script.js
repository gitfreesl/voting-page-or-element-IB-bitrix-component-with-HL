$( document ).ready(function() {
	
  $('body').on('click', 'button.like,button.unlike', function(){  // press add
	  
	var obj = $(this).children("span");
	var cur_vote = parseInt($(this).children().text()); // current count votes
	var likeval;
	if($(this).hasClass('like'))
		likeval = 1;
	else
		likeval = -1;
	
    if($(".like").hasClass("novote") && $(".unlike").hasClass("novote"))
		alert('� ������ IP ��� �������������');
	else{
		
	  $.post( PathTempl+'/add_like.php',  // ajax for add vote
        {
            name:  UserName, like: likeval, type: ObjType, object: ObjComment
        },
        function(data){
			
			if(data=='success'){       
			   $(".like, .unlike").addClass("novote");
			   obj.text(cur_vote+1);
			   
			}
			else 
			   alert('��������� ������ ��� ���������� ������ ������.');

      });
  	}  
	
  });
});