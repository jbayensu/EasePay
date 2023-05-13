

$(document).ready(function() {
			
			clock = $('.clock').FlipClock({
		        clockFace: 'MinuteCounter',
		        callbacks: {
		        	interval: function() {
		        		$("#allMyMessages").load('WebParts/noticollector.php');
                        $("#message-menu").text($("#notiData").text());
                                        
		        	}
		        }
		    });
});