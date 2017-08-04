<%-- 
Document   : intento
Created on : 28-oct-2016, 17:43:30
Author     : Orion
--%>
<%@page import="modelo.Chat"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="Shortcut Icon" href="../img/balon.png">
        <link href="../css/chat.css" rel="stylesheet" /> 
        <script src="../js/jquery.min.js"></script>
        <script src="../js/chat.js"></script>

        <title>MeeTeam</title>
    </head>
    <body>
        <h2>CHAT EN CONSTRUCCIÓN...</h2>
        <div class="noscript"><h2 style="color: #ff0000">Seems your browser doesn't support Javascript! Websockets rely on Javascript being enabled. Please enable
                Javascript and reload this page!</h2>
        </div>

        <div id="online">

        </div>    

        <div class="window1">
            <div class="header"> 
                <div style="float:left;margin-left: 9px;color: white;margin-top: 3px" class="from"></div>
                <svg style="float:right" version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve">
                <path d="M17.414,6.586c-0.78-0.781-2.048-0.781-2.828,0L12,9.172L9.414,6.586c-0.78-0.781-2.048-0.781-2.828,0
                      c-0.781,0.781-0.781,2.047,0,2.828L9.171,12l-2.585,2.586c-0.781,0.781-0.781,2.047,0,2.828C6.976,17.805,7.488,18,8,18
                      s1.024-0.195,1.414-0.586L12,14.828l2.586,2.586C14.976,17.805,15.488,18,16,18s1.024-0.195,1.414-0.586
                      c0.781-0.781,0.781-2.047,0-2.828L14.829,12l2.585-2.586C18.195,8.633,18.195,7.367,17.414,6.586z" fill="gainsboro"/>
                </svg>
            </div>
            <div class="content"> </div>
            <input type="text" class="message" style="width: 272px;height: 30px;" data-to="" />
        </div>


        <div class="window2">
            <div class="header">
                <div style="float:left;margin-left: 9px;color: white;margin-top: 3px" class="from"></div>    
                <svg style="float:right" version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve">
                <path d="M17.414,6.586c-0.78-0.781-2.048-0.781-2.828,0L12,9.172L9.414,6.586c-0.78-0.781-2.048-0.781-2.828,0
                      c-0.781,0.781-0.781,2.047,0,2.828L9.171,12l-2.585,2.586c-0.781,0.781-0.781,2.047,0,2.828C6.976,17.805,7.488,18,8,18
                      s1.024-0.195,1.414-0.586L12,14.828l2.586,2.586C14.976,17.805,15.488,18,16,18s1.024-0.195,1.414-0.586
                      c0.781-0.781,0.781-2.047,0-2.828L14.829,12l2.585-2.586C18.195,8.633,18.195,7.367,17.414,6.586z" fill="gainsboro"/>
                </svg>
            </div>
            <div class="content"> </div>
            <input type="text" class="message" style="width: 272px;height: 30px;" data-to="" />
        </div>        


        <div class="window3">
            <div class="header">
                <div style="float:left;margin-left: 9px;color: white;margin-top: 3px" class="from"></div>    
                <svg style="float:right" version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve">
                <path d="M17.414,6.586c-0.78-0.781-2.048-0.781-2.828,0L12,9.172L9.414,6.586c-0.78-0.781-2.048-0.781-2.828,0
                      c-0.781,0.781-0.781,2.047,0,2.828L9.171,12l-2.585,2.586c-0.781,0.781-0.781,2.047,0,2.828C6.976,17.805,7.488,18,8,18
                      s1.024-0.195,1.414-0.586L12,14.828l2.586,2.586C14.976,17.805,15.488,18,16,18s1.024-0.195,1.414-0.586
                      c0.781-0.781,0.781-2.047,0-2.828L14.829,12l2.585-2.586C18.195,8.633,18.195,7.367,17.414,6.586z" fill="gainsboro"/>
                </svg>
            </div>
            <div class="content"> </div>
            <input type="text" class="message" style="width: 272px;height: 30px;" data-to="" />
        </div>        

        <script>

            var windows = [];

            $("body").on('click', '#online li', function () {



                var mesg_to = $(this).attr('id');

                if (windows.indexOf("window1") === -1) {

                    windows_ass[mesg_to] = "window1";
                    windows.push("window1");
                    $(".window1").show();
                    $(".window1 .from").text(mesg_to);
                    $('.window1 input').attr('data-to', mesg_to);

                    if (message_holder[mesg_to] !== undefined)
                    {
                        var lengt = message_holder[mesg_to].length;
                        for (var i = 0; i < lengt; i++) {


                            $('.window1 .content').append("<div class='data-msg rec' style='margin-top:7px;float:left;color:#fff;background-color:#3b94d9;clear:both;' >" + message_holder[mesg_to][i] + " <div class='dm-caretf'><div class='dm-caret-outer'></div><div class='dm-caret-inner'></div></div> </div> <br/>");


                        }

                    }

                }
                else if (windows.indexOf("window2") === -1)
                {

                    windows_ass[mesg_to] = "window2";
                    windows.push("window2");
                    $(".window2").show();
                    $(".window2 .from").text(mesg_to);
                    $('.window2 input').attr('data-to', mesg_to);

                }
                else {

                    windows_ass[mesg_to] = "window3";
                    windows.push("window3");
                    $(".window3").show();
                    $(".window3 .from").text(mesg_to);
                    $('.window3 input').attr('data-to', mesg_to);

                }

            });


        </script>        
    </body>    
</html>