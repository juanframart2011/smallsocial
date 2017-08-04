var Chat = {};
        var windows_ass = {};
        var message_holder = {};
	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
         }  
		
        Chat.socket = null;

        Chat.connect = (function(host) {
            if ('WebSocket' in window) {
                Chat.socket = new WebSocket(host);
            } else if ('MozWebSocket' in window) {
                Chat.socket = new MozWebSocket(host);
            } else {
                alert("Some thing went wrong!!");
                return;
            }

            Chat.socket.onopen = function () {
               
              $( ".message" ).keydown(function(event) {
                    
                     if (event.keyCode == 13) {
                        var mto = $(this).attr('data-to');
                        var text = $(this).val();
                        sendMessage(mto,text);
                       $(this).prev().append("<div class='data-msg send' style='margin-top:7px;float:right;color:#fff;background-color:#3b94d9;clear:both;' >" + text + " <div class='dm-caret'><div class='dm-caret-outer'></div><div class='dm-caret-inner'></div></div> </div>  <br/>");
                       $(this).val('');
                      }
               
               });     
            };

            Chat.socket.onclose = function () {
                document.getElementById('chat').onkeydown = null;
              
            };
            
            

            Chat.socket.onmessage = function (event) {
		var div = document.getElementById('online');
                
                var message = JSON.parse(event.data);
              
                if(message.action == 'connected'){
                  
                  div.innerHTML = div.innerHTML + "<li id='"+message.name+"' > <div  class='chch-userAvatarWrapper'> <div class='chch-emptyAvatar chch-circularAvatar'><svg class='chch-emptyAvatarIco' enable-background='new 0 0 50 50' id='Layer_1' version='1.1' viewBox='0 0 50 50' xml:space='preserve' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect fill='none' height='50' width='50'></rect><path d='M30.933,32.528c-0.146-1.612-0.09-2.737-0.09-4.21c0.73-0.383,2.038-2.825,2.259-4.888c0.574-0.047,1.479-0.607,1.744-2.818 c0.143-1.187-0.425-1.855-0.771-2.065c0.934-2.809,2.874-11.499-3.588-12.397c-0.665-1.168-2.368-1.759-4.581-1.759 c-8.854,0.163-9.922,6.686-7.981,14.156c-0.345,0.21-0.913,0.878-0.771,2.065c0.266,2.211,1.17,2.771,1.744,2.818 c0.22,2.062,1.58,4.505,2.312,4.888c0,1.473,0.055,2.598-0.091,4.21C19.367,37.238,7.546,35.916,7,45h38 C44.455,35.916,32.685,37.238,30.933,32.528z'></path></svg></div> </div> <span>"+ message.name +" </span> <i> </i> </li>";     
                }
	        if(message.action == 'disconnected')
                {
  
                 var to_remove = document.getElementById(message.name);
                 to_remove.remove();
                 
                }
                
                if(message.action == 'frndmessage'){
                      
                   
                    if(windows_ass[message.from] !== undefined )
                    {
                   
                    $('.'+windows_ass[message.from]+ ' .content').append("<div class='data-msg rec' style='margin-top:7px;float:left;color:#fff;background-color:#3b94d9;clear:both;' >" + message.message + " <div class='dm-caretf'><div class='dm-caret-outer'></div><div class='dm-caret-inner'></div></div> </div> <br/>");
                    
                    }else{
                    
                  
                   
                    
                    if(message_holder[message.from] === undefined)
                     { 
                       message_holder[message.from] = [];
                     }
                    var fr = message.from;
                    message_holder[fr].push(message.message);
                    
                     $('#'+message.from+ ' i').html(message_holder[fr].length);
                    }
                }
               
            };
        });

        Chat.initialize = function() {
		 var name = getParameterByName('name');
            if (window.location.protocol == 'http:') {
                Chat.connect('ws://localhost:8080/WebSockets/chat/'+name);
            } else {
                Chat.connect('ws://localhost:8080/WebSockets/chat/'+name);
            }
        };

        function sendMessage(mto,message){
         
	    
	    var information = {
                  action: "Message",
                  to: mto,
                  message: message
               };
			
			
            if (message != '') {
                Chat.socket.send(JSON.stringify(information));
               
				
            }
        }

       
       

        Chat.initialize();


        document.addEventListener("DOMContentLoaded", function() {
            // Remove elements with "noscript" class - <noscript> is not allowed in XHTML
            var noscripts = document.getElementsByClassName("noscript");
            for (var i = 0; i < noscripts.length; i++) {
                noscripts[i].parentNode.removeChild(noscripts[i]);
            }
        }, false);